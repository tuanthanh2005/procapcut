<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // Show order history
    public function orders()
    {
        $user = Auth::user();
        
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
        // Auto cancel any pending orders older than 5 minutes
        foreach ($orders as $order) {
            if ($order->status === 'pending' && $order->created_at->addMinutes(5)->isPast()) {
                $order->update(['status' => 'cancelled']);
            }
        }

        return view('orders', compact('orders'));
    }

    // Show profile settings page
    public function profile()
    {
        return view('profile');
    }

    // Handle profile update
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => 'Họ và tên không được để trống.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp.'
        ]);

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success_message', 'Cập nhật thông tin tài khoản thành công!');
    }
}
