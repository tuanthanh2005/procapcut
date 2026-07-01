<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // Show forgot password request form
    public function showLinkRequestForm()
    {
        return view('forgot-password');
    }

    // Send reset link logic (simulated/mock email for local testing)
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.exists' => 'Email này không tồn tại trong hệ thống.',
        ]);

        $email = $request->email;
        $token = Str::random(60);

        // Delete any existing token
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Save new token
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => Hash::make($token),
            'created_at' => now()
        ]);

        $resetUrl = url("/reset-password/{$token}?email=" . urlencode($email));

        // Redirect back with the reset URL so the user can test the flow on local without configuring SMTP mail
        return back()->with([
            'status' => 'Hệ thống đã tạo mã đặt lại mật khẩu thành công!',
            'reset_link' => $resetUrl
        ]);
    }

    // Show reset password form
    public function showResetForm(Request $request, $token = null)
    {
        return view('reset-password')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // Handle password reset
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.exists' => 'Email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu phải từ 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'Mã thông báo đặt lại mật khẩu đã hết hạn hoặc không hợp lệ.']);
        }

        // Update user password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('success_message', 'Mật khẩu của bạn đã được cập nhật thành công! Vui lòng đăng nhập lại.');
    }
}
