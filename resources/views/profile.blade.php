<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thiết Lập Tài Khoản | AI CỦA TÔI - Dịch Vụ Số Giá Rẻ</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-body: #f8fafc;
            --primary: #0284c7;
            --primary-hover: #0369a1;
            --secondary: #0ea5e9;
            --text-main: #0f172a;
            --text-dark: #334155;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --radius-md: 12px;
            --radius-lg: 20px;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
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
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Navbar / Header */
        header {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .logo-icon {
            color: var(--primary);
            font-size: 1.6rem;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .action-icon-btn {
            background: #f1f5f9;
            border: none;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .action-icon-btn:hover {
            background: var(--primary);
            color: white;
        }

        /* User Menu Dropdown */
        .user-menu-wrapper {
            position: relative;
        }

        .user-avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            width: 220px;
            padding: 0.5rem 0;
            display: none;
            z-index: 150;
            animation: slide-up-dropdown 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .user-dropdown-menu.show {
            display: block;
        }

        @keyframes slide-up-dropdown {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .user-dropdown-header {
            padding: 0.75rem 1.25rem;
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .user-display-name {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-display-email {
            font-size: 0.75rem;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 0.15rem;
        }

        .user-dropdown-divider {
            height: 1px;
            background: var(--border-color);
            margin: 0.4rem 0;
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 1.25rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
        }

        .user-dropdown-item:hover {
            background: var(--bg-body);
            color: var(--primary);
        }

        .user-dropdown-item.logout-btn-item:hover {
            background: #fef2f2;
            color: #ef4444 !important;
        }

        /* Main Profile Settings Design */
        main {
            flex-grow: 1;
            padding: 3rem 0;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2.5rem;
            align-items: start;
        }

        .sidebar-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            text-align: center;
        }

        .profile-avatar-large {
            width: 6.5rem;
            height: 6.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 auto 1.5rem;
            overflow: hidden;
        }

        .profile-avatar-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-meta h2 {
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .profile-meta p {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .linked-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .badge-google {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .badge-normal {
            background: #f8fafc;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
        }

        /* Form section */
        .form-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            box-shadow: var(--shadow-sm);
        }

        .form-card h2 {
            font-size: 1.35rem;
            font-weight: 800;
            margin-bottom: 1.75rem;
            border-bottom: 2px solid var(--bg-body);
            padding-bottom: 0.75rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 0.9rem;
            color: var(--text-main);
            background: #f8fafc;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }

        .form-input:disabled {
            background: #f1f5f9;
            color: var(--text-muted);
            cursor: not-allowed;
        }

        .btn-save {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.85rem 1.75rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);
        }

        .alert {
            padding: 0.85rem 1.1rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            margin-bottom: 1.75rem;
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

        /* Footer */
        footer {
            background: #0f172a;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2rem 0;
            color: #94a3b8;
            font-size: 0.8rem;
            text-align: center;
            margin-top: auto;
        }

        @media (max-width: 900px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container">
            <div class="navbar">
                <a href="/" class="logo">
                    <i class="fa-solid fa-rocket logo-icon"></i>
                    <span>AI CỦA TÔI</span>
                </a>

                <div class="nav-actions">
                    <a href="/products" class="action-icon-btn" title="Cửa hàng"><i class="fa-solid fa-store"></i></a>
                    
                    @auth
                        <div class="user-menu-wrapper">
                            <button class="action-icon-btn user-menu-btn" title="Tài khoản: {{ auth()->user()->name }}">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="user-avatar-img">
                                @else
                                    <i class="fa-solid fa-circle-user" style="font-size: 1.25rem;"></i>
                                @endif
                            </button>
                            <div class="user-dropdown-menu">
                                <div class="user-dropdown-header">
                                    <span class="user-display-name">{{ auth()->user()->name }}</span>
                                    <span class="user-display-email">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="user-dropdown-divider"></div>
                                @if(auth()->user()->isAdmin())
                                    <a href="/admin/dashboard" class="user-dropdown-item" style="color: #ef4444; font-weight: 700;"><i class="fa-solid fa-user-shield"></i> Quản trị Admin</a>
                                    <div class="user-dropdown-divider"></div>
                                @endif
                                <a href="/orders" class="user-dropdown-item"><i class="fa-solid fa-clock-rotate-left"></i> Đơn hàng đã mua</a>
                                <a href="/profile" class="user-dropdown-item"><i class="fa-solid fa-user-gear"></i> Thiết lập tài khoản</a>
                                <div class="user-dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST" style="margin: 0; width: 100%;">
                                    @csrf
                                    <button type="submit" class="user-dropdown-item logout-btn-item">
                                        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <div class="profile-grid">
            <!-- Sidebar Info -->
            <div class="sidebar-card">
                <div class="profile-avatar-large">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="Avatar">
                    @else
                        {{ substr(auth()->user()->name, 0, 1) }}
                    @endif
                </div>
                <div class="profile-meta">
                    <h2>{{ auth()->user()->name }}</h2>
                    <p>{{ auth()->user()->email }}</p>
                    
                    @if(auth()->user()->google_id)
                        <span class="linked-badge badge-google">
                            <i class="fa-brands fa-google"></i> Đã liên kết Google
                        </span>
                    @else
                        <span class="linked-badge badge-normal">
                            <i class="fa-solid fa-envelope"></i> Tài khoản thường
                        </span>
                    @endif
                </div>
            </div>

            <!-- Profile form -->
            <div class="form-card">
                <h2>Cập Nhật Thông Tin Tài Khoản</h2>

                @if ($errors->any())
                    <div class="alert alert-error">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success_message'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success_message') }}
                    </div>
                @endif

                <form action="/profile" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="email">Địa chỉ Email (Không thể thay đổi)</label>
                        <input type="email" id="email" class="form-input" value="{{ auth()->user()->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Họ và Tên</label>
                        <input type="text" name="name" id="name" class="form-input" value="{{ auth()->user()->name }}" required>
                    </div>

                    <div style="margin: 2.5rem 0 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                        <h3 style="font-size: 1.05rem; font-weight: 800; margin-bottom: 1rem;"><i class="fa-solid fa-key"></i> Đổi Mật Khẩu Mới (Bỏ trống nếu không muốn đổi)</h3>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Mật khẩu mới</label>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Tối thiểu 6 ký tự">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Xác nhận mật khẩu mới</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Nhập lại mật khẩu mới">
                    </div>

                    <button type="submit" class="btn-save">
                        Lưu Thay Đổi <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            &copy; {{ date('Y') }} AI CỦA TÔI. Nền tảng phân phối dịch vụ số hàng đầu Việt Nam.
        </div>
    </footer>

    <script>
        // Dropdown toggle
        const userMenuBtn = document.querySelector('.user-menu-btn');
        const userDropdownMenu = document.querySelector('.user-dropdown-menu');
        if (userMenuBtn && userDropdownMenu) {
            userMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdownMenu.classList.toggle('show');
            });
            document.addEventListener('click', () => {
                userDropdownMenu.classList.remove('show');
            });
        }
    </script>
</body>
</html>
