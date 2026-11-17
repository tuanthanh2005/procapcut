<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\TelegramUser;
use App\Models\TelegramCategory;
use App\Models\TelegramProduct;
use App\Models\TelegramProductKey;
use App\Models\TelegramOrder;
use App\Models\TelegramTransaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TelegramBotService
{
    protected ?string $token;
    protected string $apiUrl;

    public function __construct(?string $token = null)
    {
        $this->token = $token ?: Setting::getValue('telegram_bot_token', '8817526380:AAGibQV42H2YYMnH9vr1Y54nA8UCWur1aYA');
        $this->apiUrl = "https://api.telegram.org/bot{$this->token}";
    }

    /**
     * Send HTTP request to Telegram API
     */
    public function sendRequest(string $method, array $params = [])
    {
        try {
            $response = Http::timeout(10)->post("{$this->apiUrl}/{$method}", $params);
            $json = $response->json();
            
            if (!$response->successful() || !($json['ok'] ?? false)) {
                Log::error("Telegram API Error ({$method}): " . json_encode($json ?? $response->body()));
            }
            
            return $json;
        } catch (\Exception $e) {
            Log::error("Telegram API Exception ({$method}): " . $e->getMessage());
            return ['ok' => false, 'description' => $e->getMessage()];
        }
    }

    /**
     * Send Text Message
     */
    public function sendMessage($chatId, string $text, $keyboard = null, string $parseMode = 'HTML')
    {
        $payload = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => $parseMode,
            'disable_web_page_preview' => true,
        ];

        if ($keyboard) {
            $payload['reply_markup'] = is_string($keyboard) ? $keyboard : json_encode($keyboard);
        }

        return $this->sendRequest('sendMessage', $payload);
    }

    /**
     * Send Photo
     */
    public function sendPhoto($chatId, string $photoUrl, ?string $caption = null, $keyboard = null, string $parseMode = 'HTML')
    {
        $payload = [
            'chat_id' => $chatId,
            'photo' => $photoUrl,
            'parse_mode' => $parseMode,
        ];

        if ($caption) {
            $payload['caption'] = $caption;
        }

        if ($keyboard) {
            $payload['reply_markup'] = is_string($keyboard) ? $keyboard : json_encode($keyboard);
        }

        return $this->sendRequest('sendPhoto', $payload);
    }

    /**
     * Edit Message Caption (For photo messages)
     */
    public function editMessageCaption($chatId, $messageId, string $caption, $keyboard = null, string $parseMode = 'HTML')
    {
        $payload = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'caption' => $caption,
            'parse_mode' => $parseMode,
        ];

        if ($keyboard) {
            $payload['reply_markup'] = is_string($keyboard) ? $keyboard : json_encode($keyboard);
        }

        return $this->sendRequest('editMessageCaption', $payload);
    }
    public function editMessageText($chatId, $messageId, string $text, $keyboard = null, string $parseMode = 'HTML')
    {
        $payload = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
            'parse_mode' => $parseMode,
            'disable_web_page_preview' => true,
        ];

        if ($keyboard) {
            $payload['reply_markup'] = is_string($keyboard) ? $keyboard : json_encode($keyboard);
        }

        return $this->sendRequest('editMessageText', $payload);
    }

    /**
     * Answer Callback Query
     */
    public function answerCallbackQuery(string $callbackQueryId, ?string $text = null, bool $showAlert = false)
    {
        $payload = ['callback_query_id' => $callbackQueryId];
        if ($text) {
            $payload['text'] = $text;
            $payload['show_alert'] = $showAlert;
        }
        return $this->sendRequest('answerCallbackQuery', $payload);
    }

    /**
     * Notify Admin via Telegram
     */
    public function notifyAdmin(string $message, $keyboard = null)
    {
        $adminId = Setting::getValue('telegram_admin_id', '8199725778');
        if ($adminId) {
            return $this->sendMessage($adminId, $message, $keyboard);
        }
        return false;
    }

    /**
     * Get or create Telegram User
     */
    public function getOrCreateUser(array $from, ?string $startParam = null): TelegramUser
    {
        $telegramId = $from['id'];
        $user = TelegramUser::where('telegram_id', $telegramId)->first();

        if (!$user) {
            $referredBy = null;
            if ($startParam && str_starts_with($startParam, 'ref_')) {
                $refId = (int) str_replace('ref_', '', $startParam);
                if ($refId !== $telegramId && TelegramUser::where('telegram_id', $refId)->exists()) {
                    $referredBy = $refId;
                }
            }

            $user = TelegramUser::create([
                'telegram_id' => $telegramId,
                'first_name' => $from['first_name'] ?? '',
                'last_name' => $from['last_name'] ?? '',
                'username' => $from['username'] ?? '',
                'balance' => 0,
                'total_spent' => 0,
                'referral_code' => (string)$telegramId,
                'referred_by' => $referredBy,
            ]);

            // 1. Notify Referrer if linked
            if ($referredBy) {
                $refUser = TelegramUser::where('telegram_id', $referredBy)->first();
                if ($refUser) {
                    $this->sendMessage(
                        $refUser->telegram_id,
                        "🎉 <b>BẠN CÓ THÊM THÀNH VIÊN GIỚI THIỆU MỚI!</b>\n━━━━━━━━━━━━━━━━━━━━\n👤 Người dùng: <b>" . htmlspecialchars($user->full_name) . "</b>\nKhi thành viên này mua hàng, bạn sẽ nhận được hoa hồng tự động vào ví!"
                    );
                }
            }

            // 2. Instant Alert to Admin: New User & Referral Check
            $refText = "Không có (Trực tiếp)";
            if ($referredBy) {
                $refUser = TelegramUser::where('telegram_id', $referredBy)->first();
                $refName = $refUser ? $refUser->full_name : $referredBy;
                $refText = "Được giới thiệu bởi: <b>" . htmlspecialchars($refName) . "</b> (ID: <code>{$referredBy}</code>)";
            }

            $userHandle = $user->username ? "@{$user->username}" : "Không có username";
            $adminAlert = "👤 <b>[KHÁCH HÀNG MỚI THAM GIA BOT]</b>\n";
            $adminAlert .= "━━━━━━━━━━━━━━━━━━━━\n";
            $adminAlert .= "🏷️ Tên: <b>" . htmlspecialchars($user->full_name) . "</b> ({$userHandle})\n";
            $adminAlert .= "🆔 Telegram ID: <code>{$user->telegram_id}</code>\n";
            $adminAlert .= "🤝 Nguồn giới thiệu: {$refText}\n";
            $adminAlert .= "⏰ Thời gian: " . now()->format('d/m/Y H:i:s');

            $this->notifyAdmin($adminAlert);
        } else {
            // Update latest user info
            $user->update([
                'first_name' => $from['first_name'] ?? $user->first_name,
                'last_name' => $from['last_name'] ?? $user->last_name,
                'username' => $from['username'] ?? $user->username,
            ]);
        }

        return $user;
    }

    /**
     * Process incoming webhook update
     */
    public function processUpdate(array $update)
    {
        // 1. Handle Callback Query
        if (isset($update['callback_query'])) {
            $this->handleCallbackQuery($update['callback_query']);
            return;
        }

        // 2. Handle Text Message
        if (isset($update['message'])) {
            $this->handleMessage($update['message']);
            return;
        }
    }

    /**
     * Handle incoming Telegram Message
     */
    public function handleMessage(array $message)
    {
        $chatId = $message['chat']['id'];
        $from = $message['from'];
        $text = trim($message['text'] ?? '');

        $startParam = null;
        if (str_starts_with($text, '/start')) {
            $parts = explode(' ', $text);
            if (isset($parts[1])) {
                $startParam = trim($parts[1]);
            }
        }

        $user = $this->getOrCreateUser($from, $startParam);

        if ($user->is_banned) {
            $this->sendMessage($chatId, "⛔ <b>Tài khoản của bạn đã bị khóa tạm thời.</b>\nVui lòng liên hệ Admin để được hỗ trợ giải quyết.");
            return;
        }

        // Handle /start or Start button
        if (str_starts_with($text, '/start') || $text === '🏠 Trang Chủ' || $text === 'Menu') {
            $user->update(['step' => null, 'step_data' => null]);
            $this->sendWelcomeMessage($chatId, $user);
            return;
        }

        // Handle step input (e.g. quantity or custom top-up)
        if ($user->step === 'waiting_qty') {
            $this->handleQuantityInput($user, $text, $chatId);
            return;
        }

        if ($user->step === 'waiting_topup') {
            $this->handleTopupInput($user, $text, $chatId);
            return;
        }

        // Fallback or Unknown command
        $this->sendWelcomeMessage($chatId, $user);
    }

    /**
     * Send modern Welcome Message
     */
    public function sendWelcomeMessage($chatId, TelegramUser $user)
    {
        $adminTelegram = Setting::getValue('telegram_support_admin', '@specademy');
        $phone1 = Setting::getValue('telegram_support_phone', '0772698113');
        $phone2 = Setting::getValue('telegram_support_phone_2', '0708910952');
        $websites = Setting::getValue('telegram_support_websites', 'dungthu.com | aicuatoi.com');

        $html = "🔥 <b>WELCOME TO AI STORE</b> 🔥\n";
        $html .= "👋 Chào mừng <b>" . htmlspecialchars($user->full_name) . "</b> đến với hệ thống <b>Tài Khoản AI Giá Rẻ</b>!\n\n";
        $html .= "🚀 <b>CHẤT LƯỢNG HÀNG ĐẦU - PHỤC VỤ 24/7</b>\n";
        $html .= "Cảm ơn bạn đã tin tưởng lựa chọn dịch vụ mua sắm tự động của chúng tôi.\n\n";
        $html .= "⚡ <b>TIỆN ÍCH VƯỢT TRỘI:</b>\n";
        $html .= "◾ Mua hàng tự động 24/7 - Tiện lợi & Nhanh chóng.\n";
        $html .= "◾ Thanh toán quét mã QR - Xác nhận đơn hàng tức thì.\n";
        $html .= "◾ Nhận thông tin tài khoản tự động ngay sau khi thanh toán.\n\n";
        $html .= "☎️ <b>THÔNG TIN HỖ TRỢ:</b>\n";
        $html .= "📞 Zalo hỗ trợ: <b>{$phone1}</b>\n";
        if ($phone2) {
            $html .= "📞 Zalo hỗ trợ: <b>{$phone2}</b>\n";
        }
        $html .= "🌐 Website: <b>{$websites}</b>\n";
        $html .= "💬 Telegram Admin: <b>{$adminTelegram}</b>\n\n";
        $html .= "👇 <i>Vui lòng chọn chức năng mua sắm bên dưới:</i>";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '🛒 Xem Cửa Hàng', 'callback_data' => 'menu_store'],
                    ['text' => '🛍️ Mua Nhanh', 'callback_data' => 'menu_store'],
                ],
                [
                    ['text' => '👤 Hồ sơ', 'callback_data' => 'menu_profile'],
                    ['text' => '👁️ Lịch sử mua', 'callback_data' => 'menu_orders'],
                ],
                [
                    ['text' => '👛 Ví / Nạp tiền', 'callback_data' => 'menu_wallet'],
                    ['text' => '🎁 Giới thiệu', 'callback_data' => 'menu_referral'],
                ],
                [
                    ['text' => '💬 Hỗ trợ', 'callback_data' => 'menu_support'],
                    ['text' => '🔄 Làm mới', 'callback_data' => 'menu_home'],
                ]
            ]
        ];

        $this->sendMessage($chatId, $html, $keyboard);
    }

    /**
     * Handle Callback Query from Inline Keyboards
     */
    public function handleCallbackQuery(array $callbackQuery)
    {
        $id = $callbackQuery['id'];
        $from = $callbackQuery['from'];
        $data = $callbackQuery['data'] ?? '';
        $message = $callbackQuery['message'];
        $chatId = $message['chat']['id'];
        $messageId = $message['message_id'];

        $user = $this->getOrCreateUser($from);

        if ($user->is_banned) {
            $this->answerCallbackQuery($id, '⛔ Tài khoản của bạn đã bị khóa!', true);
            return;
        }

        $this->answerCallbackQuery($id);

        // 1. Home / Start Menu
        if ($data === 'menu_home') {
            $user->update(['step' => null, 'step_data' => null]);
            $this->sendWelcomeMessage($chatId, $user);
            return;
        }

        // 2. Store / Categories List
        if ($data === 'menu_store') {
            $this->showCategories($chatId, $messageId);
            return;
        }

        // 3. Category Products List: "cat_{slug_or_id}"
        if (str_starts_with($data, 'cat_')) {
            $catId = substr($data, 4);
            $this->showCategoryProducts($chatId, $messageId, $catId);
            return;
        }

        // 4. Product Details: "prod_{id}"
        if (str_starts_with($data, 'prod_')) {
            $prodId = (int) substr($data, 5);
            $this->showProductDetail($chatId, $messageId, $prodId, $user);
            return;
        }

        // 5. Select Buy Quantity: "buy_{prodId}_{qty}"
        if (str_starts_with($data, 'buy_')) {
            $parts = explode('_', $data);
            $prodId = (int) ($parts[1] ?? 0);
            $qty = (int) ($parts[2] ?? 1);
            $this->prepareOrderConfirmation($chatId, $messageId, $prodId, $qty, $user);
            return;
        }

        // 6. Pay with Wallet: "pay_wallet_{orderId}"
        if (str_starts_with($data, 'pay_wallet_')) {
            $orderId = (int) substr($data, 11);
            $this->processWalletPayment($chatId, $messageId, $orderId, $user);
            return;
        }

        // 7. Pay with VietQR: "pay_vietqr_{orderId}"
        if (str_starts_with($data, 'pay_vietqr_')) {
            $orderId = (int) substr($data, 11);
            $this->sendVietQrPaymentScreen($chatId, $messageId, $orderId);
            return;
        }

        // 8. Check Payment Status: "check_order_{orderId}"
        if (str_starts_with($data, 'check_order_')) {
            $orderId = (int) substr($data, 12);
            $this->checkOrderPaymentStatus($chatId, $messageId, $orderId, $user);
            return;
        }

        // 9. Cancel Order: "cancel_order_{orderId}"
        if (str_starts_with($data, 'cancel_order_')) {
            $orderId = (int) substr($data, 13);
            $order = TelegramOrder::where('id', $orderId)->where('telegram_user_id', $user->id)->first();
            if ($order && $order->status === 'pending') {
                $order->update(['status' => 'cancelled']);
                
                $cancelText = "❌ <b>Đơn hàng #{$order->order_code} đã được hủy bỏ thành công.</b>\nBạn có thể quay lại cửa hàng để chọn gói sản phẩm khác!";
                $keyboard = [
                    'inline_keyboard' => [
                        [['text' => '🛒 Tiếp tục mua sắm', 'callback_data' => 'menu_store']],
                        [['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']],
                    ]
                ];

                // If message has photo, edit caption; otherwise edit text
                if (isset($message['photo'])) {
                    $this->editMessageCaption($chatId, $messageId, $cancelText, $keyboard);
                } else {
                    $this->editMessageText($chatId, $messageId, $cancelText, $keyboard);
                }
            } else {
                $this->answerCallbackQuery($id, 'Đơn hàng không tồn tại hoặc đã xử lý', true);
            }
            return;
        }

        // 10. Wallet Menu
        if ($data === 'menu_wallet') {
            $this->showWalletMenu($chatId, $messageId, $user);
            return;
        }

        // 11. Topup via VietQR: "topup_{amount}"
        if (str_starts_with($data, 'topup_')) {
            $amount = (int) substr($data, 6);
            if ($amount > 0) {
                $this->generateTopupQr($chatId, $messageId, $amount, $user);
            } else {
                // Enter custom amount
                $user->update(['step' => 'waiting_topup', 'step_data' => []]);
                $this->editMessageText($chatId, $messageId, "💳 <b>Nạp tiền tùy chọn</b>\n\nVui lòng nhập số tiền bạn muốn nạp vào ví (tối thiểu 10.000đ):\n<i>Ví dụ gõ: 50000</i>", [
                    'inline_keyboard' => [
                        [['text' => '⬅️ Quay lại', 'callback_data' => 'menu_wallet']]
                    ]
                ]);
            }
            return;
        }

        // 12. Profile Menu
        if ($data === 'menu_profile') {
            $this->showProfileMenu($chatId, $messageId, $user);
            return;
        }

        // 13. Orders History Menu
        if ($data === 'menu_orders') {
            $this->showOrdersHistory($chatId, $messageId, $user);
            return;
        }

        // 14. View Specific Order: "view_order_{id}"
        if (str_starts_with($data, 'view_order_')) {
            $orderId = (int) substr($data, 11);
            $this->showOrderDetailDelivered($chatId, $messageId, $orderId, $user);
            return;
        }

        // 15. Referral Program Menu
        if ($data === 'menu_referral') {
            $this->showReferralMenu($chatId, $messageId, $user);
            return;
        }

        // 16. Support Menu
        if ($data === 'menu_support') {
            $this->showSupportMenu($chatId, $messageId);
            return;
        }
    }

    /**
     * Show Categories Grid (2 or 3 columns)
     */
    public function showCategories($chatId, ?int $messageId = null)
    {
        $categories = TelegramCategory::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        $html = "🛒 <b>DANH MỤC SẢN PHẨM & DỊCH VỤ</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "Chọn danh mục sản phẩm bạn quan tâm để xem các gói và bảng giá chi tiết:";

        $buttons = [];
        $row = [];
        foreach ($categories as $index => $cat) {
            $icon = $cat->telegram_display_icon;
            $row[] = [
                'text' => "{$icon} {$cat->name}",
                'callback_data' => "cat_{$cat->id}"
            ];

            if (count($row) === 2) {
                $buttons[] = $row;
                $row = [];
            }
        }

        if (!empty($row)) {
            $buttons[] = $row;
        }

        $buttons[] = [
            ['text' => '🏠 Trang Chủ', 'callback_data' => 'menu_home'],
            ['text' => '🔄 Cập nhật', 'callback_data' => 'menu_store']
        ];

        $keyboard = ['inline_keyboard' => $buttons];

        if ($messageId) {
            $this->editMessageText($chatId, $messageId, $html, $keyboard);
        } else {
            $this->sendMessage($chatId, $html, $keyboard);
        }
    }

    /**
     * Show Products in Category
     */
    public function showCategoryProducts($chatId, int $messageId, $catId)
    {
        $category = TelegramCategory::with(['products' => function($q) {
            $q->where('is_active', true)->orderBy('sort_order', 'asc');
        }])->find($catId);

        if (!$category) {
            $this->showCategories($chatId, $messageId);
            return;
        }

        $catIcon = $category->telegram_display_icon;
        $html = "📂 <b>DANH MỤC: {$catIcon} " . htmlspecialchars($category->name) . "</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "Chọn gói sản phẩm bên dưới để xem chi tiết và mua hàng:";

        $buttons = [];

        foreach ($category->products as $p) {
            $stock = $p->stock_count;

            // Nếu sản phẩm hết hàng (stock <= 0) thì ẩn khỏi danh sách Bot
            if ($stock <= 0) {
                continue;
            }

            $stockBadge = "📦 {$stock}";
            $priceBadge = $p->formatted_price;

            $buttons[] = [
                [
                    'text' => "{$p->name} | {$priceBadge} | {$stockBadge}",
                    'callback_data' => "prod_{$p->id}"
                ]
            ];
        }

        if (empty($buttons)) {
            $html .= "\n\n<i>Hiện tại các sản phẩm thuộc danh mục này đang tạm hết hàng. Hệ thống sẽ tự động hiển thị lại khi kho được nạp thêm!</i>";
        }

        $buttons[] = [
            ['text' => '⬅️ Danh mục khác', 'callback_data' => 'menu_store'],
            ['text' => '🔄 Cập nhật', 'callback_data' => "cat_{$catId}"]
        ];

        $keyboard = ['inline_keyboard' => $buttons];
        $this->editMessageText($chatId, $messageId, $html, $keyboard);
    }

    /**
     * Show Product Detail Screen
     */
    public function showProductDetail($chatId, int $messageId, int $prodId, TelegramUser $user)
    {
        $product = TelegramProduct::with('category')->find($prodId);

        if (!$product) {
            $this->showCategories($chatId, $messageId);
            return;
        }

        $stock = $product->stock_count;
        $priceFormatted = number_format($product->price, 0, ',', '.') . 'đ';
        $sold = number_format($product->sold_count, 0, ',', '.');

        $catIcon = $product->category ? $product->category->telegram_display_icon : '📦';
        $html = "{$catIcon} <b>" . htmlspecialchars($product->name) . "</b>\n";
        $html .= "💵 <b>Giá:</b> {$priceFormatted}\n";
        $html .= "➕ <b>Tồn kho:</b> " . ($stock > 0 ? "{$stock} tài khoản" : "<b>Tạm hết hàng</b>") . "\n";
        $html .= "📊 <b>Đã bán:</b> {$sold} tài khoản\n\n";

        if ($product->description) {
            $html .= "<blockquote>📖 <b>Mô tả:</b>\n" . htmlspecialchars($product->description) . "</blockquote>\n\n";
        }

        $buttons = [];

        if ($stock > 0) {
            $html .= "✏️ <i>Vui lòng chọn nhanh số lượng muốn mua (hoặc gõ số lượng vào khung chat):</i>";

            // Save user step so they can also type a number in chat
            $user->update([
                'step' => 'waiting_qty',
                'step_data' => ['product_id' => $product->id]
            ]);

            $qtyRow = [];
            foreach ([1, 2, 5, 10] as $q) {
                if ($q <= $stock) {
                    $qtyRow[] = [
                        'text' => "Mua {$q}",
                        'callback_data' => "buy_{$product->id}_{$q}"
                    ];
                }
            }
            if (!empty($qtyRow)) {
                $buttons[] = $qtyRow;
            }
        } else {
            $html .= "⚠️ <i>Sản phẩm tạm thời hết tài khoản trong kho. Bạn hãy quay lại sau hoặc liên hệ Admin nhé!</i>";
        }

        $buttons[] = [
            ['text' => '⬅️ Quay lại danh sách', 'callback_data' => "cat_{$product->category_id}"],
            ['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']
        ];

        $keyboard = ['inline_keyboard' => $buttons];
        $this->editMessageText($chatId, $messageId, $html, $keyboard);
    }

    /**
     * Handle direct quantity typing from chat
     */
    public function handleQuantityInput(TelegramUser $user, string $text, $chatId)
    {
        $qty = (int) $text;
        $stepData = $user->step_data ?? [];
        $prodId = $stepData['product_id'] ?? null;

        if (!$prodId) {
            $user->update(['step' => null, 'step_data' => null]);
            $this->sendWelcomeMessage($chatId, $user);
            return;
        }

        $product = TelegramProduct::find($prodId);
        if (!$product) {
            $user->update(['step' => null, 'step_data' => null]);
            $this->sendMessage($chatId, "❌ Sản phẩm không tồn tại.");
            return;
        }

        $stock = $product->stock_count;
        if ($qty <= 0) {
            $this->sendMessage($chatId, "⚠️ Vui lòng nhập số lượng hợp lệ (từ 1 đến {$stock}):");
            return;
        }

        if ($qty > $stock) {
            $this->sendMessage($chatId, "⚠️ Số lượng bạn nhập vượt quá số lượng tồn kho ({$stock}). Vui lòng nhập lại số nhỏ hơn:");
            return;
        }

        // Reset step
        $user->update(['step' => null, 'step_data' => null]);
        $this->prepareOrderConfirmation($chatId, null, $prodId, $qty, $user);
    }

    /**
     * Prepare Order Confirmation Screen
     */
    public function prepareOrderConfirmation($chatId, ?int $messageId, int $prodId, int $qty, TelegramUser $user)
    {
        $product = TelegramProduct::find($prodId);
        if (!$product) {
            return;
        }

        $totalAmount = $product->price * $qty;
        
        // Generate unique order code e.g. TG1001
        $latestOrder = TelegramOrder::latest('id')->first();
        $nextId = ($latestOrder ? $latestOrder->id : 0) + 1;
        $orderCode = 'TG' . (1000 + $nextId);

        // Create pending order (expires in 5 minutes)
        $order = TelegramOrder::create([
            'order_code' => $orderCode,
            'telegram_user_id' => $user->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => $qty,
            'unit_price' => $product->price,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'expires_at' => now()->addMinutes(5),
        ]);

        $totalFormatted = number_format($totalAmount, 0, ',', '.') . 'đ';
        $userBalanceFormatted = number_format($user->balance, 0, ',', '.') . 'đ';

        $html = "🧾 <b>XÁC NHẬN ĐƠN HÀNG #{$order->order_code}</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "📦 <b>Sản phẩm:</b> " . htmlspecialchars($product->name) . "\n";
        $html .= "🔢 <b>Số lượng:</b> {$qty}\n";
        $html .= "💵 <b>Thành tiền:</b> {$totalFormatted}\n";
        $html .= "👛 <b>Số dư ví hiện tại:</b> {$userBalanceFormatted}\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "👇 <i>Vui lòng chọn phương thức thanh toán:</i>";

        $buttons = [
            [
                ['text' => '💰 Thanh toán qua ví', 'callback_data' => "pay_wallet_{$order->id}"],
            ],
            [
                ['text' => '🏦 Thanh toán ngay (VietQR)', 'callback_data' => "pay_vietqr_{$order->id}"],
            ],
            [
                ['text' => '❌ Hủy đơn', 'callback_data' => "cancel_order_{$order->id}"]
            ]
        ];

        $keyboard = ['inline_keyboard' => $buttons];

        if ($messageId) {
            $this->editMessageText($chatId, $messageId, $html, $keyboard);
        } else {
            $this->sendMessage($chatId, $html, $keyboard);
        }
    }

    /**
     * Process Payment via User's Wallet Balance
     */
    public function processWalletPayment($chatId, int $messageId, int $orderId, TelegramUser $user)
    {
        $order = TelegramOrder::where('id', $orderId)->where('telegram_user_id', $user->id)->first();
        if (!$order || $order->status !== 'pending') {
            $this->editMessageText($chatId, $messageId, "⚠️ Đơn hàng không khả dụng hoặc đã được xử lý.");
            return;
        }

        // Check 5 minutes expiration
        if ($order->expires_at && now()->gt($order->expires_at)) {
            $order->update(['status' => 'expired']);
            $this->editMessageText($chatId, $messageId, "⏰ <b>Đơn hàng #{$order->order_code} đã hết hạn (quá 5 phút)!</b>\nVui lòng quay lại cửa hàng để đặt đơn mới.", [
                'inline_keyboard' => [
                    [['text' => '🛒 Đặt lại đơn mới', 'callback_data' => 'menu_store']],
                    [['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']],
                ]
            ]);
            return;
        }

        // Re-read user balance
        $user->refresh();

        if ($user->balance < $order->total_amount) {
            $needed = $order->total_amount - $user->balance;
            $neededFormatted = number_format($needed, 0, ',', '.') . 'đ';
            $html = "⚠️ <b>Số dư ví không đủ để thanh toán!</b>\n";
            $html .= "Số dư hiện tại: <b>" . number_format($user->balance, 0, ',', '.') . "đ</b>\n";
            $html .= "Tổng đơn: <b>" . number_format($order->total_amount, 0, ',', '.') . "đ</b>\n";
            $html .= "Bạn còn thiếu: <b>{$neededFormatted}</b>\n\n";
            $html .= "Bạn có thể nạp thêm vào ví hoặc chọn thanh toán trực tiếp qua mã VietQR:";

            $keyboard = [
                'inline_keyboard' => [
                    [['text' => '🏦 Quét VietQR thanh toán ngay', 'callback_data' => "pay_vietqr_{$order->id}"]],
                    [['text' => '👛 Nạp thêm tiền vào ví', 'callback_data' => 'menu_wallet']],
                    [['text' => '❌ Hủy đơn', 'callback_data' => "cancel_order_{$order->id}"]]
                ]
            ];
            $this->editMessageText($chatId, $messageId, $html, $keyboard);
            return;
        }

        // Deduct wallet balance
        $balanceBefore = $user->balance;
        $user->decrement('balance', $order->total_amount);
        $user->increment('total_spent', $order->total_amount);

        // Record transaction
        TelegramTransaction::create([
            'telegram_user_id' => $user->id,
            'type' => 'purchase',
            'amount' => -$order->total_amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $user->balance,
            'description' => "Thanh toán đơn hàng #{$order->order_code} ({$order->product_name})",
            'reference_id' => $order->order_code,
        ]);

        $order->update([
            'payment_method' => 'wallet',
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        // Deliver accounts/keys
        $this->deliverOrder($order);
    }

    /**
     * Send VietQR Payment Screen with QR Code Image
     */
    public function sendVietQrPaymentScreen($chatId, int $messageId, int $orderId)
    {
        $order = TelegramOrder::find($orderId);
        if (!$order || $order->status !== 'pending') {
            $this->sendMessage($chatId, "⚠️ Đơn hàng không tồn tại hoặc đã được xử lý.");
            return;
        }

        $bankName = Setting::getValue('bank_name', 'MB Bank');
        $bankId = Setting::getValue('bank_id', 'MB');
        $bankAccountNo = Setting::getValue('bank_account_no', '0772698113');
        $bankAccountName = Setting::getValue('bank_account_name', 'TRAN THANH TUAN');

        // SePay / VietQR PNG Image URL
        $qrUrl = "https://qr.sepay.vn/img?bank={$bankId}&acc={$bankAccountNo}&template=compact&amount={$order->total_amount}&des={$order->order_code}";

        $amountFormatted = number_format($order->total_amount, 0, ',', '.') . 'đ';

        $caption = "💵 <b>Vui lòng chuyển khoản {$amountFormatted}</b>\n";
        $caption .= "🏦 Ngân hàng: <b>{$bankName} ({$bankId})</b>\n";
        $caption .= "💳 Số tài khoản: <code>{$bankAccountNo}</code>\n";
        $caption .= "👤 Tên chủ TK: <b>{$bankAccountName}</b>\n";
        $caption .= "📯 Mã đơn hàng (ghi chú): <code>{$order->order_code}</code>\n";
        $caption .= "⏳ Thời gian còn lại: <b>5 phút</b>\n\n";
        $caption .= "✅ <i>Sau khi chuyển thành công, bot sẽ tự động xác nhận và gửi tài khoản ngay lập tức!</i>";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '🔄 Kiểm tra thanh toán', 'callback_data' => "check_order_{$order->id}"],
                ],
                [
                    ['text' => '❌ Hủy đơn hàng', 'callback_data' => "cancel_order_{$order->id}"],
                    ['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']
                ]
            ]
        ];

        // Send photo with caption, fallback to message if photo fails
        $res = $this->sendPhoto($chatId, $qrUrl, $caption, $keyboard);
        if (!($res['ok'] ?? false)) {
            $fallbackText = $caption . "\n\n🔗 <b>Mã QR:</b> <a href=\"{$qrUrl}\">Bấm để xem ảnh QR</a>";
            $this->sendMessage($chatId, $fallbackText, $keyboard);
        }
    }

    /**
     * Check Order Payment Status button handler
     */
    public function checkOrderPaymentStatus($chatId, int $messageId, int $orderId, TelegramUser $user)
    {
        $order = TelegramOrder::find($orderId);
        if (!$order) {
            $this->sendMessage($chatId, "⚠️ Không tìm thấy đơn hàng.");
            return;
        }

        if ($order->status === 'completed') {
            $this->sendMessage($chatId, "✅ <b>Đơn hàng #{$order->order_code} đã được thanh toán thành công!</b>\nVui lòng kiểm tra tin nhắn nhận tài khoản bên trên hoặc vào mục '👁️ Lịch sử mua'.");
            return;
        }

        // Check 5 minutes expiration
        if ($order->status === 'pending' && $order->expires_at && now()->gt($order->expires_at)) {
            $order->update(['status' => 'expired']);
            $this->sendMessage($chatId, "⏰ <b>Đơn hàng #{$order->order_code} đã hết hạn (quá 5 phút)!</b>\nĐơn hàng đã tự động bị hủy do quá thời gian thanh toán. Vui lòng tạo đơn mới để tiếp tục.", [
                'inline_keyboard' => [
                    [['text' => '🛒 Mua lại sản phẩm', 'callback_data' => 'menu_store']],
                    [['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']],
                ]
            ]);
            return;
        }

        if ($order->status === 'expired' || $order->status === 'cancelled') {
            $this->sendMessage($chatId, "❌ Đơn hàng #{$order->order_code} đã bị hủy do hết hạn thanh toán (5 phút).");
            return;
        }

        $remainingSecs = max(0, now()->diffInSeconds($order->expires_at, false));
        $remainingMins = ceil($remainingSecs / 60);

        $this->sendMessage($chatId, "⏳ <b>Hệ thống đang chờ nhận tiền đơn hàng #{$order->order_code}...</b>\nThời gian còn lại: <b>{$remainingMins} phút</b>.\nNếu bạn vừa quét mã QR, vui lòng đợi 5-15 giây để ngân hàng và SePay đồng bộ giao dịch tự động.");
    }

    /**
     * Deliver digital product / account keys to buyer
     */
    public function deliverOrder(TelegramOrder $order)
    {
        $product = TelegramProduct::find($order->product_id);
        $user = TelegramUser::find($order->telegram_user_id);

        if (!$product || !$user) {
            return;
        }

        $deliveredItems = [];
        $canbosoOrderCode = null;
        $canbosoResponseRaw = null;

        // 1. DELIVERY TYPE: Auto Purchase via Canboso API
        if ($product->delivery_type === 'canboso_api' && $product->canboso_product_id) {
            $canbosoService = new \App\Services\CanbosoService();
            $purchaseRes = $canbosoService->purchase($product->canboso_product_id, $order->quantity);

            if ($purchaseRes['success'] ?? false) {
                $deliveredItems[] = $canbosoService->formatDeliveryContent($purchaseRes);
                $canbosoOrderCode = $purchaseRes['order']['orderCode'] ?? null;
                $canbosoResponseRaw = json_encode($purchaseRes['raw'] ?? []);
            } else {
                // If Canboso purchase failed (e.g. out of wallet or out of stock), alert Admin immediately and notify buyer
                $failMsg = $purchaseRes['message'] ?? 'Lỗi kết nối Canboso';
                \Illuminate\Support\Facades\Log::error("Canboso Auto Purchase Failed for Order #{$order->order_code}: {$failMsg}");

                $deliveredItems[] = "⚠️ Đơn hàng của bạn đang được hệ thống xử lý bổ sung. Kỹ thuật viên sẽ hỗ trợ gửi tài khoản cho bạn ngay lập tức!";
                
                // Alert Admin via Telegram with High Priority
                $alertMsg = "🚨 <b>[CẢNH BÁO: MUA CANBOSO THẤT BẠI]</b>\n";
                $alertMsg .= "━━━━━━━━━━━━━━━━━━━━\n";
                $alertMsg .= "Mã đơn khách: <b>#{$order->order_code}</b>\n";
                $alertMsg .= "Sản phẩm: <b>{$product->name}</b>\n";
                $alertMsg .= "Lý do: <code>{$failMsg}</code>\n";
                $alertMsg .= "👉 <i>Vui lòng kiểm tra lại số dư ví Canboso hoặc xử lý thủ công cho khách!</i>";
                $this->notifyAdmin($alertMsg);
            }
        } elseif ($product->delivery_type === 'key_stock') {
            // Pick available keys from stock
            $keys = TelegramProductKey::where('product_id', $product->id)
                ->where('is_used', false)
                ->take($order->quantity)
                ->get();

            foreach ($keys as $k) {
                $k->update([
                    'is_used' => true,
                    'used_by_order_id' => $order->id,
                ]);
                $deliveredItems[] = $k->account_data;
            }

            // If stock was short, generate dynamic backup keys
            if (count($deliveredItems) < $order->quantity) {
                $short = $order->quantity - count($deliveredItems);
                for ($i = 0; $i < $short; $i++) {
                    $genKey = strtoupper(Str::slug($product->name)) . '-' . strtoupper(Str::random(6)) . '-' . strtoupper(Str::random(6));
                    $deliveredItems[] = $genKey;
                }
            }
        } elseif ($product->delivery_type === 'static_text') {
            $deliveredItems[] = $product->static_content ?: "Vui lòng liên hệ Admin để được hỗ trợ cấp quyền.";
        } else {
            $deliveredItems[] = "Đơn hàng của bạn đang được kỹ thuật viên xử lý và gửi thông tin trong ít phút.";
        }

        $deliveredDataStr = implode("\n", $deliveredItems);

        $order->update([
            'delivered_data' => $deliveredDataStr,
            'canboso_order_code' => $canbosoOrderCode,
            'canboso_response' => $canbosoResponseRaw,
            'status' => 'completed',
            'paid_at' => $order->paid_at ?: now(),
        ]);

        $product->increment('sold_count', $order->quantity);

        // Send delivery message to customer
        $html = "🎉 <b>THANH TOÁN THÀNH CÔNG! GIAO HÀNG TỰ ĐỘNG</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "🧾 <b>Mã đơn:</b> <code>#{$order->order_code}</code>\n";
        $html .= "📦 <b>Sản phẩm:</b> {$product->name}\n";
        $html .= "🔢 <b>Số lượng:</b> {$order->quantity}\n";
        $html .= "💵 <b>Tổng thanh toán:</b> " . number_format($order->total_amount, 0, ',', '.') . "đ\n\n";
        $html .= "🔑 <b>THÔNG TIN TÀI KHOẢN / KEY BẢN QUYỀN:</b>\n";
        $html .= "<code>" . htmlspecialchars($deliveredDataStr) . "</code>\n\n";

        if ($product->guide_text) {
            $html .= "<blockquote>📖 <b>Hướng dẫn kích hoạt / sử dụng:</b>\n" . htmlspecialchars($product->guide_text) . "</blockquote>\n\n";
        }

        $adminTelegram = Setting::getValue('telegram_support_admin', '@specademy');
        $html .= "🛡️ <i>Bảo hành & Hỗ trợ kỹ thuật 24/7 qua Admin: {$adminTelegram}</i>\n";
        $html .= "Cảm ơn bạn đã tin tưởng ủng hộ hệ thống!";

        $keyboard = [
            'inline_keyboard' => [
                [['text' => '👁️ Xem lịch sử đơn', 'callback_data' => 'menu_orders']],
                [['text' => '🛒 Mua thêm sản phẩm khác', 'callback_data' => 'menu_store']],
                [['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']],
            ]
        ];

        $this->sendMessage($user->telegram_id, $html, $keyboard);

        // Process Referral Commission
        $this->processReferralCommission($user, $order);

        // Notify Admin: Order Completed
        $userHandle = $user->username ? "@{$user->username}" : "Không có";
        $paymentType = ($order->payment_method === 'wallet') ? 'Ví số dư Bot' : 'VietQR / SePay';
        
        $adminAlert = "🛒 <b>[ĐƠN HÀNG MỚI THÀNH CÔNG]</b>\n";
        $adminAlert .= "━━━━━━━━━━━━━━━━━━━━\n";
        $adminAlert .= "🧾 Mã đơn: <b>#{$order->order_code}</b>\n";
        $adminAlert .= "👤 Khách mua: <b>" . htmlspecialchars($user->full_name) . "</b> ({$userHandle} | ID: <code>{$user->telegram_id}</code>)\n";
        $adminAlert .= "📦 Sản phẩm: <b>{$order->product_name}</b> (x{$order->quantity})\n";
        $adminAlert .= "💵 Tổng tiền: <b>" . number_format($order->total_amount, 0, ',', '.') . "đ</b>\n";
        $adminAlert .= "💳 Thanh toán qua: <b>{$paymentType}</b>\n";
        $adminAlert .= "🔑 Key/Acc đã giao: <code>" . Str::limit($order->delivered_data, 60) . "</code>\n";
        $adminAlert .= "⏰ Thời gian: " . now()->format('d/m/Y H:i:s');

        $this->notifyAdmin($adminAlert);
    }

    /**
     * Process Referral Commission for Referrer
     */
    public function processReferralCommission(TelegramUser $buyer, TelegramOrder $order)
    {
        if (!$buyer->referred_by) {
            return;
        }

        $referrer = TelegramUser::where('telegram_id', $buyer->referred_by)->first();
        if (!$referrer) {
            return;
        }

        $commissionPercent = (int) Setting::getValue('telegram_ref_commission', 10);
        if ($commissionPercent <= 0) {
            return;
        }

        $commissionAmount = (int) round(($order->total_amount * $commissionPercent) / 100);
        if ($commissionAmount <= 0) {
            return;
        }

        // Add commission to referrer's wallet
        $balanceBefore = $referrer->balance;
        $referrer->increment('balance', $commissionAmount);

        TelegramTransaction::create([
            'telegram_user_id' => $referrer->id,
            'type' => 'referral_bonus',
            'amount' => $commissionAmount,
            'balance_before' => $balanceBefore,
            'balance_after' => $referrer->balance,
            'description' => "Hoa hồng giới thiệu {$commissionPercent}% từ đơn hàng #{$order->order_code} của " . $buyer->full_name,
            'reference_id' => $order->order_code,
        ]);

        $commFormatted = number_format($commissionAmount, 0, ',', '.') . 'đ';
        $refBalanceFormatted = number_format($referrer->balance, 0, ',', '.') . 'đ';

        $refMsg = "🎁 <b>BẠN NHẬN ĐƯỢC HOA HỒNG GIỚI THIỆU!</b>\n";
        $refMsg .= "━━━━━━━━━━━━━━━━━━━━\n";
        $refMsg .= "Thành viên <b>" . htmlspecialchars($buyer->full_name) . "</b> vừa hoàn thành đơn hàng <b>#{$order->order_code}</b>.\n";
        $refMsg .= "💵 Hoa hồng nhận được (+{$commissionPercent}%): <b>+{$commFormatted}</b>\n";
        $refMsg .= "👛 Số dư ví hiện tại: <b>{$refBalanceFormatted}</b>\n";
        $refMsg .= "Bạn có thể sử dụng số dư này để mua hàng hoặc tích lũy bất cứ lúc nào!";

        $this->sendMessage($referrer->telegram_id, $refMsg);

        // Notify Admin: Referral Commission Alert
        $adminAlert = "🎁 <b>[HOA HỒNG GIỚI THIỆU ĐƯỢC CỘNG]</b>\n";
        $adminAlert .= "━━━━━━━━━━━━━━━━━━━━\n";
        $adminAlert .= "👤 Người giới thiệu: <b>" . htmlspecialchars($referrer->full_name) . "</b> (ID: <code>{$referrer->telegram_id}</code>)\n";
        $adminAlert .= "👤 Khách mua hàng: <b>" . htmlspecialchars($buyer->full_name) . "</b> (ID: <code>{$buyer->telegram_id}</code>)\n";
        $adminAlert .= "🧾 Từ đơn hàng: <b>#{$order->order_code}</b> (" . number_format($order->total_amount, 0, ',', '.') . "đ)\n";
        $adminAlert .= "💵 Số tiền hoa hồng (+{$commissionPercent}%): <b>+{$commFormatted}</b>\n";
        $adminAlert .= "👛 Số dư ví người nhận: <b>{$refBalanceFormatted}</b>\n";
        $adminAlert .= "⏰ Thời gian: " . now()->format('d/m/Y H:i:s');

        $this->notifyAdmin($adminAlert);
    }

    /**
     * Show Wallet Menu
     */
    public function showWalletMenu($chatId, int $messageId, TelegramUser $user)
    {
        $user->refresh();
        $balanceFormatted = number_format($user->balance, 0, ',', '.') . 'đ';
        $spentFormatted = number_format($user->total_spent, 0, ',', '.') . 'đ';

        $html = "👛 <b>VÍ ĐIỆN TỬ CỦA BẠN</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "👤 Chủ sở hữu: <b>" . htmlspecialchars($user->full_name) . "</b>\n";
        $html .= "💰 <b>Số dư khả dụng:</b> <tg-spoiler>{$balanceFormatted}</tg-spoiler> <b>({$balanceFormatted})</b>\n";
        $html .= "📊 <b>Tổng đã chi tiêu:</b> {$spentFormatted}\n\n";
        $html .= "⚡ <i>Nạp tiền tự động 24/7 qua mã VietQR, tiền vào ví ngay sau 3 giây!</i>\n";
        $html .= "Chọn mệnh giá nạp nhanh bên dưới:";

        $buttons = [
            [
                ['text' => '➕ 20.000đ', 'callback_data' => 'topup_20000'],
                ['text' => '➕ 50.000đ', 'callback_data' => 'topup_50000'],
            ],
            [
                ['text' => '➕ 100.000đ', 'callback_data' => 'topup_100000'],
                ['text' => '➕ 200.000đ', 'callback_data' => 'topup_200000'],
            ],
            [
                ['text' => '➕ 500.000đ', 'callback_data' => 'topup_500000'],
                ['text' => '✏️ Nhập số khác', 'callback_data' => 'topup_0'],
            ],
            [
                ['text' => '🛒 Đi mua hàng ngay', 'callback_data' => 'menu_store'],
                ['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']
            ]
        ];

        $keyboard = ['inline_keyboard' => $buttons];
        $this->editMessageText($chatId, $messageId, $html, $keyboard);
    }

    /**
     * Generate VietQR for wallet top-up
     */
    public function generateTopupQr($chatId, ?int $messageId, int $amount, TelegramUser $user)
    {
        $bankName = Setting::getValue('bank_name', 'MB Bank');
        $bankId = Setting::getValue('bank_id', 'MB');
        $bankAccountNo = Setting::getValue('bank_account_no', '0772698113');
        $bankAccountName = Setting::getValue('bank_account_name', 'TRAN THANH TUAN');

        // Topup memo format: NAP{telegram_id}
        $transferMemo = 'NAP' . $user->telegram_id;

        // SePay / VietQR PNG Image URL
        $qrUrl = "https://qr.sepay.vn/img?bank={$bankId}&acc={$bankAccountNo}&template=compact&amount={$amount}&des={$transferMemo}";

        $amountFormatted = number_format($amount, 0, ',', '.') . 'đ';

        $caption = "💳 <b>YÊU CẦU NẠP TIỀN VÀO VÍ</b>\n";
        $caption .= "━━━━━━━━━━━━━━━━━━━━\n";
        $caption .= "💵 Số tiền: <b>{$amountFormatted}</b>\n";
        $caption .= "🏦 Ngân hàng: <b>{$bankName} ({$bankId})</b>\n";
        $caption .= "💳 Số tài khoản: <code>{$bankAccountNo}</code>\n";
        $caption .= "👤 Chủ tài khoản: <b>{$bankAccountName}</b>\n";
        $caption .= "📯 Nội dung chuyển khoản: <code>{$transferMemo}</code>\n\n";
        $caption .= "⚠️ <b>LƯU Ý QUAN TRỌNG:</b>\n";
        $caption .= "Vui lòng giữ nguyên nội dung chuyển khoản <code>{$transferMemo}</code> để hệ thống cộng tiền vào ví bạn tự động 100% trong 5-10 giây!";

        $keyboard = [
            'inline_keyboard' => [
                [['text' => '🔄 Làm mới số dư', 'callback_data' => 'menu_wallet']],
                [['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']]
            ]
        ];

        $res = $this->sendPhoto($chatId, $qrUrl, $caption, $keyboard);
        if (!($res['ok'] ?? false)) {
            $fallbackText = $caption . "\n\n🔗 <b>Mã QR:</b> <a href=\"{$qrUrl}\">Bấm để xem ảnh QR</a>";
            $this->sendMessage($chatId, $fallbackText, $keyboard);
        }
    }

    /**
     * Handle custom topup amount typed by user
     */
    public function handleTopupInput(TelegramUser $user, string $text, $chatId)
    {
        $amount = (int) preg_replace('/[^0-9]/', '', $text);
        if ($amount < 10000) {
            $this->sendMessage($chatId, "⚠️ Số tiền nạp tối thiểu là 10.000đ. Vui lòng nhập lại:");
            return;
        }

        $user->update(['step' => null, 'step_data' => null]);
        $this->generateTopupQr($chatId, null, $amount, $user);
    }

    /**
     * Show Profile Menu
     */
    public function showProfileMenu($chatId, int $messageId, TelegramUser $user)
    {
        $user->refresh();
        $ordersCount = $user->orders()->where('status', 'completed')->count();
        $referralsCount = $user->referrals()->count();
        $totalCommission = TelegramTransaction::where('telegram_user_id', $user->id)
            ->where('type', 'referral_bonus')
            ->sum('amount');

        $html = "👤 <b>THÔNG TIN HỒ SƠ CỦA BẠN</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "🆔 Telegram ID: <code>{$user->telegram_id}</code>\n";
        $html .= "🏷️ Tên: <b>" . htmlspecialchars($user->full_name) . "</b>\n";
        if ($user->username) {
            $html .= "🔹 Username: @{$user->username}\n";
        }
        $html .= "👛 Số dư ví: <b>" . number_format($user->balance, 0, ',', '.') . "đ</b>\n";
        $html .= "📦 Đơn hàng đã mua: <b>{$ordersCount} đơn</b>\n";
        $html .= "💎 Tổng tiền đã chi: <b>" . number_format($user->total_spent, 0, ',', '.') . "đ</b>\n\n";
        $html .= "👥 <b>Hệ thống cộng tác viên:</b>\n";
        $html .= "• Số người đã giới thiệu: <b>{$referralsCount} người</b>\n";
        $html .= "• Tổng hoa hồng nhận được: <b>" . number_format($totalCommission, 0, ',', '.') . "đ</b>\n";
        $html .= "• Ngày tham gia: <i>" . $user->created_at->format('d/m/Y H:i') . "</i>";

        $keyboard = [
            'inline_keyboard' => [
                [['text' => '👛 Nạp tiền vào ví', 'callback_data' => 'menu_wallet']],
                [['text' => '👁️ Lịch sử mua hàng', 'callback_data' => 'menu_orders']],
                [['text' => '🎁 Lấy link giới thiệu', 'callback_data' => 'menu_referral']],
                [['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']],
            ]
        ];

        $this->editMessageText($chatId, $messageId, $html, $keyboard);
    }

    /**
     * Show Orders History
     */
    public function showOrdersHistory($chatId, int $messageId, TelegramUser $user)
    {
        $orders = $user->orders()->latest('id')->take(8)->get();

        $html = "👁️ <b>LỊCH SỬ ĐƠN HÀNG CỦA BẠN</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";

        if ($orders->isEmpty()) {
            $html .= "<i>Bạn chưa có đơn hàng nào trên hệ thống.</i>\n";
            $html .= "Hãy trải nghiệm mua sắm ngay các tài khoản AI chất lượng cao!";
        } else {
            $html .= "Bấm vào từng đơn hàng bên dưới để xem lại thông tin tài khoản và key bản quyền:";
        }

        $buttons = [];
        foreach ($orders as $ord) {
            $statusEmoji = ($ord->status === 'completed') ? '✅' : (($ord->status === 'pending') ? '⏳' : '❌');
            $buttons[] = [
                [
                    'text' => "{$statusEmoji} #{$ord->order_code} - {$ord->product_name} (" . number_format($ord->total_amount, 0, ',', '.') . "đ)",
                    'callback_data' => "view_order_{$ord->id}"
                ]
            ];
        }

        $buttons[] = [
            ['text' => '🛒 Mua thêm sản phẩm', 'callback_data' => 'menu_store'],
            ['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']
        ];

        $keyboard = ['inline_keyboard' => $buttons];
        $this->editMessageText($chatId, $messageId, $html, $keyboard);
    }

    /**
     * Show Order Detail with delivered data
     */
    public function showOrderDetailDelivered($chatId, int $messageId, int $orderId, TelegramUser $user)
    {
        $order = TelegramOrder::where('id', $orderId)->where('telegram_user_id', $user->id)->first();
        if (!$order) {
            $this->showOrdersHistory($chatId, $messageId, $user);
            return;
        }

        $html = "🧾 <b>CHI TIẾT ĐƠN HÀNG #{$order->order_code}</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "📦 Sản phẩm: <b>{$order->product_name}</b>\n";
        $html .= "🔢 Số lượng: <b>{$order->quantity}</b>\n";
        $html .= "💵 Tổng tiền: <b>" . number_format($order->total_amount, 0, ',', '.') . "đ</b>\n";
        $html .= "💳 Hình thức: <b>" . strtoupper($order->payment_method) . "</b>\n";
        $html .= "🚦 Trạng thái: <b>" . strtoupper($order->status) . "</b>\n";
        $html .= "🕒 Thời gian: <i>" . $order->created_at->format('d/m/Y H:i:s') . "</i>\n\n";

        if ($order->status === 'completed' && $order->delivered_data) {
            $html .= "🔑 <b>TÀI KHOẢN / KEY BẢN QUYỀN ĐÃ GIAO:</b>\n";
            $html .= "<code>" . htmlspecialchars($order->delivered_data) . "</code>\n\n";
        } elseif ($order->status === 'pending') {
            $html .= "⏳ <i>Đơn hàng đang chờ thanh toán. Bấm nút bên dưới để thanh toán ngay:</i>\n\n";
        }

        $buttons = [];
        if ($order->status === 'pending') {
            $buttons[] = [
                ['text' => '🏦 Thanh toán ngay', 'callback_data' => "pay_vietqr_{$order->id}"],
                ['text' => '💰 Trừ ví', 'callback_data' => "pay_wallet_{$order->id}"]
            ];
        }

        $buttons[] = [
            ['text' => '⬅️ Quay lại danh sách', 'callback_data' => 'menu_orders'],
            ['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']
        ];

        $keyboard = ['inline_keyboard' => $buttons];
        $this->editMessageText($chatId, $messageId, $html, $keyboard);
    }

    /**
     * Show Referral Menu
     */
    public function showReferralMenu($chatId, int $messageId, TelegramUser $user)
    {
        $botUsername = Setting::getValue('telegram_bot_username', 'tap_hoa_ai_gia_re_bot');
        $commission = Setting::getValue('telegram_ref_commission', '10');
        $refLink = "https://t.me/{$botUsername}?start=ref_{$user->telegram_id}";

        $totalMembers = $user->referrals()->count();
        $totalCommission = TelegramTransaction::where('telegram_user_id', $user->id)
            ->where('type', 'referral_bonus')
            ->sum('amount');

        $html = "🎁 <b>CHƯƠNG TRÌNH GIỚI THIỆU BẠN BÈ</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "• Chia sẻ link bot kèm mã giới thiệu của bạn.\n";
        $html .= "• Khi người được mời phát sinh đơn hàng, bạn nhận ngay <b>{$commission}%</b> giá trị đơn vào ví tiền mặt.\n";
        $html .= "• Rút tiền hoặc dùng mua sắm trực tiếp trên bot 24/7.\n";
        $html .= "• Không giới hạn số lượng người mời.\n\n";
        $html .= "📊 <b>Thống kê của bạn:</b>\n";
        $html .= "• Thành viên đã mời: <b>{$totalMembers} người</b>\n";
        $html .= "• Hoa hồng đã nhận: <b>" . number_format($totalCommission, 0, ',', '.') . "đ</b>\n\n";
        $html .= "📎 <b>Link giới thiệu của bạn:</b>\n";
        $html .= "<code>{$refLink}</code>";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '📲 Chia sẻ cho bạn bè', 'url' => "https://t.me/share/url?url=" . urlencode($refLink) . "&text=" . urlencode("Ghé thăm Cửa hàng Tài Khoản AI Giá Rẻ - Mua tài khoản CapCut, ChatGPT, Canva tự động 24/7!")]
                ],
                [
                    ['text' => '👛 Xem ví hoa hồng', 'callback_data' => 'menu_wallet'],
                    ['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']
                ]
            ]
        ];

        $this->editMessageText($chatId, $messageId, $html, $keyboard);
    }

    /**
     * Show Support Menu
     */
    public function showSupportMenu($chatId, int $messageId)
    {
        $adminTelegram = Setting::getValue('telegram_support_admin', '@specademy');
        $phone1 = Setting::getValue('telegram_support_phone', '0772698113');
        $phone2 = Setting::getValue('telegram_support_phone_2', '0708910952');
        $websites = Setting::getValue('telegram_support_websites', 'dungthu.com | aicuatoi.com | aicuatoi.net | vpnstore.pro');

        $html = "☎️ <b>TRUNG TÂM HỖ TRỢ KHÁCH HÀNG 24/7</b>\n";
        $html .= "━━━━━━━━━━━━━━━━━━━━\n";
        $html .= "Nếu bạn gặp sự cố khi thanh toán, cần bảo hành tài khoản, hoặc cần giải đáp thắc mắc, vui lòng liên hệ:\n\n";
        $html .= "📞 <b>Zalo Hotline 1:</b> <code>{$phone1}</code>\n";
        if ($phone2) {
            $html .= "📞 <b>Zalo Hotline 2:</b> <code>{$phone2}</code>\n";
        }
        $html .= "💬 <b>Telegram Hỗ Trợ:</b> {$adminTelegram}\n";
        $html .= "🌐 <b>Hệ thống Website:</b>\n{$websites}\n\n";
        $html .= "⏰ <i>Đội ngũ hỗ trợ trực 24/7, phản hồi trong vòng 5 phút!</i>";

        $cleanAdminHandle = ltrim($adminTelegram, '@');

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '💬 Nhắn tin Telegram Admin', 'url' => "https://t.me/{$cleanAdminHandle}"]
                ],
                [
                    ['text' => '🛒 Tiếp tục mua sắm', 'callback_data' => 'menu_store'],
                    ['text' => '🏠 Trang chủ', 'callback_data' => 'menu_home']
                ]
            ]
        ];

        $this->editMessageText($chatId, $messageId, $html, $keyboard);
    }

    /**
     * Set Webhook URL on Telegram
     */
    public function setWebhook(string $url)
    {
        return $this->sendRequest('setWebhook', ['url' => $url]);
    }

    /**
     * Delete Webhook on Telegram
     */
    public function deleteWebhook()
    {
        return $this->sendRequest('deleteWebhook');
    }

    /**
     * Get Webhook Info
     */
    public function getWebhookInfo()
    {
        return $this->sendRequest('getWebhookInfo');
    }

    /**
     * Get Bot Info (getMe)
     */
    public function getMe()
    {
        return $this->sendRequest('getMe');
    }
}
