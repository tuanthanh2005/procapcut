<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Quên Mật Khẩu | AI CỦA TÔI - Dịch Vụ Tài Khoản Giá Rẻ</title>
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
            line-height: 1.5;
        }

        .alert {
            padding: 0.85rem 1.1rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #ef4444;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #d1fae5;
            color: #065f46;
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

        .mock-box {
            background: #f0f9ff;
            border: 1px dashed var(--primary);
            border-radius: var(--radius-md);
            padding: 1rem;
            margin-top: 1.5rem;
            font-size: 0.82rem;
            line-height: 1.5;
        }

        .mock-link {
            display: inline-block;
            margin-top: 0.5rem;
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
            word-break: break-all;
            background: #e0f2fe;
            padding: 0.4rem 0.6rem;
            border-radius: 4px;
            transition: var(--transition);
        }

        .mock-link:hover {
            background: #bae6fd;
        }
    
        /* Prevent auto zoom on iOS & Native app spacing */
        @media (max-width: 768px) {
            input, select, textarea, .form-input, .form-control {
                font-size: 16px !important;
            }
            .container {
                padding: 0 0.75rem !important;
            }
            /* Header adjustments */
            header {
                padding: 0.5rem 0 !important;
            }
            .navbar {
                display: grid !important;
                grid-template-columns: 1fr auto !important;
                gap: 0.35rem 0.75rem !important;
                align-items: center !important;
            }
            .logo {
                grid-column: 1 !important;
                grid-row: 1 !important;
                font-size: 1.2rem !important;
            }
            .nav-actions {
                grid-column: 2 !important;
                grid-row: 1 !important;
                gap: 0.75rem !important;
            }
            .action-icon-btn {
                width: 2.25rem !important;
                height: 2.25rem !important;
            }
            .search-wrapper {
                grid-column: 1 / span 2 !important;
                grid-row: 2 !important;
                width: 100% !important;
                max-width: 100% !important;
                margin-top: 0.25rem !important;
            }
            .search-input {
                height: 2.3rem !important;
            }
            .cat-nav-bar {
                grid-column: 1 / span 2 !important;
                grid-row: 3 !important;
                width: 100% !important;
                justify-content: flex-start !important;
                padding: 0.25rem 0.25rem 0.5rem 0.25rem !important;
                margin: 0 !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
            }
            .cat-pill {
                padding: 0.3rem 0.6rem !important;
                font-size: 0.75rem !important;
            }
            /* Responsive cart sidebar */
            .cart-sidebar {
                width: 100% !important;
                right: -100%;
            }
            .cart-sidebar.open {
                right: 0 !important;
            }
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

        <h2 class="auth-title">Khôi phục mật khẩu</h2>
        <p class="auth-subtitle">Nhập địa chỉ email của bạn để bắt đầu khôi phục mật khẩu</p>

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
            </div>
        @endif

        <form action="/forgot-password" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Địa chỉ Email của bạn</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" id="email" class="form-input" placeholder="name@example.com" value="{{ old('email') }}" required>
                </div>
            </div>

            <button type="submit" class="btn-auth">
                Gửi Yêu Cầu Khôi Phục <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>

        @if (session('reset_link'))
            <div class="mock-box">
                <strong style="color: var(--primary);"><i class="fa-solid fa-flask"></i> GIẢ LẬP GỬI EMAIL (LOCAL ONLY):</strong>
                <p style="margin-top: 0.25rem;">Do đang test trên máy tính cá nhân không có SMTP, bạn có thể click trực tiếp vào liên kết bên dưới để đặt lại mật khẩu mới:</p>
                <a href="{{ session('reset_link') }}" class="mock-link">
                    <i class="fa-solid fa-key"></i> Đặt lại mật khẩu ngay
                </a>
            </div>
        @endif

        <p class="auth-footer">
            Quay lại trang <a href="/login">Đăng nhập</a>
        </p>
    </div>

</body>
</html>
