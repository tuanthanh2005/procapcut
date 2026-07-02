<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;

use App\Models\Product;

Route::get('/sitemap.xml', function () {
    $products = \App\Models\Product::all();
    $posts = \App\Models\Post::where('is_published', true)->get();

    return response()->view('sitemap', [
        'products' => $products,
        'posts' => $posts,
    ])->header('Content-Type', 'text/xml');
});

Route::get('/', function () {
    $showcaseProducts = Product::whereIn('slug', ['capcut', 'chatgpt', 'gemini', 'canva'])->get();
    if ($showcaseProducts->isEmpty()) {
        $showcaseProducts = Product::take(4)->get();
    }

    $products = Product::whereIn('slug', ['capcut', 'chatgpt', 'canva'])->get();
    if ($products->isEmpty()) {
        $products = Product::take(3)->get();
    }

    return view('welcome', compact('showcaseProducts', 'products'));
});

Route::get('/products', function () {
    $products = Product::paginate(10);
    return view('products', compact('products'));
})->name('products.index');

Route::get('/product/{slug}', function ($slug) {
    $product = Product::where('slug', $slug)->first();
    if (!$product) {
        $product = Product::first();
        if (!$product) {
            return redirect('/');
        }
        return redirect()->route('product.show', $product->slug);
    }
    $related = Product::where('slug', '!=', $product->slug)->take(4)->get();
    return view('product-detail', compact('product', 'related', 'slug'));
})->name('product.show');

// Posts routes
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/post/{slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/api/auth/callback/google', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

// User authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/api/cart/sync', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'cart_items' => 'nullable|array',
        ]);
        auth()->user()->update([
            'cart_items' => $request->cart_items
        ]);
        return response()->json(['success' => true]);
    });
});

