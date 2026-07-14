<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    // List all orders with searching and filtering
    public function index(Request $request)
    {
        $query = Order::query()->orderBy('created_at', 'desc');

        // Search by ID, Customer Name, Email, or Phone
        if ($request->filled('search')) {
            $search = $request->search;
            // Support searching by numeric ID directly or formatted e.g., OD1005
            $cleanId = preg_replace('/[^0-9]/', '', $search);
            $query->where(function($q) use ($search, $cleanId) {
                $q->where('customer_name', 'like', '%' . $search . '%')
                  ->orWhere('customer_email', 'like', '%' . $search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $search . '%')
                  ->orWhere('product_name', 'like', '%' . $search . '%');
                
                if (!empty($cleanId)) {
                    // Try to match the last digits of the order ID
                    $q->orWhere('id', $cleanId - 1000)
                      ->orWhere('id', $cleanId);
                }
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    // Show a specific order details
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Update order status and optional activation key
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
            'activation_key' => 'nullable|string|max:255',
            'send_email' => 'nullable|string|in:1',
            'email_content' => 'nullable|string',
        ]);

        $order->update([
            'status' => $request->status,
            'activation_key' => $request->activation_key,
        ]);

        // Gửi email nếu tích chọn gửi
        if ($request->send_email === '1' && $request->filled('email_content')) {
            $customerEmail = $order->customer_email ?? ($order->user ? $order->user->email : null);
            if ($customerEmail) {
                $emailBody = $request->email_content;
                if (strpos($emailBody, '[Nội dung tài khoản / key]') !== false) {
                    $emailBody = str_replace('[Nội dung tài khoản / key]', $request->activation_key, $emailBody);
                } else {
                    $emailBody .= "\n\nThông tin bàn giao: " . $request->activation_key;
                }
                
                $body = nl2br(e($emailBody));
                // Tự động nhận diện link URL và chuyển thành thẻ a click được
                $body = preg_replace('/(https?:\/\/[^\s<]+)/', '<a href="$1" style="color: #0284c7; text-decoration: underline;" target="_blank">$1</a>', $body);
                
                $htmlContent = "
                <div style='background-color: #f1f5f9; padding: 2rem; font-family: Arial, sans-serif; color: #0f172a; line-height: 1.6;'>
                    <div style='max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; border: 1px solid #cbd5e1; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);'>
                        <div style='background: linear-gradient(135deg, #0284c7, #0ea5e9); padding: 1.5rem 2rem; text-align: center;'>
                            <h2 style='color: #ffffff; margin: 0; font-size: 1.5rem; font-weight: bold;'>BÀN GIAO TÀI KHOẢN</h2>
                        </div>
                        <div style='padding: 2rem;'>
                            " . $body . "
                        </div>
                        <div style='background: #f8fafc; padding: 1rem 2rem; text-align: center; font-size: 0.8rem; color: #64748b; border-top: 1px solid #e2e8f0;'>
                            &copy; " . date('Y') . " <a href='https://aicuatoi.com' style='color: #64748b; text-decoration: underline;' target='_blank'>AI CỦA TÔI</a>. Nền tảng phân phối dịch vụ số hàng đầu Việt Nam.
                        </div>
                    </div>
                </div>
                ";

                try {
                    Mail::html($htmlContent, function ($message) use ($customerEmail, $order) {
                        $message->to($customerEmail)
                                ->subject('Bàn giao tài khoản đơn hàng #OD' . (1000 + $order->id) . ' | AI CỦA TÔI');
                    });
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Gửi mail bàn giao thất bại: ' . $e->getMessage());
                    return redirect()->route('admin.orders.index')->with('success_message', 'Cập nhật trạng thái thành công, nhưng gửi email thất bại: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('admin.orders.index')->with('success_message', 'Cập nhật trạng thái đơn hàng #' . (1000 + $order->id) . ' thành công!');
    }
}
