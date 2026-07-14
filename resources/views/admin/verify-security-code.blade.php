<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Xác Minh Bảo Mật Admin | AI CỦA TÔI</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-body: #0f172a;
            --primary: #38bdf8;
            --primary-hover: #0ea5e9;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.1);
            --radius-md: 12px;
            --radius-lg: 20px;
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.3);
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
                radial-gradient(circle at 10% 20%, rgba(56, 189, 248, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(14, 165, 233, 0.08) 0%, transparent 45%);
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
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
            background: linear-gradient(to right, #f8fafc, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-wrapper i {
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
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
            line-height: 1.5;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            line-height: 1.4;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
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
            font-size: 1.1rem;
            letter-spacing: 0.2em;
            text-align: center;
            color: var(--text-main);
            transition: var(--transition);
            background: rgba(15, 23, 42, 0.6);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        }

        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            border: none;
            border-radius: var(--radius-md);
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: #0f172a;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.2);
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(56, 189, 248, 0.3);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--primary);
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

        <h2 class="auth-title">Xác Minh Bảo Mật</h2>
        <p class="auth-subtitle">Nhập mã bảo mật quản trị viên để tiếp tục truy cập trang quản trị.</p>

        @if($errors->has('security_code'))
            <div class="alert alert-error">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('security_code') }}
            </div>
        @endif

        <form action="{{ route('admin.verify_code.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="security_code">Mã Bảo Mật</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="security_code" id="security_code" class="form-input" placeholder="•••••" required autofocus autocomplete="off">
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Xác Nhận <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <a href="/" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Quay lại trang chủ
        </a>
    </div>
</body>
</html>