// Admin Protected Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin-dashboard');
    })->name('dashboard');

    Route::resource('products', \App\Http\Controllers\AdminProductController::class);
    Route::resource('posts', \App\Http\Controllers\AdminPostController::class);
    Route::post('/posts/generate-ai', [\App\Http\Controllers\AdminPostController::class, 'generateAI'])->name('posts.generateAI');
    
    // Admin orders management routes
    Route::get('/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Admin customers management routes
    Route::get('/customers', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('customers.index');
    Route::post('/customers/{id}/toggle-block', [\App\Http\Controllers\AdminUserController::class, 'toggleBlock'])->name('customers.toggleBlock');
    Route::put('/customers/{id}/role', [\App\Http\Controllers\AdminUserController::class, 'updateRole'])->name('customers.updateRole');

    // Admin settings routes
    Route::get('/settings', [\App\Http\Controllers\AdminSettingsController::class, 'show'])->name('settings.show');
    Route::put('/settings', [\App\Http\Controllers\AdminSettingsController::class, 'update'])->name('settings.update');

    // Admin SEO routes
    Route::get('/seo', [\App\Http\Controllers\AdminSeoController::class, 'index'])->name('seo.index');
    Route::post('/seo/index-urls', [\App\Http\Controllers\AdminSeoController::class, 'indexUrls'])->name('seo.indexUrls');

    // Admin Chat routes
    Route::get('/chat', function () {
        return view('admin.chat');
    })->name('chat.index');
    
    Route::get('/api/chat/conversations', function () {
        $conversations = \App\Models\ChatMessage::select('user_id', 'session_id')
            ->selectRaw('MAX(created_at) as last_message_at')
            ->groupBy('user_id', 'session_id')
            ->orderBy('last_message_at', 'desc')
            ->get()
            ->map(function ($convo) {
                $name = 'Khách viếng thăm';
                $email = 'Chưa đăng nhập';
                $avatar = null;
                
                if ($convo->user_id) {
                    $user = \App\Models\User::find($convo->user_id);
                    if ($user) {
                        $name = $user->name;
                        $email = $user->email;
                        $avatar = $user->avatar;
                    }
                } else {
                    $name = 'Khách hàng #' . substr($convo->session_id, 0, 6);
                }
                
                $latestMsg = \App\Models\ChatMessage::where(function($q) use ($convo) {
                        if ($convo->user_id) {
                            $q->where('user_id', $convo->user_id);
                        } else {
                            $q->where('session_id', $convo->session_id)->whereNull('user_id');
                        }
                    })
                    ->orderBy('created_at', 'desc')
                    ->first();
                
                // Fetch AI state for this conversation
                $convoRecord = \App\Models\ChatConversation::where(function($q) use ($convo) {
                        if ($convo->user_id) {
                            $q->where('user_id', $convo->user_id);
                        } else {
                            $q->where('session_id', $convo->session_id)->whereNull('user_id');
                        }
                    })->first();
                $isAiEnabled = $convoRecord ? (bool)$convoRecord->is_ai_enabled : true;
                
                return [
                    'user_id' => $convo->user_id,
                    'session_id' => $convo->session_id,
                    'name' => $name,
                    'email' => $email,
                    'avatar' => $avatar,
                    'latest_message' => $latestMsg ? $latestMsg->message : '',
                    'latest_message_sender' => $latestMsg ? $latestMsg->sender : '',
                    'last_message_at' => $convo->last_message_at ? \Carbon\Carbon::parse($convo->last_message_at)->toIso8601String() : null,
                    'is_unread' => $latestMsg ? ($latestMsg->sender === 'user' && !$latestMsg->is_read) : false,
                    'is_ai_enabled' => $isAiEnabled,
                ];
            });
            
        return response()->json($conversations);
    });
    
    Route::get('/api/chat/conversation/messages', function (\Illuminate\Http\Request $request) {
        $userId = $request->query('user_id');
        $sessionId = $request->query('session_id');
        
        if ($userId && $userId !== 'null') {
            $messages = \App\Models\ChatMessage::where('user_id', $userId)
                ->orderBy('created_at', 'asc')
                ->get();
            \App\Models\ChatMessage::where('user_id', $userId)->where('sender', 'user')->update(['is_read' => true]);
        } else {
            $messages = \App\Models\ChatMessage::where('session_id', $sessionId)
                ->whereNull('user_id')
                ->orderBy('created_at', 'asc')
                ->get();
            \App\Models\ChatMessage::where('session_id', $sessionId)->whereNull('user_id')->where('sender', 'user')->update(['is_read' => true]);
        }
        
        return response()->json($messages);
    });
    
    Route::post('/api/chat/conversation/reply', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        
        $userId = $request->input('user_id');
        $sessionId = $request->input('session_id');
        
        if ($userId === 'null') {
            $userId = null;
        }
        
        $msg = \App\Models\ChatMessage::create([
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
            'sender' => 'admin',
            'message' => $request->message,
            'is_read' => false,
        ]);
        
        return response()->json($msg);
    });

    Route::post('/api/chat/conversation/toggle-ai', function (\Illuminate\Http\Request $request) {
        $userId = $request->input('user_id');
        $sessionId = $request->input('session_id');
        $isAiEnabled = (bool)$request->input('is_ai_enabled');
        
        if ($userId === 'null') {
            $userId = null;
        }
        
        $convo = \App\Models\ChatConversation::updateOrCreate(
            $userId ? ['user_id' => $userId] : ['session_id' => $sessionId, 'user_id' => null],
            ['is_ai_enabled' => $isAiEnabled]
        );
        
        return response()->json(['success' => true, 'is_ai_enabled' => $convo->is_ai_enabled]);
    });
});

// User Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [\App\Http\Controllers\UserController::class, 'orders'])->name('orders.index');
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile.edit');
    Route::post('/profile', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    
    // Client Checkout routes
    Route::get('/checkout', [\App\Http\Controllers\OrderController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [\App\Http\Controllers\OrderController::class, 'placeOrder']);
    Route::get('/checkout/thankyou/{id}', [\App\Http\Controllers\OrderController::class, 'thankYou'])->name('checkout.thankyou');
    Route::get('/checkout/success/{id}', [\App\Http\Controllers\OrderController::class, 'success'])->name('checkout.success');
    Route::get('/api/orders/{id}/status', [\App\Http\Controllers\OrderController::class, 'getStatus']);
    Route::post('/api/orders/{id}/cancel', [\App\Http\Controllers\OrderController::class, 'cancel']);

    // Review store route
    Route::post('/product/{id}/review', function (\Illuminate\Http\Request $request, $id) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5',
        ]);
        
        $product = \App\Models\Product::findOrFail($id);
        
        \App\Models\Review::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        // Recalculate average rating & review count using a base of 50 reviews of 5.0 stars
        $reviews = $product->reviews();
        $dbCount = $reviews->count();
        $dbSum = $reviews->sum('rating');
        
        $baseCount = 50; // base reviews of 5 stars by default
        $baseSum = 50 * 5.0;
        
        $totalCount = $dbCount + $baseCount;
        $totalSum = $dbSum + $baseSum;
        
        $newRating = round($totalSum / $totalCount, 1);
        
        $product->update([
            'rating' => $newRating,
            'review_count' => $totalCount
        ]);
        
        return redirect()->back()->with('success_review', 'Cảm ơn bạn đã gửi đánh giá sản phẩm!');
    })->name('product.review.store');
});

