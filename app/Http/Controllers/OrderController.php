<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'payment_method' => 'required|string|in:qr_bank,momo',
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
            $firstItemName .= ' và ' . (count($cart) - 1) . ' sản phẩm khác';
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

        // Send Telegram Alert for new order
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');
        if (!empty($botToken) && !empty($chatId)) {
            $text = "🛍️ <b>ĐƠN HÀNG MỚI</b> 🛍️\n\n" .
                    "🆔 <b>Mã đơn hàng</b>: #" . $order->id . "\n" .
                    "👤 <b>Khách hàng</b>: " . $order->customer_name . "\n" .
                    "📞 <b>Số điện thoại</b>: " . $order->customer_phone . "\n" .
                    "✉️ <b>Email</b>: " . $order->customer_email . "\n" .
                    "📦 <b>Sản phẩm</b>: " . $order->product_name . "\n" .
                    "💵 <b>Tổng tiền</b>: " . number_format($order->price) . "đ\n" .
                    "💳 <b>Phương thức</b>: " . ($order->payment_method === 'qr_bank' ? 'Chuyển khoản QR Bank' : 'Ví MoMo') . "\n" .
                    "⚙️ <b>Thông tin nâng cấp</b>: " . $order->upgrade_details . "\n\n" .
                    "🔗 <b>Xem chi tiết đơn hàng</b>: <a href=\"" . url('/admin/orders/' . $order->id) . "\">Quản trị Đơn hàng</a>";

            try {
                \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Telegram order alert failed: ' . $e->getMessage());
            }
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
            'status' => $order->status
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
