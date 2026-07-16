<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Đơn Hàng Đã Mua | AI CỦA TÔI - Dịch Vụ Số Giá Rẻ</title>
    <meta name="description" content="Xem lại danh sách đơn hàng đã mua và trạng thái kích hoạt tài khoản của bạn tại AI CỦA TÔI.">
    <meta name="robots" content="noindex, nofollow">
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
            max-width: 100%;
            margin: 0 auto;
            padding: 0 2rem;
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
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff !important;
            font-size: 0.95rem;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25);
            transition: all 0.3s ease;
            margin-right: 0.55rem;
            -webkit-text-fill-color: initial !important;
            background-clip: border-box !important;
            -webkit-background-clip: border-box !important;
        }
        .logo:hover .logo-icon {
            transform: scale(1.08) rotate(-8deg);
            box-shadow: 0 6px 15px rgba(2, 132, 199, 0.4);
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

        /* Main Content Layout */
        main.container {
            flex-grow: 1;
            padding: 3rem 2rem;
        }

        .page-title-row {
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-title-row h1 {
            font-size: 1.8rem;
            font-weight: 800;
        }

        /* Order Cards layout */
        .orders-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .order-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem 2rem;
            box-shadow: var(--shadow-sm);
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            align-items: center;
            gap: 2rem;
            transition: var(--transition);
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        .order-icon-box {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: var(--radius-md);
            background: rgba(2, 132, 199, 0.08);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .order-details h3 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.4rem;
        }

        .order-meta-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .key-reveal-box {
            background: #f8fafc;
            border: 1px dashed var(--border-color);
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            font-family: monospace;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .copy-btn {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            transition: var(--transition);
        }

        .copy-btn:hover {
            color: var(--primary-hover);
        }

        .order-price {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-main);
            text-align: right;
        }

        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.6rem;
            font-size: 0.72rem;
            font-weight: 700;
            border-radius: 6px;
            text-transform: uppercase;
        }

        .status-completed {
            background: #ecfdf5;
            color: #10b981;
            border: 1px solid #d1fae5;
        }

        .status-pending {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fef3c7;
        }

        .empty-orders {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            text-align: center;
            padding: 4rem 2rem;
            box-shadow: var(--shadow-sm);
        }

        .empty-orders > i {
            font-size: 3.5rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .empty-orders h3 {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .empty-orders p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .btn-shop {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-shop:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);
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
            .order-card {
                grid-template-columns: 1fr;
                gap: 0.8rem;
                text-align: left;
                justify-items: start;
            }
            .order-meta-info {
                flex-wrap: wrap;
                gap: 0.75rem;
            }
            .order-price {
                text-align: left;
            }
            .order-card > div:last-child {
                align-items: flex-start !important;
            }
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
        /* Pagination CSS */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .pagination {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .pagination li a, .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 6px;
            background: #ffffff;
            border: 1px solid var(--border-color, #e2e8f0);
            color: var(--text-muted, #64748b);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .pagination li a:hover {
            border-color: var(--primary, #0284c7);
            color: var(--primary, #0284c7);
        }
        .pagination li.active span {
            background: linear-gradient(135deg, var(--primary, #0284c7) 0%, var(--secondary, #0ea5e9) 100%);
            color: white;
            border-color: transparent;
        }
        .pagination li.disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }
</style>
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container">
            <div class="navbar">
                <a href="/" class="logo">
                    @if(file_exists(public_path('logo.png')))
                        <img src="{{ asset('logo.png') }}?v={{ time() }}" alt="Logo" style="max-height: 2.2rem; object-fit: contain;">
                    @else
                        <i class="fa-solid fa-rocket logo-icon"></i>
                        <span>AI CỦA TÔI</span>
                    @endif
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
        <div class="page-title-row">
            <h1>Lịch Sử Mua Hàng</h1>
            <span class="status-badge status-completed" style="text-transform: none;"><i class="fa-solid fa-shield-check"></i> Bảo hành tự động</span>
        </div>

        @if($orders->isEmpty())
            <div class="empty-orders">
                <i class="fa-solid fa-basket-shopping"></i>
                <h3>Bạn chưa mua sản phẩm nào</h3>
                <p>Khám phá ngay kho dịch vụ số cao cấp giá rẻ của chúng tôi để bắt đầu mua sắm.</p>
                <a href="/products" class="btn-shop">Mua Sắm Ngay <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        @else
            <div class="orders-list">
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-icon-box">
                            <i class="fa-solid {{ $order->product_icon }}"></i>
                        </div>
                        <div class="order-details">
                            <h3>{{ $order->product_name }}</h3>
                            <div class="order-meta-info">
                                <span class="info-item"><i class="fa-regular fa-clock"></i> {{ $order->created_at->format('H:i d/m/Y') }}</span>
                                <span class="info-item"><i class="fa-solid fa-receipt"></i> Mã đơn: #OD{{ 1000 + $order->id }}</span>
                            </div>
                        </div>
                        <div>
                            @if($order->status === 'completed')
                                @if($order->activation_key)
                                    <div class="key-reveal-box" title="Click để sao chép key bản quyền">
                                        <span id="key-text-{{ $order->id }}">{{ $order->activation_key }}</span>
                                        <button class="copy-btn" onclick="copyKey('{{ $order->id }}')"><i class="fa-regular fa-copy"></i></button>
                                    </div>
                                @else
                                    <span style="font-size: 0.8rem; color: var(--text-muted);">Tài khoản cấp tự động</span>
                                @endif
                            @elseif($order->status === 'cancelled')
                                <span style="font-size: 0.8rem; color: #ef4444; font-weight: 600;"><i class="fa-solid fa-circle-xmark"></i> Đơn hàng đã hủy</span>
                            @else
                                <span style="font-size: 0.8rem; color: #0284c7; font-weight: 600;"><i class="fa-solid fa-envelope-open-text"></i> Admin sẽ cấp tài khoản qua email vui lòng chờ!</span>
                            @endif
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 0.5rem;">
                            <span class="order-price">{{ number_format($order->price, 0, ',', '.') }}₫</span>
                            @if($order->status === 'completed')
                                <span class="status-badge status-completed">Thành công</span>
                            @elseif($order->status === 'processing')
                                <span class="status-badge status-pending" style="background: #e0f2fe; color: #0284c7; border-color: #bae6fd;">Chờ duyệt</span>
                            @elseif($order->status === 'cancelled')
                                <span class="status-badge status-pending" style="background: #f1f5f9; color: #64748b; border-color: #e2e8f0;">Đã hủy</span>
                            @else
                                <span class="status-badge status-pending" style="background: #fff7ed; color: #ea580c; border-color: #ffedd5;">Chờ thanh toán</span>
                                <a href="{{ route('checkout.thankyou', $order->id) }}" class="btn-pay-now" style="font-size: 0.72rem; color: #ffffff; background: #ea580c; padding: 0.25rem 0.6rem; border-radius: 6px; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 0.25rem; transition: background 0.15s ease;"><i class="fa-solid fa-credit-card"></i> Thanh toán ngay</a>
                            @endif
                            <a href="{{ route('checkout.success', $order->id) }}" style="font-size: 0.75rem; color: var(--primary); text-decoration: underline; font-weight: 600; margin-top: 0.3rem; display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.2rem 0;"><i class="fa-solid fa-circle-info"></i> Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="pagination-container" style="margin-top: 2rem; display: flex; justify-content: center;">
                {{ $orders->links() }}
            </div>
        @endif
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

        // Copy activation key helper
        function copyKey(orderId) {
            const keyText = document.getElementById(`key-text-${orderId}`).innerText;
            navigator.clipboard.writeText(keyText).then(() => {
                alert('Đã sao chép mã kích hoạt bản quyền vào bộ nhớ tạm!');
            });
        }
    </script>
</body>
</html>
