<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TelegramCategory;
use App\Models\TelegramProduct;
use App\Models\TelegramProductKey;
use App\Models\TelegramOrder;
use App\Models\TelegramUser;
use App\Models\TelegramTransaction;
use App\Services\TelegramBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTelegramController extends Controller
{
    protected TelegramBotService $botService;

    public function __construct()
    {
        $this->botService = new TelegramBotService();
    }

    /**
     * Main Telegram Management Dashboard
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'overview');

        // Overview stats
        $stats = [
            'total_users' => TelegramUser::count(),
            'total_orders' => TelegramOrder::count(),
            'completed_orders' => TelegramOrder::where('status', 'completed')->count(),
            'pending_orders' => TelegramOrder::where('status', 'pending')->count(),
            'total_revenue' => TelegramOrder::where('status', 'completed')->sum('total_amount'),
            'total_wallet_balance' => TelegramUser::sum('balance'),
            'total_stock_keys' => TelegramProductKey::where('is_used', false)->count(),
        ];

        // Webhook status
        $webhookInfo = $this->botService->getWebhookInfo();
        $botInfo = $this->botService->getMe();

        // Config settings
        $settings = [
            'telegram_bot_token' => Setting::getValue('telegram_bot_token', '8817526380:AAGibQV42H2YYMnH9vr1Y54nA8UCWur1aYA'),
            'telegram_bot_username' => Setting::getValue('telegram_bot_username', 'tap_hoa_ai_gia_re_bot'),
            'telegram_admin_id' => Setting::getValue('telegram_admin_id', '8199725778'),
            'telegram_ref_commission' => Setting::getValue('telegram_ref_commission', '10'),
            'telegram_support_phone' => Setting::getValue('telegram_support_phone', '0772698113'),
            'telegram_support_phone_2' => Setting::getValue('telegram_support_phone_2', '0708910952'),
            'telegram_support_admin' => Setting::getValue('telegram_support_admin', '@specademy'),
            'telegram_support_websites' => Setting::getValue('telegram_support_websites', 'dungthu.com | aicuatoi.com | aicuatoi.net | vpnstore.pro'),
            'sepay_webhook_token' => Setting::getValue('sepay_webhook_token', 'RX2FPYARHKQE0TTIZZGEF7KLUUUC9THJD8JA3Z51HIXMONSS1PXXWRGVG89EH4EN'),
        ];

        // Data for other tabs
        $categories = TelegramCategory::withCount('products')->orderBy('sort_order', 'asc')->get();
        $products = TelegramProduct::with(['category', 'availableKeys'])->orderBy('category_id')->orderBy('sort_order')->get();
        $orders = TelegramOrder::with(['telegramUser', 'product'])->latest('id')->paginate(20, ['*'], 'orders_page');
        $users = TelegramUser::withCount('orders')->latest('id')->paginate(20, ['*'], 'users_page');
        $stockKeys = TelegramProductKey::with('product')->latest('id')->paginate(30, ['*'], 'keys_page');

        return view('admin.telegram.index', compact(
            'tab', 'stats', 'webhookInfo', 'botInfo', 'settings',
            'categories', 'products', 'orders', 'users', 'stockKeys'
        ));
    }

    /**
     * Save Telegram Bot & SePay Settings
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'telegram_bot_token' => 'required|string',
            'telegram_bot_username' => 'required|string',
            'sepay_webhook_token' => 'required|string',
        ]);

        Setting::setValue('telegram_bot_token', trim($request->telegram_bot_token));
        Setting::setValue('telegram_bot_username', ltrim(trim($request->telegram_bot_username), '@'));
        Setting::setValue('telegram_admin_id', trim($request->telegram_admin_id));
        Setting::setValue('telegram_ref_commission', (int)$request->telegram_ref_commission);
        Setting::setValue('telegram_support_phone', trim($request->telegram_support_phone));
        Setting::setValue('telegram_support_phone_2', trim($request->telegram_support_phone_2));
        Setting::setValue('telegram_support_admin', trim($request->telegram_support_admin));
        Setting::setValue('telegram_support_websites', trim($request->telegram_support_websites));
        Setting::setValue('sepay_webhook_token', trim($request->sepay_webhook_token));

        return redirect()->route('admin.telegram.index', ['tab' => 'settings'])
            ->with('success_message', 'Cập nhật cấu hình Bot Telegram & SePay thành công!');
    }

    /**
     * Register Webhook on Telegram
     */
    public function setWebhook(Request $request)
    {
        $webhookUrl = url('/webhook/telegram');
        $res = $this->botService->setWebhook($webhookUrl);

        if ($res['ok'] ?? false) {
            return redirect()->back()->with('success_message', "Đã kết nối Webhook Telegram thành công: {$webhookUrl}");
        }

        return redirect()->back()->with('error_message', 'Không thể đặt Webhook: ' . ($res['description'] ?? 'Lỗi không xác định'));
    }

    /**
     * Delete Webhook on Telegram
     */
    public function deleteWebhook()
    {
        $res = $this->botService->deleteWebhook();
        if ($res['ok'] ?? false) {
            return redirect()->back()->with('success_message', 'Đã hủy kết nối Webhook Telegram!');
        }
        return redirect()->back()->with('error_message', 'Lỗi khi hủy Webhook: ' . ($res['description'] ?? ''));
    }

    /**
     * Test Bot Connection
     */
    public function testBot()
    {
        $me = $this->botService->getMe();
        if ($me['ok'] ?? false) {
            $botName = $me['result']['first_name'] ?? '';
            $botUser = $me['result']['username'] ?? '';
            return redirect()->back()->with('success_message', "Kết nối Bot thành công! Tên: {$botName} (@{$botUser})");
        }
        return redirect()->back()->with('error_message', 'Kết nối Bot thất bại: ' . ($me['description'] ?? 'Kiểm tra lại Token'));
    }

    /**
     * Store new Category
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'required|string|max:10',
        ]);

        TelegramCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . rand(10, 99),
            'icon' => $request->icon,
            'sort_order' => (int) $request->sort_order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.telegram.index', ['tab' => 'categories'])
            ->with('success_message', 'Đã thêm danh mục mới thành công!');
    }

    /**
     * Update Category
     */
    public function updateCategory(Request $request, $id)
    {
        $cat = TelegramCategory::findOrFail($id);
        $cat->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'sort_order' => (int) $request->sort_order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.telegram.index', ['tab' => 'categories'])
            ->with('success_message', 'Cập nhật danh mục thành công!');
    }

    /**
     * Delete Category
     */
    public function deleteCategory($id)
    {
        $cat = TelegramCategory::findOrFail($id);
        $cat->delete();
        return redirect()->route('admin.telegram.index', ['tab' => 'categories'])
            ->with('success_message', 'Đã xóa danh mục thành công!');
    }

    /**
     * Store new Product
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:telegram_categories,id',
            'name' => 'required|string|max:200',
            'price' => 'required|numeric|min:0',
        ]);

        TelegramProduct::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => (int) $request->price,
            'original_price' => $request->original_price ? (int)$request->original_price : null,
            'description' => $request->description,
            'guide_text' => $request->guide_text,
            'delivery_type' => $request->delivery_type ?: 'key_stock',
            'static_content' => $request->static_content,
            'sold_count' => (int) $request->input('sold_count', 0),
            'is_active' => $request->has('is_active'),
            'sort_order' => (int) $request->sort_order,
        ]);

        return redirect()->route('admin.telegram.index', ['tab' => 'products'])
            ->with('success_message', 'Đã thêm sản phẩm Bot thành công!');
    }

    /**
     * Update Product
     */
    public function updateProduct(Request $request, $id)
    {
        $product = TelegramProduct::findOrFail($id);
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => (int) $request->price,
            'original_price' => $request->original_price ? (int)$request->original_price : null,
            'description' => $request->description,
            'guide_text' => $request->guide_text,
            'delivery_type' => $request->delivery_type ?: 'key_stock',
            'static_content' => $request->static_content,
            'sold_count' => (int) $request->input('sold_count', $product->sold_count),
            'is_active' => $request->has('is_active'),
            'sort_order' => (int) $request->sort_order,
        ]);

        return redirect()->route('admin.telegram.index', ['tab' => 'products'])
            ->with('success_message', 'Cập nhật sản phẩm Bot thành công!');
    }

    /**
     * Delete Product
     */
    public function deleteProduct($id)
    {
        $product = TelegramProduct::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.telegram.index', ['tab' => 'products'])
            ->with('success_message', 'Đã xóa sản phẩm thành công!');
    }

    /**
     * Bulk Import Stock Keys / Accounts for a Product
     */
    public function storeStockKeys(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:telegram_products,id',
            'keys_content' => 'required|string',
        ]);

        $productId = $request->product_id;
        $lines = preg_split('/\r\n|\r|\n/', trim($request->keys_content));
        $added = 0;

        foreach ($lines as $line) {
            $data = trim($line);
            if (!empty($data)) {
                TelegramProductKey::create([
                    'product_id' => $productId,
                    'account_data' => $data,
                    'is_used' => false,
                ]);
                $added++;
            }
        }

        return redirect()->route('admin.telegram.index', ['tab' => 'stock'])
            ->with('success_message', "Đã nhập thành công {$added} tài khoản/key vào kho!");
    }

    /**
     * Delete a Stock Key
     */
    public function deleteStockKey($id)
    {
        $key = TelegramProductKey::findOrFail($id);
        $key->delete();
        return redirect()->route('admin.telegram.index', ['tab' => 'stock'])
            ->with('success_message', 'Đã xóa mã trong kho thành công!');
    }

    /**
     * Manually approve & deliver an Order
     */
    public function completeOrderManually($id)
    {
        $order = TelegramOrder::findOrFail($id);
        if ($order->status === 'completed') {
            return redirect()->back()->with('error_message', 'Đơn hàng này đã hoàn tất trước đó!');
        }

        $order->update([
            'paid_at' => now(),
        ]);

        $this->botService->deliverOrder($order);

        return redirect()->route('admin.telegram.index', ['tab' => 'orders'])
            ->with('success_message', "Đã duyệt và giao tài khoản đơn hàng #{$order->order_code} cho khách qua Telegram!");
    }

    /**
     * Cancel an Order
     */
    public function cancelOrder($id)
    {
        $order = TelegramOrder::findOrFail($id);
        $order->update(['status' => 'cancelled']);
        return redirect()->route('admin.telegram.index', ['tab' => 'orders'])
            ->with('success_message', "Đã hủy đơn hàng #{$order->order_code}!");
    }

    /**
     * Adjust User Wallet Balance
     */
    public function adjustBalance(Request $request, $id)
    {
        $user = TelegramUser::findOrFail($id);
        $amount = (int) $request->amount;
        $reason = $request->reason ?: 'Điều chỉnh số dư bởi Quản trị viên';

        if ($amount == 0) {
            return redirect()->back()->with('error_message', 'Số tiền điều chỉnh phải khác 0');
        }

        $balanceBefore = $user->balance;
        $user->balance += $amount;
        if ($user->balance < 0) {
            $user->balance = 0;
        }
        $user->save();

        TelegramTransaction::create([
            'telegram_user_id' => $user->id,
            'type' => 'admin_adjustment',
            'amount' => $amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $user->balance,
            'description' => $reason,
        ]);

        // Send notification to user
        $changeStr = ($amount > 0 ? '+' : '') . number_format($amount, 0, ',', '.') . 'đ';
        $newBalanceFormatted = number_format($user->balance, 0, ',', '.') . 'đ';
        $msg = "🔔 <b>THÔNG BÁO BIẾN ĐỘNG SỐ DƯ VÍ</b>\n";
        $msg .= "━━━━━━━━━━━━━━━━━━━━\n";
        $msg .= "Số dư thay đổi: <b>{$changeStr}</b>\n";
        $msg .= "Số dư ví hiện tại: <b>{$newBalanceFormatted}</b>\n";
        $msg .= "Lý do: <i>{$reason}</i>";
        $this->botService->sendMessage($user->telegram_id, $msg);

        return redirect()->route('admin.telegram.index', ['tab' => 'users'])
            ->with('success_message', "Đã cập nhật số dư cho người dùng #{$user->telegram_id} thành công!");
    }

    /**
     * Toggle Ban User
     */
    public function toggleBan($id)
    {
        $user = TelegramUser::findOrFail($id);
        $user->is_banned = !$user->is_banned;
        $user->save();

        $action = $user->is_banned ? 'Khóa' : 'Mở khóa';
        return redirect()->route('admin.telegram.index', ['tab' => 'users'])
            ->with('success_message', "Đã {$action} tài khoản Telegram #{$user->telegram_id}!");
    }

    /**
     * Send Broadcast Message to all Telegram users
     */
    public function sendBroadcast(Request $request)
    {
        $request->validate([
            'message_content' => 'required|string',
        ]);

        $users = TelegramUser::where('is_banned', false)->get();
        $message = $request->message_content;
        $btnText = $request->btn_text;
        $btnUrl = $request->btn_url;

        $keyboard = null;
        if ($btnText && $btnUrl) {
            $keyboard = [
                'inline_keyboard' => [
                    [['text' => $btnText, 'url' => $btnUrl]]
                ]
            ];
        }

        $sentCount = 0;
        foreach ($users as $user) {
            $res = $this->botService->sendMessage($user->telegram_id, $message, $keyboard);
            if ($res['ok'] ?? false) {
                $sentCount++;
            }
        }

        return redirect()->route('admin.telegram.index', ['tab' => 'broadcast'])
            ->with('success_message', "Đã gửi thông báo thành công đến {$sentCount}/" . count($users) . " người dùng bot!");
    }
}
