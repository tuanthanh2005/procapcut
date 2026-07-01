<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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

        $orders = $query->paginate(15)->withQueryString();

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
        ]);

        $order->update([
            'status' => $request->status,
            'activation_key' => $request->activation_key,
        ]);

        return redirect()->route('admin.orders.index')->with('success_message', 'Cập nhật trạng thái đơn hàng #' . (1000 + $order->id) . ' thành công!');
    }
}