// SePay webhook callback endpoint (public API)
Route::post('/webhook/sepay', [\App\Http\Controllers\SePayWebhookController::class, 'handle']);

// Groq AI Integration Helper
function getGroqResponse($userMessage, $history = [], $userId = null) {
    $apiKey = \App\Models\Setting::getValue('groq_api_key', env('GROQ_API_KEY'));
    $url = 'https://api.groq.com/openai/v1/chat/completions';
    
    // Load products from DB dynamically to ensure prices and options are always up-to-date
    $products = \App\Models\Product::all();
    $catalogStr = "";
    foreach ($products as $index => $p) {
        $catalogStr .= ($index + 1) . ". " . $p->name . " (Slug: " . $p->slug . "): ";
        $optsList = [];
        if (!empty($p->options)) {
            foreach ($p->options as $opt) {
                $optsList[] = $opt['name'] . " (Giá: " . number_format($opt['price']) . "đ)";
            }
        }
        $catalogStr .= implode(", ", $optsList) . ".\n";
    }

    // Smart Order Retrieval for AI Context
    $orderContext = "";
    $ordersToContext = collect();
    
    // 1. Regex to catch order codes like OD1010 or #OD1010
    if (preg_match('/(?:OD|#OD)\s*(\d{4,})/', strtoupper($userMessage), $matches)) {
        $orderId = (int)$matches[1] - 1000;
        $order = \App\Models\Order::find($orderId);
        if ($order) $ordersToContext->push($order);
    }
    
    // 2. Fetch user's recent orders if logged in
    if ($userId) {
        $userOrders = \App\Models\Order::where('user_id', $userId)->orderBy('created_at', 'desc')->take(3)->get();
        foreach ($userOrders as $uo) {
            if (!$ordersToContext->contains('id', $uo->id)) {
                $ordersToContext->push($uo);
            }
        }
    }

    if ($ordersToContext->isNotEmpty()) {
        $orderContext .= "\n\n--- DỮ LIỆU HỆ THỐNG VỀ ĐƠN HÀNG CỦA KHÁCH ---\n";
        foreach ($ordersToContext as $order) {
            $statusText = $order->status === 'completed' ? 'Thành công (Đã hoàn tất)' : ($order->status === 'cancelled' ? 'Đã hủy' : 'Đang chờ xử lý / Chờ thanh toán');
            $orderContext .= "Mã đơn: OD" . (1000 + $order->id) . "\n";
            $orderContext .= "- Sản phẩm: " . $order->product_name . " (" . number_format($order->price) . "đ)\n";
            $orderContext .= "- Trạng thái: " . $statusText . "\n";
            $orderContext .= "- Email/Tài khoản nâng cấp: " . $order->upgrade_details . "\n";
            if ($order->activation_key) {
                $orderContext .= "- Mã kích hoạt (License Key): " . $order->activation_key . "\n";
            }
        }
        $orderContext .= "----------------------------------------------\n";
        $orderContext .= "LƯU Ý QUAN TRỌNG CHO BẠN (AI): Dựa vào thông tin hệ thống cung cấp ở trên, hãy trả lời chính xác tình trạng đơn hàng nếu khách thắc mắc. (Ví dụ báo khách đã thanh toán thành công hay chưa, cung cấp mã kích hoạt nếu có...). Tuyệt đối không bịa ra thông tin đơn hàng nếu mã không có trong hệ thống.\n";
    }

    $systemPrompt = "Bạn là Trợ lý AI hỗ trợ khách hàng chính thức của website AI CỦA TÔI (aicuatoi.com). " .
                    "Nhiệm vụ của bạn là tư vấn chính xác, lịch sự, ngắn gọn về các sản phẩm/gói dịch vụ sau được lấy trực tiếp từ hệ thống Cửa hàng của chúng tôi:\n" .
                    $catalogStr . "\n" .
                    "Quy tắc trả lời:\n" .
                    "- Chỉ trả lời cực kỳ ngắn gọn, súc tích (khoảng 2-3 câu), đi thẳng vào câu hỏi của khách hàng.\n" .
                    "- Luôn xưng hô lịch sự, thân thiện, xưng 'Tôi' hoặc 'AI CỦA TÔI' và gọi khách là 'bạn'.\n" .
                    "- Khi khách hỏi về cách mua, thanh toán, bảo hành hoặc muốn gặp hỗ trợ viên thực tế, hãy nhắc họ click nút 'Nhắn Admin' trên màn hình hoặc nhắn tin trực tiếp qua Zalo: 0569012134 hoặc Telegram: @specademy để Admin kích hoạt trong 30 giây." .
                    $orderContext;
                    
    $messages = [
        ['role' => 'system', 'content' => $systemPrompt]
    ];
    
    // Add history if any
    foreach ($history as $h) {
        $messages[] = [
            'role' => $h['sender'] === 'user' ? 'user' : 'assistant',
            'content' => $h['message']
        ];
    }
    
    // Add current message
    $messages[] = ['role' => 'user', 'content' => $userMessage];
    
    $payload = [
        'model' => 'llama-3.1-8b-instant',
        'messages' => $messages,
        'temperature' => 0.7,
        'max_tokens' => 256
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        $data = json_decode($response, true);
        if (isset($data['choices'][0]['message']['content'])) {
            return $data['choices'][0]['message']['content'];
        }
    }
    
    return "Cảm ơn bạn đã nhắn tin! Hiện tại hỗ trợ viên đang bận, bạn vui lòng liên hệ trực tiếp Zalo: 0569012134 hoặc Telegram: @specademy để Admin hỗ trợ ngay lập tức nhé.";
}

