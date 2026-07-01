<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu | AI CỦA TÔI - Dịch Vụ Tài Khoản Giá Rẻ</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-body: #f1f5f9;
            --primary: #0284c7;
            --primary-hover: #0369a1;
            --secondary: #0ea5e9;
            --text-main: #0f172a;
            --text-muted: #475569;
            --border-color: #cbd5e1;
            --radius-md: 12px;
            --radius-lg: 20px;
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(2, 132, 199, 0.06) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(14, 165, 233, 0.05) 0%, transparent 45%);
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            z-index: 10;
        }

        .logo-wrapper {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-wrapper a {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-size: 1.6rem;
            font-weight: 800;
            background: linear-gradient(to right, #0f172a, #334155);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-wrapper i {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.8rem;
        }

        .auth-title {
            font-size: 1.25rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .auth-subtitle {
            font-size: 0.85rem;
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 2rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            line-height: 1.4;
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #ef4444;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.75rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 0.9rem;
            color: var(--text-main);
            transition: var(--transition);
            background: #f8fafc;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }

        .btn-auth {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 0.92rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .btn-auth:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(2, 132, 199, 0.3);
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .auth-footer a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="logo-wrapper">
            <a href="/">
                <i class="fa-solid fa-rocket"></i>
                <span>AI CỦA TÔI</span>
            </a>
        </div>

        <h2 class="auth-title">Đổi mật khẩu mới</h2>
        <p class="auth-subtitle">Vui lòng nhập mật khẩu mới của bạn bên dưới</p>

        @if ($errors->any())
            <div class="alert">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="/reset-password" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label class="form-label">Email tài khoản</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" class="form-input" value="{{ $email }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Mật khẩu mới</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-input" placeholder="Tối thiểu 6 ký tự" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Xác nhận mật khẩu mới</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-shield-halved"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Nhập lại mật khẩu mới" required>
                </div>
            </div>

            <button type="submit" class="btn-auth">
                Cập Nhật Mật Khẩu <i class="fa-solid fa-check"></i>
            </button>
        </form>

        <p class="auth-footer">
            Quay lại trang <a href="/login">Đăng nhập</a>
        </p>
    </div>

</body>
</html>
