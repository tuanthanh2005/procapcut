<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('login');
    }

    // Handle traditional login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            if (Auth::user()->is_blocked) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Tài khoản của bạn đã bị khóa bởi quản trị viên.',
                ])->withInput($request->only('email', 'remember'));
            }
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Thông tin email hoặc mật khẩu không chính xác.',
        ])->withInput($request->only('email', 'remember'));
    }

    // Show register page
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('register');
    }

    // Handle traditional register
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.unique' => 'Email này đã được đăng ký sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp.',
        ]);

        $isFirstUser = User::count() === 0;
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $isFirstUser ? 'admin' : 'user',
        ]);

        $this->sendNewUserTelegramAlert($user);

        Auth::login($user);

        return redirect('/');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Google Login redirection
    public function redirectToGoogle(Request $request)
    {
        $clientId = config('services.google.client_id');
        // If Google credentials are not set in .env, use local Mock mode
        if (empty($clientId) || $clientId === 'MOCK_GOOGLE_CLIENT_ID') {
            return redirect('/auth/google/callback?mock=true');
        }

        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            // Fallback to mock on error
            return redirect('/auth/google/callback?mock=true');
        }
    }

    // Google Login callback
    public function handleGoogleCallback(Request $request)
    {
        // Mock flow
        if ($request->query('mock') === 'true') {
            $mockEmail = 'mock-google-user@gmail.com';
            $user = User::where('email', $mockEmail)->first();

            if ($user && $user->is_blocked) {
                return redirect('/login')->withErrors(['email' => 'Tài khoản của bạn đã bị khóa bởi quản trị viên.']);
            }

            if (!$user) {
                $isFirstUser = User::count() === 0;
                $user = User::create([
                    'name' => 'Khách Hàng Google (Mock)',
                    'email' => $mockEmail,
                    'google_id' => '1234567890',
                    'avatar' => 'https://ui-avatars.com/api/?name=Google+User&background=0284c7&color=fff',
                    'password' => Hash::make(Str::random(16)),
                    'role' => $isFirstUser ? 'admin' : 'user'
                ]);
                $this->sendNewUserTelegramAlert($user);
            } else {
                if (!$user->google_id) {
                    $user->google_id = '1234567890';
                    $user->avatar = 'https://ui-avatars.com/api/?name=Google+User&background=0284c7&color=fff';
                    $user->save();
                }
            }

            Auth::login($user, true);
            return redirect()->intended('/');
        }

        // Real flow using Socialite
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if ($user && $user->is_blocked) {
                return redirect('/login')->withErrors(['email' => 'Tài khoản của bạn đã bị khóa bởi quản trị viên.']);
            }

            if ($user) {
                if (!$user->google_id) {
                    $user->google_id = $googleUser->getId();
                    $user->avatar = $googleUser->getAvatar();
                    $user->save();
                }
            } else {
                $isFirstUser = User::count() === 0;
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(16)),
                    'role' => $isFirstUser ? 'admin' : 'user'
                ]);
                $this->sendNewUserTelegramAlert($user);
            }

            Auth::login($user, true);
            return redirect()->intended('/');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Đăng nhập Google thất bại: ' . $e->getMessage()]);
        }
    }

    // Send Telegram notification when a new member registers
    private function sendNewUserTelegramAlert(User $user)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');
        if (empty($botToken) || empty($chatId)) {
            return;
        }

        $totalUsers = User::count();

        $text = "👤 <b>THÀNH VIÊN MỚI ĐĂNG KÝ</b> 👤\n\n" .
                "🏷️ <b>Họ và tên</b>: " . $user->name . "\n" .
                "✉️ <b>Email</b>: " . $user->email . "\n" .
                "📅 <b>Thời gian</b>: " . now()->format('H:i d/m/Y') . "\n" .
                "🔑 <b>Hình thức</b>: " . ($user->google_id ? 'Đăng ký bằng Google' : 'Đăng ký tài khoản mật khẩu') . "\n\n" .
                "📊 <b>Tổng số thành viên hệ thống</b>: " . $totalUsers . " người dùng";

        try {
            \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $text,
                'parse_mode' => 'HTML',
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Telegram new user alert failed: ' . $e->getMessage());
        }
    }
}
