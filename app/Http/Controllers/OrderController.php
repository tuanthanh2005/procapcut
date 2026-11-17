<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Show checkout page
    public function showCheckout()
    {
        return view('checkout');
    }

    // Process checkout form submission
    public function placeOrder(Request $request)
    {
        $cart = [];
        if ($request->filled('items_json')) {
            $cart = json_decode($request->items_json, true);
        }

        $requireEmail = false;
        if (is_array($cart)) {
            foreach ($cart as $item) {
                if (isset($item['require_email']) && ($item['require_email'] === true || $item['require_email'] === 'true')) {
                    $requireEmail = true;
                    break;
                }
            }
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:255',
            'upgrade_details' => $requireEmail ? 'required|string' : 'nullable|string',
            'payment_method' => 'required|string|in:qr_bank,momo,wallet',
            'items_json' => 'required|string', // JSON serialized cart array
        ], [
            'customer_name.required' => 'Họ tên không được để trống.',
            'customer_phone.required' => 'Số điện thoại không được để trống.',
            'customer_email.required' => 'Email không được để trống.',
            'upgrade_details.required' => 'Bạn cần nhập Email / Tên tài khoản nâng cấp chính chủ cho đơn hàng này.',
            'items_json.required' => 'Giỏ hàng đang trống.',
        ]);

        if (empty($cart)) {
            return back()->withErrors(['items_json' => 'Giỏ hàng của bạn đang trống. Hãy chọn sản phẩm trước.'])->withInput();
        }

        // Validate stock for each item in the cart
        foreach ($cart as $item) {
            if (! isset($item['id'])) {
                continue;
            }

            $product = Product::all()->first(function ($prod) use ($item) {
                if (is_array($prod->options)) {
                    foreach ($prod->options as $opt) {
                        if (isset($opt['id']) && $opt['id'] === $item['id']) {
                            return true;
                        }
                    }
                }

                return false;
            });

            if (! $product) {
                return back()->withErrors(['items_json' => 'Không tìm thấy sản phẩm tương ứng với gói: '.($item['name'] ?? 'Không rõ')])->withInput();
            }

            $options = $product->options;
            $matchingOpt = null;
            foreach ($options as $opt) {
                if (isset($opt['id']) && $opt['id'] === $item['id']) {
                    $matchingOpt = $opt;
                    break;
                }
            }

            if (! $matchingOpt) {
                return back()->withErrors(['items_json' => 'Không tìm thấy gói: '.($item['name'] ?? 'Không rõ')])->withInput();
            }

            $stock = isset($matchingOpt['stock']) ? (int) $matchingOpt['stock'] : 0;
            $inStock = ! isset($matchingOpt['in_stock']) || $matchingOpt['in_stock'] !== false;

            if (! $inStock || $stock <= 0) {
                return back()->withErrors(['items_json' => 'Gói: '.($item['name'] ?? 'Không rõ').' đã hết hàng, không thể tiếp tục thanh toán.'])->withInput();
            }

            $reqQty = isset($item['quantity']) ? (int) $item['quantity'] : 1;
            if ($stock < $reqQty) {
                return back()->withErrors(['items_json' => 'Gói: '.($item['name'] ?? 'Không rõ').' chỉ còn lại '.$stock.' sản phẩm trong kho. Bạn đang yêu cầu mua '.$reqQty.' sản phẩm.'])->withInput();
            }
        }

        // Calculate total price and set product fallbacks for legacy compatibility
        $totalPrice = 0;
        $firstItemName = '';
        $firstItemIcon = 'fa-cube';

        foreach ($cart as $idx => $item) {
            $totalPrice += ($item['price'] * ($item['quantity'] ?? 1));
            if ($idx === 0) {
                // Example: CapCut Pro (Gói 1 Năm - Chính Chủ)
                $firstItemName = $item['name'];
                $firstItemIcon = strtok($item['icon'] ?? 'fa-cube', ' ');
            }
        }

        if (count($cart) > 1) {
            $firstItemName .= ' và '.(count($cart) - 1).' sản phẩm khác';
        }

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'upgrade_details' => $request->upgrade_details,
            'payment_method' => $request->payment_method,
            'items' => $cart,
            'product_name' => $firstItemName,
            'product_icon' => $firstItemIcon,
            'price' => $totalPrice,
            'status' => 'pending',
            'activation_key' => null,
        ]);

        // Deduct stock after order creation
        foreach ($cart as $item) {
            if (! isset($item['id'])) {
                continue;
            }

            $product = Product::all()->first(function ($prod) use ($item) {
                if (is_array($prod->options)) {
                    foreach ($prod->options as $opt) {
                        if (isset($opt['id']) && $opt['id'] === $item['id']) {
                            return true;
                        }
                    }
                }

                return false;
            });

            if ($product) {
                $options = $product->options;
                foreach ($options as $idx => $opt) {
                    if (isset($opt['id']) && $opt['id'] === $item['id']) {
                        $currentStock = isset($opt['stock']) ? (int) $opt['stock'] : 0;
                        $newStock = max(0, $currentStock - (isset($item['quantity']) ? (int) $item['quantity'] : 1));
                        $options[$idx]['stock'] = $newStock;
                        if ($newStock <= 0) {
                            $options[$idx]['in_stock'] = false; // set in_stock to false as well if stock hits 0
                        }
                        break;
                    }
                }
                $product->options = $options;
                $product->save();
            }
        }

        // If paying with Wallet Balance
        $isPaidWithWallet = false;
        if ($request->payment_method === 'wallet') {
            $user = Auth::user();
            if (!$user || $user->balance < $totalPrice) {
                return back()->withErrors([
                    'payment_method' => 'Số dư ví của bạn không đủ (' . number_format($user->balance ?? 0, 0, ',', '.') . 'đ) để thanh toán đơn hàng ' . number_format($totalPrice, 0, ',', '.') . 'đ. Vui lòng nạp thêm tiền vào ví hoặc chọn Chuyển khoản QR.'
                ])->withInput();
            }

            $balanceBefore = (int) ($user->balance ?? 0);
            $user->decrement('balance', $totalPrice);
            $user->increment('total_spent', $totalPrice);

            \Illuminate\Support\Facades\DB::table('wallet_transactions')->insert([
                'user_id' => $user->id,
                'type' => 'purchase',
                'amount' => $totalPrice,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceBefore - $totalPrice,
                'description' => "Thanh toán đơn hàng #OD" . (1000 + $order->id) . " ({$firstItemName})",
                'payment_method' => 'wallet',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $prefix = 'KEY';
            if (str_contains(strtolower($order->product_name), 'capcut')) {
                $prefix = 'CAPCUT-PRO';
            } elseif (str_contains(strtolower($order->product_name), 'gpt')) {
                $prefix = 'GPT-PLUS';
            } elseif (str_contains(strtolower($order->product_name), 'canva')) {
                $prefix = 'CANVA-PRO';
            }
            $activationKey = $prefix . '-' . strtoupper(\Illuminate\Support\Str::random(5)) . '-' . strtoupper(\Illuminate\Support\Str::random(5));

            $order->update([
                'status' => 'processing',
                'activation_key' => $activationKey,
            ]);
            $isPaidWithWallet = true;
        }

        // Send Telegram Alert for new order
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');
        if (! empty($botToken) && ! empty($chatId)) {
            $methodText = match($order->payment_method) {
                'wallet' => 'Ví AI CỦA TÔI (Đã trừ tiền ví tự động)',
                'qr_bank' => 'Chuyển khoản QR Bank',
                default => 'Ví MoMo'
            };
            $text = "🛍️ <b>ĐƠN HÀNG MỚI</b> 🛍️\n\n".
                    '🆔 <b>Mã đơn hàng</b>: #'.$order->id."\n".
                    '👤 <b>Khách hàng</b>: '.$order->customer_name."\n".
                    '📞 <b>Số điện thoại</b>: '.$order->customer_phone."\n".
                    '✉️ <b>Email</b>: '.$order->customer_email."\n".
                    '📦 <b>Sản phẩm</b>: '.$order->product_name."\n".
                    '💵 <b>Tổng tiền</b>: '.number_format($order->price)."đ\n".
                    '💳 <b>Phương thức</b>: '.$methodText."\n".
                    '⚙️ <b>Thông tin nâng cấp</b>: '.$order->upgrade_details."\n\n".
                    '🔗 <b>Xem chi tiết đơn hàng</b>: <a href="'.url('/admin/orders/'.$order->id).'">Quản trị Đơn hàng</a>';

            try {
                Http::timeout(3)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                ]);
            } catch (\Exception $e) {
                Log::error('Telegram order alert failed: '.$e->getMessage());
            }
        }

        if ($isPaidWithWallet) {
            return redirect()->route('checkout.success', $order->id);
        }

        return redirect()->route('checkout.thankyou', $order->id);
    }

    // Show Thank You and Payment Instruction page
    public function thankYou($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // If order is already completed or processing, redirect directly to success page
        if ($order->status === 'completed' || $order->status === 'processing') {
            return redirect()->route('checkout.success', $order->id);
        }

        // Auto cancel if pending and created more than 5 minutes ago
        if ($order->status === 'pending' && $order->created_at->addMinutes(5)->isPast()) {
            $order->update(['status' => 'cancelled']);
        }

        return view('thankyou', compact('order'));
    }

    // Show Success page after payment confirmed
    public function success($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('success', compact('order'));
    }

    // Get order status API for AJAX polling
    public function getStatus($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Dynamic auto-cancel check here too, in case they are polling
        if ($order->status === 'pending' && $order->created_at->addMinutes(5)->isPast()) {
            $order->update(['status' => 'cancelled']);
        }

        return response()->json([
            'status' => $order->status,
        ]);
    }

    // Cancel order API endpoint
    public function cancel($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if ($order->status === 'pending') {
            $order->update(['status' => 'cancelled']);
        }

        return response()->json(['success' => true]);
    }
}
