<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // List customers with search, purchases count, and total spent
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Fetch users and calculate purchases count & total spent using relation count & sum
        $users = $query->withCount(['orders as completed_orders_count' => function ($q) {
            $q->where('status', 'completed');
        }])->withSum(['orders as total_spent' => function ($q) {
            $q->where('status', 'completed');
        }], 'price')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.customers.index', compact('users', 'search'));
    }

    // Toggle user block status
    public function toggleBlock(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Prevent blocking self
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error_message', 'Bạn không thể tự khóa tài khoản của chính mình!');
        }

        $user->is_blocked = !$user->is_blocked;
        $user->save();

        $statusText = $user->is_blocked ? 'Khóa' : 'Mở khóa';
        return redirect()->back()->with('success_message', "Đã {$statusText} tài khoản khách hàng {$user->name} thành công!");
    }

    // Update user role
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);

        // Prevent changing own role
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error_message', 'Bạn không thể tự thay đổi quyền của chính mình!');
        }

        $user->role = $request->role;
        $user->save();

        $roleText = $user->role === 'admin' ? 'Quản trị viên' : 'Khách hàng';
        return redirect()->back()->with('success_message', "Đã cập nhật quyền của {$user->name} thành {$roleText} thành công!");
    }
}
