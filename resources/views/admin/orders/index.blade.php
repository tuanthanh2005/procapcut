<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Quản Lý Đơn Hàng | AI CỦA TÔI Admin</title>
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
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        /* Alert styling */
        .alert {
            padding: 0.85rem 1.25rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
            background: #ecfdf5;
            border: 1px solid #d1fae5;
            color: #065f46;
        }

        /* Data table styling */
        .data-section {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.75rem;
            box-shadow: var(--shadow-sm);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        /* Filter Form */
        .filter-form {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-input {
            padding: 0.5rem 0.85rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.85rem;
            outline: none;
            background: #f8fafc;
        }

        .filter-input:focus {
            border-color: var(--primary);
            background: #ffffff;
        }

        .btn-filter {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-filter:hover {
            background: var(--primary-hover);
        }

        .btn-reset {
            background: #f1f5f9;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            transition: var(--transition);
        }

        /* Table */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.85rem;
        }

        .orders-table th {
            padding: 0.85rem 1rem;
            border-bottom: 2px solid var(--border-color);
            font-weight: 700;
            color: var(--text-muted);
        }

        .orders-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .orders-table tr:hover td {
            background: #f8fafc;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 6px;
            text-transform: uppercase;
        }

        .badge-pending {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fef3c7;
        }

        .badge-completed {
            background: #ecfdf5;
            color: #10b981;
            border: 1px solid #d1fae5;
        }

        .badge-cancelled {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        /* Buttons */
        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.75rem;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.78rem;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .btn-view {
            background: #f0f9ff;
            color: var(--primary);
            border-color: #e0f2fe;
        }

        .btn-view:hover {
            background: var(--primary);
            color: white;
        }

        /* Pagination custom wrapper */
        .pagination-container {
            margin-top: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
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
            <li class="menu-item active">
                <a href="/admin/orders"><i class="fa-solid fa-receipt"></i> Đơn hàng</a>
            </li>
            <li class="menu-item">
                <a href="/admin/chat"><i class="fa-solid fa-comments"></i> Hỗ trợ Chat</a>
            </li>
            <li class="menu-item">
                <a href="/admin/customers"><i class="fa-solid fa-users"></i> Khách hàng</a>
            </li>
            <li class="menu-item">
                <a href="/admin/settings"><i class="fa-solid fa-gears"></i> Cấu hình</a>
            </li>
            <li class="menu-item" style="margin-top: auto;">
                <a href="/"><i class="fa-solid fa-house"></i> Quay lại website</a>
            </li>
        </ul>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="page-title">Quản Lý Đơn Hàng</div>
            
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
                <div class="alert">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success_message') }}
                </div>
            @endif

            <div class="data-section">
                <!-- Search & Filters -->
                <div class="section-header">
                    <form action="/admin/orders" method="GET" class="filter-form">
                        <input type="text" name="search" class="filter-input" placeholder="Mã đơn, Tên, Email..." value="{{ request('search') }}" style="min-width: 250px;">
                        
                        <select name="status" class="filter-input">
                            <option value="">-- Tất cả trạng thái --</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>

                        <button type="submit" class="btn-filter"><i class="fa-solid fa-magnifying-glass"></i> Lọc</button>
                        
                        @if(request()->anyFilled(['search', 'status']))
                            <a href="/admin/orders" class="btn-reset">Đặt lại</a>
                        @endif
                    </form>
                </div>

                <!-- Table grid -->
                <div style="overflow-x: auto;">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Sản phẩm & Gói</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt</th>
                                <th style="text-align: right;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td><strong>#OD{{ 1000 + $order->id }}</strong></td>
                                    <td>
                                        <div style="font-weight: 700; color: var(--text-main);">{{ $order->customer_name }}</div>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $order->customer_email }}</div>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $order->customer_phone }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600;">
                                            @if($order->product_icon)
                                                <i class="fa-solid {{ $order->product_icon }}" style="color: var(--primary); margin-right: 0.25rem; font-size: 0.85rem;"></i>
                                            @endif
                                            {{ $order->product_name }}
                                        </div>
                                        <div style="font-size: 0.72rem; color: #ef4444; font-weight: 700; margin-top: 0.2rem;">
                                            Tài khoản: {{ $order->upgrade_details }}
                                        </div>
                                    </td>
                                    <td><strong style="color: var(--text-main);">{{ number_format($order->price, 0, ',', '.') }}₫</strong></td>
                                    <td>
                                        <span style="font-size: 0.78rem; font-weight: 600;">
                                            {{ $order->payment_method === 'momo' ? 'Momo' : 'Chuyển khoản' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($order->status === 'completed')
                                            <span class="badge badge-completed"><i class="fa-solid fa-check-double"></i> Hoàn thành</span>
                                        @elseif($order->status === 'processing')
                                            <span class="badge badge-processing" style="background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd;"><i class="fa-solid fa-spinner fa-spin"></i> Chờ duyệt</span>
                                        @elseif($order->status === 'cancelled')
                                            <span class="badge badge-cancelled"><i class="fa-solid fa-ban"></i> Đã hủy</span>
                                        @else
                                            <span class="badge badge-pending"><i class="fa-solid fa-hourglass-start"></i> Chờ thanh toán</span>
                                        @endif
                                    </td>
                                    <td style="color: var(--text-muted); font-size: 0.78rem;">
                                        {{ $order->created_at->format('H:i d/m/Y') }}
                                    </td>
                                    <td style="text-align: right;">
                                        <a href="/admin/orders/{{ $order->id }}" class="btn-action btn-view">
                                            <i class="fa-regular fa-eye"></i> Xử lý đơn
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                        <i class="fa-regular fa-folder-open" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                                        Không tìm thấy đơn hàng nào phù hợp.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination links -->
                <div class="pagination-container">
                    {{ $orders->links() }}
                </div>
            </div>
        </main>
    </div>

</body>
</html>
