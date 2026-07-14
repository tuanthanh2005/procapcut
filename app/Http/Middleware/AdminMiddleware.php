<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            // Cho phép đi qua nếu là route xác minh mã bảo mật
            if ($request->is('admin/verify-security-code')) {
                return $next($request);
            }

            // Kiểm tra xem đã xác minh mã bảo mật trong session chưa và còn hạn 1 tiếng không
            $verifiedAt = session('admin_verified_at', 0);
            if (session('admin_verified') === true && (time() - $verifiedAt < 3600)) {
                return $next($request);
            }

            // Nếu đã hết hạn hoặc chưa xác minh, xóa session để đảm bảo sạch sẽ
            session()->forget(['admin_verified', 'admin_verified_at']);

            // Trả về lỗi 403 nếu là request AJAX/JSON mong muốn dữ liệu API
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Vui lòng xác minh mã bảo mật admin.'], 403);
            }

            // Chuyển hướng đến trang nhập mã bảo mật
            return redirect()->route('admin.verify_code');
        }

        return redirect('/')->withErrors(['email' => 'Bạn không có quyền truy cập vào trang quản trị.']);
    }
}