// Rate-limited Telegram Alert Helper for Chat Messages
function sendTelegramChatAlert($convo, $latestMessageText, $alertType = 'chat') {
    $botToken = env('TELEGRAM_BOT_TOKEN');
    $chatId = env('TELEGRAM_CHAT_ID');
    if (empty($botToken) || empty($chatId)) {
        return;
    }

    // Cooldown check: 5 minutes (300 seconds)
    $cooldown = 300;
    if ($convo->last_telegram_alert_at) {
        $lastAlert = \Carbon\Carbon::parse($convo->last_telegram_alert_at);
        if ($lastAlert->diffInSeconds(now()) < $cooldown) {
            return;
        }
    }

    $clientName = 'Khách viếng thăm #' . substr($convo->session_id ?? $convo->id, 0, 6);
    if ($convo->user_id) {
        $user = \App\Models\User::find($convo->user_id);
        if ($user) {
            $clientName = $user->name . " (" . $user->email . ")";
        }
    }

    $chatState = $convo->is_ai_enabled ? "Đang trò chuyện với Trợ lý AI" : "Đang chờ hỗ trợ trực tiếp";
    if ($alertType === 'call_admin') {
        $chatState = "🔔 Yêu cầu kết nối trực tiếp với Hỗ trợ viên";
    }

    $text = "💬 <b>TIN NHẮN CHAT MỚI</b> 💬\n\n" .
            "👤 <b>Khách hàng</b>: " . e($clientName) . "\n" .
            "💬 <b>Tin nhắn mới nhất</b>: " . e($latestMessageText) . "\n" .
            "🔄 <b>Trạng thái</b>: " . $chatState . "\n\n" .
            "🔗 <b>Trả lời chat tại đây</b>: <a href=\"" . url('/admin/chat') . "?session_id=" . ($convo->session_id ?: 'null') . "&user_id=" . ($convo->user_id ?: 'null') . "\">Mở khung chat Admin</a>";

    try {
        \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML',
        ]);
        
        $convo->update(['last_telegram_alert_at' => now()]);
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Telegram chat alert failed: ' . $e->getMessage());
    }
}

// Client Chat API routes
Route::get('/api/chat/messages', function (\Illuminate\Http\Request $request) {
    $userId = auth()->id();
    $sessionId = $request->query('session_id');
    
    // Get AI enabled state to return to client
    $convo = \App\Models\ChatConversation::where(function($q) use ($userId, $sessionId) {
            if ($userId) {
                $q->where('user_id', $userId);
            } else {
                $q->where('session_id', $sessionId)->whereNull('user_id');
            }
        })->first();
    $isAiEnabled = $convo ? (bool)$convo->is_ai_enabled : true;
    
    $markRead = $request->query('mark_read') === 'true';
    
    if ($userId) {
        $messages = \App\Models\ChatMessage::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();
        if ($markRead) {
            \App\Models\ChatMessage::where('user_id', $userId)->where('sender', 'admin')->update(['is_read' => true]);
        }
    } elseif ($sessionId) {
        $messages = \App\Models\ChatMessage::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->orderBy('created_at', 'asc')
            ->get();
        if ($markRead) {
            \App\Models\ChatMessage::where('session_id', $sessionId)->whereNull('user_id')->where('sender', 'admin')->update(['is_read' => true]);
        }
    } else {
        return response()->json(['messages' => [], 'is_ai_enabled' => true]);
    }
    
    return response()->json([
        'messages' => $messages,
        'is_ai_enabled' => $isAiEnabled
    ]);
});

