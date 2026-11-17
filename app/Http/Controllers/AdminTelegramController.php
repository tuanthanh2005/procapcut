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
            'canboso_api_key' => Setting::getValue('canboso_api_key', 'tgb_8eae3646b74f7706536280e9778cf35d0f9ba900817be34b'),
        ];

        // Canboso Info
        $canbosoService = new \App\Services\CanbosoService($settings['canboso_api_key']);
        $canbosoBalance = $canbosoService->getBalance();
        $canbosoProductsList = [];
        if ($tab === 'canboso') {
            $prodRes = $canbosoService->getProducts();
            $canbosoProductsList = $prodRes['products'] ?? [];
        }

        // Data for other tabs
        $categories = TelegramCategory::withCount('products')->orderBy('sort_order', 'asc')->get();
        $products = TelegramProduct::with(['category', 'availableKeys'])->orderBy('category_id')->orderBy('sort_order')->get();
        $orders = TelegramOrder::with(['telegramUser', 'product'])->latest('id')->paginate(20, ['*'], 'orders_page');
        $users = TelegramUser::withCount('orders')->latest('id')->paginate(20, ['*'], 'users_page');

        // Filter stock keys by product_id if provided
        $stockProductId = $request->query('stock_product_id');
        $stockStatus = $request->query('stock_status');

        $stockQuery = TelegramProductKey::with(['product', 'order'])->latest('id');
        if ($stockProductId) {
            $stockQuery->where('product_id', $stockProductId);
        }
        if ($stockStatus === 'available') {
            $stockQuery->where('is_used', false);
        } elseif ($stockStatus === 'used') {
            $stockQuery->where('is_used', true);
        }
        $stockKeys = $stockQuery->paginate(30, ['*'], 'keys_page');

        return view('admin.telegram.index', compact(
            'tab', 'stats', 'webhookInfo', 'botInfo', 'settings',
            'categories', 'products', 'orders', 'users', 'stockKeys',
            'stockProductId', 'stockStatus', 'canbosoBalance', 'canbosoProductsList'
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
        Setting::setValue('canboso_api_key', trim($request->canboso_api_key));

        return redirect()->route('admin.telegram.index', ['tab' => 'settings'])
            ->with('success_message', 'Cập nhật cấu hình Bot Telegram, SePay & Canboso thành công!');
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
            'icon' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('telegram_categories', 'public');
        }

        TelegramCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . rand(10, 99),
            'icon' => $request->icon ?: '📦',
            'image' => $imagePath,
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
        $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $cat = TelegramCategory::findOrFail($id);

        $imagePath = $cat->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('telegram_categories', 'public');
        }

        $cat->update([
            'name' => $request->name,
            'icon' => $request->icon ?: '📦',
            'image' => $imagePath,
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
            'canboso_product_id' => $request->canboso_product_id,
            'canboso_cost_price' => (int) $request->input('canboso_cost_price', 0),
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
            'canboso_product_id' => $request->canboso_product_id,
            'canboso_cost_price' => (int) $request->input('canboso_cost_price', $product->canboso_cost_price),
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
        $productId = $key->product_id;
        $key->delete();
        return redirect()->route('admin.telegram.index', ['tab' => 'stock', 'stock_product_id' => $productId])
            ->with('success_message', 'Đã xóa mã trong kho thành công!');
    }

    /**
     * Update/Edit a Stock Key
     */
    public function updateStockKey(Request $request, $id)
    {
        $request->validate([
            'account_data' => 'required|string',
        ]);

        $key = TelegramProductKey::findOrFail($id);
        $key->account_data = trim($request->account_data);
        if ($request->has('is_used')) {
            $key->is_used = (bool) $request->is_used;
        }
        $key->save();

        return redirect()->route('admin.telegram.index', ['tab' => 'stock', 'stock_product_id' => $key->product_id])
            ->with('success_message', 'Đã cập nhật thông tin tài khoản/key thành công!');
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

    /**
     * Import a product directly from Canboso catalog
     */
    public function importCanbosoProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:telegram_categories,id',
            'canboso_product_id' => 'required|string',
            'name' => 'required|string|max:200',
            'canboso_cost_price' => 'required|numeric',
            'price' => 'required|numeric|min:0',
        ]);

        TelegramProduct::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => (int) $request->price,
            'original_price' => $request->original_price ? (int)$request->original_price : null,
            'description' => $request->description,
            'guide_text' => $request->guide_text,
            'delivery_type' => 'canboso_api',
            'canboso_product_id' => $request->canboso_product_id,
            'canboso_cost_price' => (int) $request->canboso_cost_price,
            'sold_count' => (int) $request->input('sold_count', 0),
            'is_active' => true,
            'sort_order' => (int) $request->input('sort_order', 1),
        ]);

        return redirect()->route('admin.telegram.index', ['tab' => 'products'])
            ->with('success_message', "Đã nhập sản phẩm \"{$request->name}\" từ Canboso thành công! Đơn hàng sẽ được xuất tự động.");
    }

    /**
     * Clear all sample products & sample stock keys
     */
    public function clearSampleProducts()
    {
        TelegramProductKey::truncate();
        TelegramProduct::truncate();

        return redirect()->route('admin.telegram.index', ['tab' => 'products'])
            ->with('success_message', 'Đã xóa toàn bộ sản phẩm và kho key mẫu thành công! Bảng sản phẩm hiện đã trống.');
    }

    /**
     * Sync real-time stock from Canboso API
     */
    public function syncCanbosoStock()
    {
        $service = new \App\Services\CanbosoService();
        $res = $service->getProducts();
        $productsList = $res['products'] ?? [];

        if (empty($productsList)) {
            return redirect()->back()->with('error_message', 'Không thể kết nối với API Canboso để lấy tồn kho.');
        }

        $stockMap = [];
        $costMap = [];
        foreach ($productsList as $p) {
            $pid = $p['productId'] ?? null;
            if ($pid) {
                $stockMap[$pid] = $p['availability']['available'] ?? 0;
                $costMap[$pid] = (int) ($p['price']['amount'] ?? 0);
            }
        }

        $updated = 0;
        $products = TelegramProduct::where('delivery_type', 'canboso_api')->get();

        foreach ($products as $prod) {
            if ($prod->canboso_product_id && isset($stockMap[$prod->canboso_product_id])) {
                $realStock = (int) $stockMap[$prod->canboso_product_id];
                $realCost = $costMap[$prod->canboso_product_id];

                $prod->update([
                    'canboso_stock' => $realStock,
                    'canboso_cost_price' => $realCost,
                ]);
                $updated++;
            }
        }

        return redirect()->route('admin.telegram.index', ['tab' => 'products'])
            ->with('success_message', "Đã đồng bộ lại tồn kho thực tế cho {$updated} sản phẩm từ Canboso thành công!");
    }

    /**
     * Bulk Import all available products from Canboso with profit margin
     */
    public function importAllCanboso(Request $request)
    {
        $marginPercent = (int) $request->input('margin_percent', 30);
        $minProfit = (int) $request->input('min_profit', 10000);
        $onlyInStock = $request->has('only_in_stock');

        $canbosoService = new \App\Services\CanbosoService();
        $res = $canbosoService->getProducts();
        $productsList = $res['products'] ?? [];

        if (empty($productsList)) {
            return redirect()->back()->with('error_message', 'Không thể kết nối hoặc không có sản phẩm nào từ Canboso.');
        }

        // Mapping rules from Canboso emoji/names to friendly category info
        $emojiCategoryMap = [
            'chatgpt' => ['name' => 'ChatGPT & OpenAI', 'icon' => '🤖'],
            'apigpt' => ['name' => 'ChatGPT & OpenAI', 'icon' => '🤖'],
            'capcut' => ['name' => 'CapCut Pro', 'icon' => '✂️'],
            'canva' => ['name' => 'Canva Pro', 'icon' => '🎨'],
            'google' => ['name' => 'Google Gemini', 'icon' => '✦'],
            'google_one' => ['name' => 'Google Gemini', 'icon' => '✦'],
            'claude' => ['name' => 'Claude AI', 'icon' => '✴️'],
            'cursor' => ['name' => 'Cursor & Codex', 'icon' => '🚀'],
            'github' => ['name' => 'Cursor & Codex', 'icon' => '🚀'],
            'replit' => ['name' => 'Cursor & Codex', 'icon' => '🚀'],
            'zed' => ['name' => 'Cursor & Codex', 'icon' => '🚀'],
            'adobe' => ['name' => 'Adobe All Apps', 'icon' => '🖌️'],
            'microsoft_office_365' => ['name' => 'Microsoft 365 & Office', 'icon' => '🪟'],
            'windows' => ['name' => 'Microsoft 365 & Office', 'icon' => '🪟'],
            'suno' => ['name' => 'Suno & Audio AI', 'icon' => '🎵'],
            'elevenlabs' => ['name' => 'Suno & Audio AI', 'icon' => '🎵'],
            'kling' => ['name' => 'Kling & Video AI', 'icon' => '🎬'],
            'runway' => ['name' => 'Kling & Video AI', 'icon' => '🎬'],
            'heygen' => ['name' => 'Kling & Video AI', 'icon' => '🎬'],
            'dreamina' => ['name' => 'Kling & Video AI', 'icon' => '🎬'],
            'openart' => ['name' => 'Kling & Video AI', 'icon' => '🎬'],
            'adguard_vpn' => ['name' => 'VPN & Proxy Riêng', 'icon' => '🛡️'],
            'proton' => ['name' => 'VPN & Proxy Riêng', 'icon' => '🛡️'],
            'surfshark' => ['name' => 'VPN & Proxy Riêng', 'icon' => '🛡️'],
            'kaspersky' => ['name' => 'VPN & Proxy Riêng', 'icon' => '🛡️'],
            'nordvpn' => ['name' => 'VPN & Proxy Riêng', 'icon' => '🛡️'],
            'spotify' => ['name' => 'Spotify & Giải Trí', 'icon' => '🎧'],
            'netflix' => ['name' => 'Spotify & Giải Trí', 'icon' => '🍿'],
            'youtube' => ['name' => 'Spotify & Giải Trí', 'icon' => '📺'],
            'iqiyi' => ['name' => 'Spotify & Giải Trí', 'icon' => '📺'],
            'xingtu' => ['name' => 'App Sửa Ảnh & Video', 'icon' => '📸'],
            'wink' => ['name' => 'App Sửa Ảnh & Video', 'icon' => '📸'],
            'meitu' => ['name' => 'App Sửa Ảnh & Video', 'icon' => '📸'],
            'grok' => ['name' => 'Grok X.AI', 'icon' => '⚡'],
            'kimi' => ['name' => 'Kimi & LLM AI', 'icon' => '🧠'],
            'perplexity' => ['name' => 'Perplexity AI', 'icon' => '🔍'],
            'gmail' => ['name' => 'Tài Khoản Mail & OTP', 'icon' => '✉️'],
            'outlook' => ['name' => 'Tài Khoản Mail & OTP', 'icon' => '✉️'],
            'figma' => ['name' => 'Figma & Design', 'icon' => '📐'],
        ];

        $imported = 0;
        $updated = 0;

        foreach ($productsList as $p) {
            $productId = $p['productId'] ?? null;
            $name = $p['name'] ?? '';
            $costPrice = (int) ($p['price']['amount'] ?? 0);
            $available = $p['availability']['available'] ?? 0;
            $emoji = $p['emoji'] ?? '';

            if (!$productId || !$name) {
                continue;
            }

            // Skip out of stock if requested
            if ($onlyInStock && $available <= 0) {
                continue;
            }

            // Auto determine Category Name & Icon from API emoji or product name
            $catName = 'Sản phẩm khác';
            $catIcon = '📦';

            if (isset($emojiCategoryMap[$emoji])) {
                $catName = $emojiCategoryMap[$emoji]['name'];
                $catIcon = $emojiCategoryMap[$emoji]['icon'];
            } else {
                $lowerName = mb_strtolower($name);
                if (str_contains($lowerName, 'capcut')) { $catName = 'CapCut Pro'; $catIcon = '✂️'; }
                elseif (str_contains($lowerName, 'chatgpt') || str_contains($lowerName, 'gpt')) { $catName = 'ChatGPT & OpenAI'; $catIcon = '🤖'; }
                elseif (str_contains($lowerName, 'gemini') || str_contains($lowerName, 'google')) { $catName = 'Google Gemini'; $catIcon = '✦'; }
                elseif (str_contains($lowerName, 'canva')) { $catName = 'Canva Pro'; $catIcon = '🎨'; }
                elseif (str_contains($lowerName, 'vpn')) { $catName = 'VPN & Proxy Riêng'; $catIcon = '🛡️'; }
                elseif (str_contains($lowerName, 'cursor') || str_contains($lowerName, 'codex')) { $catName = 'Cursor & Codex'; $catIcon = '🚀'; }
                elseif (str_contains($lowerName, 'youtube') || str_contains($lowerName, 'netflix')) { $catName = 'Spotify & Giải Trí'; $catIcon = '🍿'; }
            }

            // Auto create category if not exists in DB (NO SEEDER NEEDED!)
            $category = TelegramCategory::firstOrCreate(
                ['name' => $catName],
                [
                    'slug' => \Illuminate\Support\Str::slug($catName) . '-' . rand(10, 99),
                    'icon' => $catIcon,
                    'sort_order' => 1,
                    'is_active' => true,
                ]
            );

            // Calculate selling price: costPrice + margin%, ensuring at least +minProfit
            $profit = max($minProfit, (int) round(($costPrice * $marginPercent) / 100));
            $sellPrice = ceil(($costPrice + $profit) / 1000) * 1000;
            $originalPrice = ceil(($sellPrice * 1.35) / 1000) * 1000;

            $existing = TelegramProduct::where('canboso_product_id', $productId)->first();

            $data = [
                'category_id' => $category->id,
                'name' => $name,
                'price' => $sellPrice,
                'original_price' => $originalPrice,
                'description' => $p['description'] ?? '',
                'guide_text' => "Đăng nhập bằng thông tin Email | Mật khẩu bên trên tại trang web hoặc ứng dụng chính thức.",
                'delivery_type' => 'canboso_api',
                'canboso_product_id' => $productId,
                'canboso_cost_price' => $costPrice,
                'canboso_stock' => (int) $available,
                'is_active' => true,
                'sort_order' => 1,
            ];

            if ($existing) {
                $existing->update($data);
                $updated++;
            } else {
                $data['sold_count'] = rand(8, 48);
                TelegramProduct::create($data);
                $imported++;
            }
        }

        return redirect()->route('admin.telegram.index', ['tab' => 'products'])
            ->with('success_message', "Đã đồng bộ thành công: Thêm mới {$imported} sản phẩm & cập nhật {$updated} sản phẩm từ Canboso!");
    }
}
