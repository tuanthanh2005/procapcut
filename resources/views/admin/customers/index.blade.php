<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Quản Lý Khách Hàng | AI CỦA TÔI Admin</title>
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
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --radius-md: 10px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            --transition: all 0.2s ease;
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
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar styling */
        .sidebar {
            width: 260px;
            background: #0f172a;
            color: #94a3b8;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            flex-shrink: 0;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: 800;
        }

        
        .logo-area i {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff !important;
            font-size: 0.95rem;
            box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
            transition: all 0.3s ease;
        }

        .logo-area:hover i {
            transform: scale(1.08) rotate(-8deg);
            box-shadow: 0 6px 15px rgba(14, 165, 233, 0.45);
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            list-style: none;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .menu-item.active a, .menu-item a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }

        .menu-item.active a i {
            color: var(--secondary);
        }

        /* Main content area */
        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 800;
        }

        .user-info-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-avatar {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .admin-name {
            font-size: 0.88rem;
            font-weight: 700;
        }

        .admin-badge {
            background: #fef2f2;
            color: #ef4444;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            border: 1px solid #fee2e2;
        }

        .content-container {
            padding: 2.5rem;
            width: 100%;
            margin: 0 auto;
        }

        /* Alerts */
        .alert {
            padding: 0.85rem 1.25rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #991b1b;
        }

        /* Search area styling */
        .search-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
        }

        .search-form {
            display: flex;
            gap: 1rem;
        }

        .form-input {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            background: #f8fafc;
            color: var(--text-main);
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 600;
            outline: none;
            transition: var(--transition);
        }

        .form-input:focus {
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }

        .search-input {
            flex-grow: 1;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: #ffffff;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background: #f8fafc;
        }

        /* Table Card */
        .table-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .data-table th {
            background: #f8fafc;
            padding: 1rem 1.5rem;
            font-size: 0.78rem;
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table td {
            padding: 1.25rem 1.5rem;
            font-size: 0.88rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .user-info-td {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar-circle {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--text-main);
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .user-avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-meta {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .user-name-title {
            font-weight: 700;
            color: var(--text-main);
        }

        .user-email-subtitle {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .user-reg-date {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.1rem;
        }

        .badge-role {
            font-size: 0.7rem;
            font-weight: 800;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .badge-admin {
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fee2e2;
        }

        .badge-user {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #dcfce7;
        }

        .badge-blocked {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .blocked-row {
            background: #fdfdfd;
            opacity: 0.85;
        }

        .blocked-text {
            color: #ef4444;
            font-size: 0.78rem;
            font-weight: 600;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Modal styling */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(4px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-card {
            background: #ffffff;
            width: 90%;
            max-width: 500px;
            border-radius: var(--radius-lg);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            overflow: hidden;
            animation: modalIn 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes modalIn {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-header {
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-size: 1rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .modal-close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            line-height: 1;
        }

        .modal-body {
            padding: 1.5rem;
            max-height: 350px;
            overflow-y: auto;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            background: #f8fafc;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Cart Details Item List */
        .cart-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .cart-item-row:last-child {
            border-bottom: none;
        }

        .cart-item-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cart-item-icon {
            width: 1.8rem;
            height: 1.8rem;
            background: #e0f2fe;
            color: #0369a1;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
        }

        .cart-item-title {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text-main);
        }

        .cart-item-options {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 0.15rem;
        }

        .cart-item-price {
            font-weight: 800;
            font-size: 0.85rem;
            color: var(--primary);
        }

        .pagination-container {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
        }
        /* Pagination CSS */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
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

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <a href="/" class="logo-area">
            <i class="fa-solid fa-rocket"></i>
            <span>CapCut Admin</span>
        </a>

        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="/admin/dashboard"><i class="fa-solid fa-chart-pie"></i> Tổng quan</a>
            </li>
            <li class="menu-item">
                <a href="/admin/products"><i class="fa-solid fa-box-open"></i> Sản phẩm</a>
            </li>
            <li class="menu-item">
                <a href="/admin/posts"><i class="fa-solid fa-newspaper"></i> Bài viết</a>
            </li>
            <li class="menu-item">
                <a href="/admin/orders"><i class="fa-solid fa-receipt"></i> Đơn hàng</a>
            </li>
            <li class="menu-item">
                <a href="/admin/chat"><i class="fa-solid fa-comments"></i> Hỗ trợ Chat</a>
            </li>
            <li class="menu-item active">
                <a href="/admin/customers"><i class="fa-solid fa-users"></i> Khách hàng</a>
            </li>
            <li class="menu-item">
                <a href="/admin/settings"><i class="fa-solid fa-gears"></i> Cấu hình</a>
            </li>
            <li class="menu-item">
                <a href="/"><i class="fa-solid fa-house"></i> Quay lại website</a>
            </li>
        </ul>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="page-title">Quản Lý Khách Hàng</div>
            
            <div class="user-info-bar">
                <div class="admin-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div style="display: flex; flex-direction: column;">
                    <span class="admin-name">{{ auth()->user()->name }}</span>
                    <span class="admin-badge">Quản trị viên</span>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="content-container">
            @if(session('success_message'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success_message') }}
                </div>
            @endif

            @if(session('error_message'))
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error_message') }}
                </div>
            @endif

            <!-- Search bar -->
            <div class="search-card">
                <form action="/admin/customers" method="GET" class="search-form">
                    <input type="text" name="search" class="form-input search-input" placeholder="Tìm kiếm theo tên hoặc email của khách hàng..." value="{{ $search }}">
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                    </button>
                    @if($search)
                        <a href="/admin/customers" class="btn-secondary">
                            Xóa lọc
                        </a>
                    @endif
                </form>
            </div>

            <!-- Customers list table -->
            <div class="table-card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Khách hàng</th>
                            <th style="text-align: center;">Giỏ hàng</th>
                            <th style="text-align: center;">Đơn hàng thành công</th>
                            <th style="text-align: right;">Tổng chi tiêu</th>
                            <th style="text-align: center;">Quyền hạn</th>
                            <th style="text-align: center;">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="{{ $user->is_blocked ? 'blocked-row' : '' }}">
                                <td>
                                    <div class="user-info-td">
                                        <div class="user-avatar-circle">
                                            @if($user->avatar)
                                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                            @else
                                                {{ substr($user->name, 0, 1) }}
                                            @endif
                                        </div>
                                        <div class="user-meta">
                                            <span class="user-name-title">{{ $user->name }}</span>
                                            <span class="user-email-subtitle">{{ $user->email }}</span>
                                            <span class="user-reg-date"><i class="fa-regular fa-clock"></i> Đăng ký ngày: {{ $user->created_at->format('H:i d/m/Y') }}</span>
                                            @if($user->is_blocked)
                                                <span class="blocked-text"><i class="fa-solid fa-circle-minus"></i> Đã bị khóa</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    @if(!empty($user->cart_items) && count($user->cart_items) > 0)
                                        <button type="button" onclick="openCartModal('{{ e($user->name) }}', {{ json_encode($user->cart_items) }})" style="background: #fef3c7; color: #d97706; border: 1px solid #fde68a; border-radius: 50%; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.85rem; font-weight: bold; outline: none; transition: transform 0.2s;" title="Xem giỏ hàng bỏ quên" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                            !
                                        </button>
                                    @else
                                        <span style="color: var(--text-muted); font-size: 0.82rem;">Trống</span>
                                    @endif
                                </td>
                                <td style="text-align: center; font-weight: 700; color: var(--text-main);">
                                    {{ number_format($user->completed_orders_count) }} lượt
                                </td>
                                <td style="text-align: right; font-weight: 800; color: var(--primary);">
                                    {{ number_format($user->total_spent ?? 0) }}đ
                                </td>
                                <td style="text-align: center;">
                                    @if(auth()->id() === $user->id)
                                        <span class="badge-role badge-admin">Quản trị viên (Bạn)</span>
                                    @else
                                        <form action="/admin/customers/{{ $user->id }}/role" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" onchange="if(confirm('Cập nhật quyền hạn cho tài khoản này?')) this.form.submit(); else this.value='{{ $user->role }}';" class="form-input" style="padding: 0.35rem 0.5rem; font-size: 0.8rem; width: auto; font-weight: 600; background: #ffffff; border-color: var(--border-color);">
                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Khách hàng</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if(auth()->id() === $user->id)
                                        <span style="color: var(--text-muted); font-size: 0.8rem; font-style: italic;">Không khả dụng</span>
                                    @else
                                        <form action="/admin/customers/{{ $user->id }}/toggle-block" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn thực hiện tác vụ này?')">
                                            @csrf
                                            @if($user->is_blocked)
                                                <button type="submit" class="btn-primary" style="background: #22c55e; padding: 0.4rem 0.8rem; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;">
                                                    <i class="fa-solid fa-lock-open"></i> Mở khóa
                                                </button>
                                            @else
                                                <button type="submit" class="btn-primary" style="background: #ef4444; padding: 0.4rem 0.8rem; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.25rem;">
                                                    <i class="fa-solid fa-lock"></i> Khóa
                                                </button>
                                            @endif
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                    <i class="fa-regular fa-folder-open" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block; opacity: 0.5;"></i>
                                    Không tìm thấy khách hàng nào khớp với tìm kiếm.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($users->hasPages())
                    <div class="pagination-container">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Abandoned Cart Detail Modal -->
    <div id="cart-modal" class="modal-overlay" style="display: none;">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng bỏ quên của <span id="cart-user-name"></span></h3>
                <button type="button" class="modal-close-btn" onclick="closeCartModal()">&times;</button>
            </div>
            <div class="modal-body" id="cart-modal-content">
                <!-- Injected rows -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeCartModal()" style="padding: 0.5rem 1.25rem;">Đóng</button>
            </div>
        </div>
    </div>

    <script>
        function openCartModal(userName, items) {
            document.getElementById('cart-user-name').innerText = userName;
            
            let html = '';
            
            if (items && items.length > 0) {
                items.forEach(item => {
                    let optionsText = '';
                    if (item.options && item.options.length > 0) {
                        optionsText = item.options.join(', ');
                    }
                    
                    html += `
                        <div class="cart-item-row">
                            <div class="cart-item-left">
                                <div class="cart-item-icon">
                                    <i class="fa-solid fa-box"></i>
                                </div>
                                <div>
                                    <div class="cart-item-title">${item.name} <span style="color: var(--text-muted); font-weight: 500;">x${item.quantity || 1}</span></div>
                                    ${optionsText ? `<div class="cart-item-options">${optionsText}</div>` : ''}
                                </div>
                            </div>
                            <div class="cart-item-price">${Number(item.price * (item.quantity || 1)).toLocaleString()}đ</div>
                        </div>
                    `;
                });
            } else {
                html = '<div style="text-align: center; color: var(--text-muted); padding: 1.5rem 0;">Giỏ hàng trống.</div>';
            }
            
            document.getElementById('cart-modal-content').innerHTML = html;
            document.getElementById('cart-modal').style.display = 'flex';
        }

        function closeCartModal() {
            document.getElementById('cart-modal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('cart-modal');
            if (e.target === modal) {
                closeCartModal();
            }
        });
    </script>

</body>
</html>