Route::post('/api/chat/messages', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'message' => 'required|string|max:1000',
        'session_id' => 'required|string',
    ]);
    
    $userId = auth()->id();
    $sessionId = $request->session_id;
    
    // Find or create conversation
    $convo = \App\Models\ChatConversation::firstOrCreate(
        $userId ? ['user_id' => $userId] : ['session_id' => $sessionId, 'user_id' => null],
        ['is_ai_enabled' => true]
    );
    
    $msg = \App\Models\ChatMessage::create([
        'user_id' => $userId,
        'session_id' => $userId ? null : $sessionId,
        'sender' => 'user',
        'message' => $request->message,
        'is_read' => false,
    ]);

    // Send rate-limited Telegram alert
    sendTelegramChatAlert($convo, $request->message, 'chat');
    
    // If AI is enabled, trigger Groq AI completions and save reply
    if ($convo->is_ai_enabled) {
        $history = \App\Models\ChatMessage::where(function($q) use ($userId, $sessionId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                } else {
                    $q->where('session_id', $sessionId)->whereNull('user_id');
                }
            })
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get()
            ->reverse()
            ->toArray();
            
        $aiReply = getGroqResponse($request->message, $history, $userId);
        
        \App\Models\ChatMessage::create([
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
            'sender' => 'admin',
            'message' => $aiReply,
            'is_read' => false,
        ]);
    }
    
    return response()->json($msg);
});

// Client Call Admin via Telegram Alert
Route::post('/api/chat/call-admin', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'session_id' => 'required|string',
    ]);
    
    $userId = auth()->id();
    $sessionId = $request->session_id;
    
    // Find or create conversation
    $convo = \App\Models\ChatConversation::firstOrCreate(
        $userId ? ['user_id' => $userId] : ['session_id' => $sessionId, 'user_id' => null],
        ['is_ai_enabled' => true]
    );
    
    // Disable AI
    $convo->update(['is_ai_enabled' => false]);
    
    // Post System Message
    $systemMsg = "🔔 Hệ thống: Yêu cầu kết nối với Hỗ trợ viên đã được gửi. Chúng tôi đã tạm dừng AI cho cuộc hội thoại này. Admin đã nhận được thông báo qua Telegram và sẽ phản hồi bạn ngay!";
    
    \App\Models\ChatMessage::create([
        'user_id' => $userId,
        'session_id' => $userId ? null : $sessionId,
        'sender' => 'admin',
        'message' => $systemMsg,
        'is_read' => false,
    ]);
    
    // Send rate-limited Telegram Alert
    sendTelegramChatAlert($convo, "🔔 Yêu cầu kết nối trực tiếp với Hỗ trợ viên!", 'call_admin');
    
    return response()->json(['success' => true]);
});

// Client & Admin Image Upload Route
Route::post('/api/chat/upload', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // Max 10MB
    ]);
    
    $sender = $request->input('sender', 'user');
    
    if ($sender === 'admin') {
        $userId = $request->input('user_id');
        if ($userId === 'null') {
            $userId = null;
        }
        $sessionId = $request->input('session_id');
    } else {
        $userId = auth()->id();
        $sessionId = $request->input('session_id');
    }
    
    // Find or create conversation
    $convo = \App\Models\ChatConversation::firstOrCreate(
        $userId ? ['user_id' => $userId] : ['session_id' => $sessionId, 'user_id' => null],
        ['is_ai_enabled' => true]
    );
    
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // Save to public path
        $file->move(public_path('uploads/chats'), $filename);
        $imagePath = 'uploads/chats/' . $filename;
        
        $msg = \App\Models\ChatMessage::create([
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
            'sender' => $sender,
            'message' => $imagePath,
            'is_read' => false,
        ]);

        if ($sender === 'user') {
            // Send rate-limited Telegram alert
            sendTelegramChatAlert($convo, "🖼️ [Khách gửi một hình ảnh]", 'chat');
        }
        
        // If client uploads and AI is enabled, give a default AI acknowledgement
        if ($sender === 'user' && $convo->is_ai_enabled) {
            $aiReply = "Tôi đã nhận được hình ảnh của bạn. Vui lòng đợi trong giây lát hoặc nhấn nút 'Nhắn Admin' để được hỗ trợ trực tiếp nhé!";
            \App\Models\ChatMessage::create([
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
                'sender' => 'admin',
                'message' => $aiReply,
                'is_read' => false,
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => $msg
        ]);
    }
    
    return response()->json(['success' => false, 'error' => 'No file uploaded'], 400);
});

