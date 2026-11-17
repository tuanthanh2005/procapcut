<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Bot Telegram Bán Hàng | AI CỦA TÔI</title>
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
            --telegram-blue: #229ED9;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

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

        .logo-area i { color: var(--secondary); }

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

        .menu-item.active a i { color: var(--secondary); }

        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            max-height: 100vh;
        }

        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .content-container {
            padding: 2rem 2.5rem;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
        }

        .alert-box {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.92rem;
            font-weight: 500;
        }
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* Bot Status Card */
        .bot-status-banner {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            border-radius: var(--radius-lg);
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .bot-status-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .bot-icon-circle {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .bot-info-title { font-size: 1.25rem; font-weight: 800; }
        .bot-info-subtitle { font-size: 0.88rem; opacity: 0.9; margin-top: 0.25rem; }

        .bot-status-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-status-act {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.55rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }
        .btn-status-act:hover {
            background: #ffffff;
            color: var(--primary);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.25rem 1.5rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card h4 {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 0.4rem;
        }

        .stat-card .val {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Modern Tabs Navigation */
        .tabs-nav {
            display: flex;
            gap: 0.5rem;
            border-bottom: 2px solid var(--border-color);
            margin-bottom: 2rem;
            overflow-x: auto;
            padding-bottom: 2px;
        }

        .tab-btn {
            padding: 0.75rem 1.25rem;
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--text-muted);
            text-decoration: none;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            white-space: nowrap;
            transition: var(--transition);
        }

        .tab-btn:hover { color: var(--primary); }
        .tab-btn.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        /* Card container */
        .content-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.75rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        /* Form elements */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 0.9rem;
            outline: none;
            transition: var(--transition);
            background: #ffffff;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
        }

        .btn-primary {
            background: var(--primary);
            color: #ffffff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            text-decoration: none;
        }
        .btn-primary:hover { background: var(--primary-hover); }

        .btn-outline {
            background: #ffffff;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            padding: 0.6rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: var(--transition);
            text-decoration: none;
        }
        .btn-outline:hover { background: #f1f5f9; }

        .btn-danger {
            background: #ef4444;
            color: #ffffff;
            border: none;
            padding: 0.5rem 0.85rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
        }

        /* Modern Tables */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.88rem;
        }

        th {
            background: #f8fafc;
            color: var(--text-muted);
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        tr:hover td { background: #f8fafc; }

        .badge-status {
            padding: 0.25rem 0.65rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .badge-success { background: #dcfce7; color: #15803d; }
        .badge-warning { background: #fef3c7; color: #b45309; }
        .badge-danger { background: #fee2e2; color: #b91c1c; }
        .badge-info { background: #e0f2fe; color: #0369a1; }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 999;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .modal.active { display: flex; }

        .modal-content {
            background: #ffffff;
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 600px;
            padding: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title { font-size: 1.15rem; font-weight: 800; }
        .close-modal { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted); }

        .tag-pill {
            background: #f1f5f9;
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #475569;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="/" class="logo-area">
            <i class="fa-solid fa-bolt"></i>
            <span>AI CỦA TÔI</span>
        </a>

        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="/admin/dashboard"><i class="fa-solid fa-chart-pie"></i> Tổng quan Web</a>
            </li>
            <li class="menu-item">
                <a href="/admin/products"><i class="fa-solid fa-box-open"></i> Sản phẩm Web</a>
            </li>
            <li class="menu-item">
                <a href="/admin/orders"><i class="fa-solid fa-receipt"></i> Đơn hàng Web</a>
            </li>
            <li class="menu-item active">
                <a href="/admin/telegram" style="color: #ffffff; background: rgba(14, 165, 233, 0.15); border-left: 3px solid #0ea5e9;">
                    <i class="fa-brands fa-telegram" style="color: #0ea5e9; font-size: 1.1rem;"></i>
                    <span>Bot Telegram</span>
                    <span style="margin-left: auto; background: #0ea5e9; color: white; font-size: 0.65rem; padding: 2px 6px; border-radius: 8px; font-weight: 700;">24/7</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/admin/settings"><i class="fa-solid fa-gears"></i> Cấu hình VietQR</a>
            </li>
            <li class="menu-item" style="margin-top: auto;">
                <a href="/"><i class="fa-solid fa-house"></i> Quay lại website</a>
            </li>
        </ul>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <header class="top-navbar">
            <div class="page-title">
                <i class="fa-brands fa-telegram" style="color: #0ea5e9;"></i>
                <span>Quản Lý Bot Bán Hàng Telegram (@{{ $settings['telegram_bot_username'] }})</span>
            </div>
            
            <div style="display: flex; align-items: center; gap: 1rem;">
                <a href="https://t.me/{{ $settings['telegram_bot_username'] }}" target="_blank" class="btn-outline">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Mở Bot trên Telegram
                </a>
                <div style="font-size: 0.85rem; font-weight: 700; background: #e0f2fe; color: #0284c7; padding: 0.35rem 0.8rem; border-radius: 20px;">
                    <i class="fa-solid fa-circle" style="font-size: 0.5rem; color: #10b981;"></i> Đang hoạt động
                </div>
            </div>
        </header>

        <main class="content-container">
            @if(session('success_message'))
                <div class="alert-box alert-success">
                    <span><i class="fa-solid fa-circle-check"></i> {{ session('success_message') }}</span>
                    <i class="fa-solid fa-xmark" style="cursor: pointer;" onclick="this.parentElement.remove()"></i>
                </div>
            @endif

            @if(session('error_message'))
                <div class="alert-box alert-error">
                    <span><i class="fa-solid fa-triangle-exclamation"></i> {{ session('error_message') }}</span>
                    <i class="fa-solid fa-xmark" style="cursor: pointer;" onclick="this.parentElement.remove()"></i>
                </div>
            @endif

            <!-- Bot Live Status Banner -->
            <div class="bot-status-banner">
                <div class="bot-status-left">
                    <div class="bot-icon-circle">
                        <i class="fa-brands fa-telegram"></i>
                    </div>
                    <div>
                        <div class="bot-info-title">AI Giá Rẻ Việt Nam (@{{ $settings['telegram_bot_username'] }})</div>
                        <div class="bot-info-subtitle">
                            Webhook URL: <code>{{ url('/webhook/telegram') }}</code>
                            @if(!empty($webhookInfo['result']['url']))
                                <span style="background: rgba(16, 185, 129, 0.3); padding: 2px 8px; border-radius: 6px; font-weight: 700; margin-left: 6px;">
                                    <i class="fa-solid fa-check"></i> Webhook Đang Kết Nối
                                </span>
                            @else
                                <span style="background: rgba(245, 158, 11, 0.3); padding: 2px 8px; border-radius: 6px; font-weight: 700; margin-left: 6px;">
                                    <i class="fa-solid fa-circle-exclamation"></i> Chưa đặt Webhook
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bot-status-actions">
                    <form action="{{ route('admin.telegram.webhook.set') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-status-act">
                            <i class="fa-solid fa-link"></i> Kích hoạt Webhook
                        </button>
                    </form>

                    <a href="{{ route('admin.telegram.test') }}" class="btn-status-act">
                        <i class="fa-solid fa-bolt"></i> Test Bot Ping
                    </a>

                    <form action="{{ route('admin.telegram.webhook.delete') }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn hủy Webhook?')">
                        @csrf
                        <button type="submit" class="btn-status-act" style="background: rgba(239, 68, 68, 0.3);">
                            <i class="fa-solid fa-unlink"></i> Hủy Webhook
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div>
                        <h4>Doanh thu Bot</h4>
                        <div class="val" style="color: #0284c7;">{{ number_format($stats['total_revenue'], 0, ',', '.') }}₫</div>
                    </div>
                    <div class="stat-icon" style="background: #e0f2fe; color: #0284c7;">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div>
                        <h4>Đơn hàng Telegram</h4>
                        <div class="val">{{ $stats['completed_orders'] }} / {{ $stats['total_orders'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #dcfce7; color: #16a34a;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div>
                        <h4>Khách hàng Bot</h4>
                        <div class="val">{{ $stats['total_users'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div>
                        <h4>Số dư ví người dùng</h4>
                        <div class="val" style="color: #7c3aed;">{{ number_format($stats['total_wallet_balance'], 0, ',', '.') }}₫</div>
                    </div>
                    <div class="stat-icon" style="background: #f3e8ff; color: #7c3aed;">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div>
                        <h4>Kho Key Bản Quyền</h4>
                        <div class="val" style="color: #059669;">{{ $stats['total_stock_keys'] }} <small style="font-size:0.8rem;">sẵn sàng</small></div>
                    </div>
                    <div class="stat-icon" style="background: #d1fae5; color: #059669;">
                        <i class="fa-solid fa-key"></i>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="tabs-nav">
                <a href="{{ route('admin.telegram.index', ['tab' => 'overview']) }}" class="tab-btn {{ $tab === 'overview' ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i> Tổng quan
                </a>
                <a href="{{ route('admin.telegram.index', ['tab' => 'settings']) }}" class="tab-btn {{ $tab === 'settings' ? 'active' : '' }}">
                    <i class="fa-solid fa-sliders"></i> Cài đặt Bot & SePay
                </a>
                <a href="{{ route('admin.telegram.index', ['tab' => 'categories']) }}" class="tab-btn {{ $tab === 'categories' ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i> Danh mục ({{ $categories->count() }})
                </a>
                <a href="{{ route('admin.telegram.index', ['tab' => 'products']) }}" class="tab-btn {{ $tab === 'products' ? 'active' : '' }}">
                    <i class="fa-solid fa-boxes-stacked"></i> Sản phẩm Bot ({{ $products->count() }})
                </a>
                <a href="{{ route('admin.telegram.index', ['tab' => 'stock']) }}" class="tab-btn {{ $tab === 'stock' ? 'active' : '' }}">
                    <i class="fa-solid fa-database"></i> Quản lý Kho Key / Tài Khoản
                </a>
                <a href="{{ route('admin.telegram.index', ['tab' => 'orders']) }}" class="tab-btn {{ $tab === 'orders' ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i> Đơn hàng Bot ({{ $orders->total() }})
                </a>
                <a href="{{ route('admin.telegram.index', ['tab' => 'users']) }}" class="tab-btn {{ $tab === 'users' ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Khách hàng & Ví ({{ $users->total() }})
                </a>
                <a href="{{ route('admin.telegram.index', ['tab' => 'broadcast']) }}" class="tab-btn {{ $tab === 'broadcast' ? 'active' : '' }}">
                    <i class="fa-solid fa-bullhorn"></i> Gửi thông báo (Broadcast)
                </a>
            </div>

            <!-- TAB 1: OVERVIEW -->
            @if($tab === 'overview')
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
                    <!-- Recent Orders -->
                    <div class="content-card">
                        <div class="card-header-flex">
                            <h3 class="card-title"><i class="fa-solid fa-clock-rotate-left"></i> Đơn hàng Telegram gần đây</h3>
                            <a href="{{ route('admin.telegram.index', ['tab' => 'orders']) }}" class="btn-outline">Xem tất cả</a>
                        </div>

                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Sản phẩm</th>
                                        <th>Số tiền</th>
                                        <th>Phương thức</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders->take(6) as $ord)
                                        <tr>
                                            <td><strong>#{{ $ord->order_code }}</strong></td>
                                            <td>{{ $ord->telegramUser ? $ord->telegramUser->full_name : 'N/A' }}</td>
                                            <td>{{ $ord->product_name }} (x{{ $ord->quantity }})</td>
                                            <td><strong>{{ number_format($ord->total_amount, 0, ',', '.') }}₫</strong></td>
                                            <td>
                                                @if($ord->payment_method === 'wallet')
                                                    <span class="badge-status badge-info"><i class="fa-solid fa-wallet"></i> Ví</span>
                                                @else
                                                    <span class="badge-status badge-success"><i class="fa-solid fa-qrcode"></i> VietQR</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($ord->status === 'completed')
                                                    <span class="badge-status badge-success"><i class="fa-solid fa-circle-check"></i> Hoàn tất</span>
                                                @elseif($ord->status === 'pending')
                                                    <span class="badge-status badge-warning"><i class="fa-solid fa-clock"></i> Chờ thanh toán</span>
                                                @else
                                                    <span class="badge-status badge-danger">{{ strtoupper($ord->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">Chưa có đơn hàng nào qua bot. Hãy vào bot và thử mua 1 sản phẩm!</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Quick Bot Info & Stock Status -->
                    <div>
                        <div class="content-card">
                            <h3 class="card-title" style="margin-bottom: 1rem;"><i class="fa-solid fa-circle-info"></i> Thông tin Bot</h3>
                            <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.88rem;">
                                <div><strong>Bot Name:</strong> {{ $botInfo['result']['first_name'] ?? 'AI Giá Rẻ Việt Nam' }}</div>
                                <div><strong>Username:</strong> @{{ $settings['telegram_bot_username'] }}</div>
                                <div><strong>Bot ID:</strong> <code>{{ $botInfo['result']['id'] ?? '8817526380' }}</code></div>
                                <div><strong>Hoa hồng giới thiệu:</strong> <span class="tag-pill">{{ $settings['telegram_ref_commission'] }}%</span></div>
                                <div><strong>Admin Nhận Báo Đơn:</strong> <code>{{ $settings['telegram_admin_id'] }}</code></div>
                            </div>
                        </div>

                        <div class="content-card">
                            <h3 class="card-title" style="margin-bottom: 1rem;"><i class="fa-solid fa-box-archive"></i> Tồn kho nhanh</h3>
                            <div style="display: flex; flex-direction: column; gap: 0.65rem;">
                                @foreach($products->take(5) as $p)
                                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; border-bottom: 1px dashed var(--border-color); padding-bottom: 0.4rem;">
                                        <span>{{ $p->name }}</span>
                                        @if($p->stock_count > 0)
                                            <span class="badge-status badge-success">{{ $p->stock_count }} tài khoản</span>
                                        @else
                                            <span class="badge-status badge-danger">Hết hàng</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div style="margin-top: 1rem; text-align: center;">
                                <a href="{{ route('admin.telegram.index', ['tab' => 'stock']) }}" class="btn-primary" style="font-size: 0.8rem; padding: 0.45rem 1rem;">
                                    <i class="fa-solid fa-plus"></i> Nhập kho hàng loạt
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div class="modal" id="editCategoryModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Chỉnh Sửa Danh Mục Bot</h4>
                            <button class="close-modal" onclick="closeModal('editCategoryModal')">&times;</button>
                        </div>
                        <form id="editCategoryForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="name" id="edit_cat_name" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Biểu tượng (Emoji)</label>
                                    <input type="text" name="icon" id="edit_cat_icon" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="edit_cat_sort" class="form-input">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" id="edit_cat_active" value="1"> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Lưu Thay Đổi Danh Mục</button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- TAB 2: SETTINGS -->
            @if($tab === 'settings')
                <div class="content-card">
                    <h3 class="card-title"><i class="fa-solid fa-gear"></i> Cấu hình Bot Telegram & Webhook SePay</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem;">
                        Tất cả thông tin thiết lập quan trọng để Bot hoạt động trơn tru 24/7 và xác thực tự động thanh toán qua SePay.
                    </p>

                    <form action="{{ route('admin.telegram.settings.update') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Telegram Bot Token (Từ @BotFather)</label>
                                <input type="text" name="telegram_bot_token" class="form-input" value="{{ old('telegram_bot_token', $settings['telegram_bot_token']) }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Username Bot (không cần @)</label>
                                <input type="text" name="telegram_bot_username" class="form-input" value="{{ old('telegram_bot_username', $settings['telegram_bot_username']) }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">SePay Webhook Token / API Key</label>
                                <input type="text" name="sepay_webhook_token" class="form-input" value="{{ old('sepay_webhook_token', $settings['sepay_webhook_token']) }}" required>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">
                                    * Token SePay: <code>{{ $settings['sepay_webhook_token'] }}</code>
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Telegram Admin ID (nhận thông báo đơn hàng)</label>
                                <input type="text" name="telegram_admin_id" class="form-input" value="{{ old('telegram_admin_id', $settings['telegram_admin_id']) }}" placeholder="VD: 8199725778">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Tỷ lệ hoa hồng giới thiệu (%)</label>
                                <input type="number" name="telegram_ref_commission" class="form-input" value="{{ old('telegram_ref_commission', $settings['telegram_ref_commission']) }}" min="0" max="100">
                                <span style="font-size: 0.75rem; color: var(--text-muted);">* Người giới thiệu nhận % này từ tổng giá trị đơn khi bạn bè mua.</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Telegram Admin Hỗ trợ (@handle)</label>
                                <input type="text" name="telegram_support_admin" class="form-input" value="{{ old('telegram_support_admin', $settings['telegram_support_admin']) }}" placeholder="@specademy">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Zalo Hỗ trợ Hotline 1</label>
                                <input type="text" name="telegram_support_phone" class="form-input" value="{{ old('telegram_support_phone', $settings['telegram_support_phone']) }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Zalo Hỗ trợ Hotline 2</label>
                                <input type="text" name="telegram_support_phone_2" class="form-input" value="{{ old('telegram_support_phone_2', $settings['telegram_support_phone_2']) }}">
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label class="form-label">Danh sách Website hiển thị ở hỗ trợ</label>
                            <input type="text" name="telegram_support_websites" class="form-input" value="{{ old('telegram_support_websites', $settings['telegram_support_websites']) }}">
                        </div>

                        <div style="background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 1.25rem; margin-bottom: 1.5rem;">
                            <h4 style="font-size: 0.9rem; font-weight: 700; margin-bottom: 0.4rem;"><i class="fa-solid fa-code"></i> Đường dẫn Webhook Telegram:</h4>
                            <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                                Khi bạn bấm nút "Kích hoạt Webhook" ở trên, URL sau sẽ được đăng ký tự động với Telegram:
                            </p>
                            <code>{{ url('/webhook/telegram') }}</code>
                        </div>

                        <div style="text-align: right;">
                            <button type="submit" class="btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i> Lưu cấu hình Bot & SePay
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- TAB 3: CATEGORIES -->
            @if($tab === 'categories')
                <div class="content-card">
                    <div class="card-header-flex">
                        <h3 class="card-title"><i class="fa-solid fa-layer-group"></i> Danh mục sản phẩm Bot ({{ $categories->count() }})</h3>
                        <button class="btn-primary" onclick="openModal('addCategoryModal')">
                            <i class="fa-solid fa-plus"></i> Thêm danh mục mới
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Tên danh mục</th>
                                    <th>Số lượng sản phẩm</th>
                                    <th>Thứ tự sắp xếp</th>
                                    <th>Trạng thái</th>
                                    <th style="text-align: right;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $cat)
                                    <tr>
                                        <td style="font-size: 1.5rem;">{{ $cat->icon }}</td>
                                        <td><strong>{{ $cat->name }}</strong></td>
                                        <td><span class="badge-status badge-info">{{ $cat->products_count }} sản phẩm</span></td>
                                        <td>{{ $cat->sort_order }}</td>
                                        <td>
                                            @if($cat->is_active)
                                                <span class="badge-status badge-success">Hiển thị</span>
                                            @else
                                                <span class="badge-status badge-danger">Ẩn</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right; white-space: nowrap;">
                                            <button type="button" class="btn-outline" style="padding: 0.35rem 0.65rem; font-size: 0.8rem; margin-right: 4px;"
                                                onclick="openEditCategoryModal({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->icon }}', {{ $cat->sort_order }}, {{ $cat->is_active ? 1 : 0 }})">
                                                <i class="fa-solid fa-pen-to-square"></i> Sửa
                                            </button>
                                            <form action="{{ route('admin.telegram.categories.delete', $cat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Xóa danh mục này sẽ xóa tất cả sản phẩm và key thuộc danh mục. Tiếp tục?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div class="modal" id="editCategoryModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Chỉnh Sửa Danh Mục Bot</h4>
                            <button class="close-modal" onclick="closeModal('editCategoryModal')">&times;</button>
                        </div>
                        <form id="editCategoryForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="name" id="edit_cat_name" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Biểu tượng (Emoji)</label>
                                    <input type="text" name="icon" id="edit_cat_icon" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="edit_cat_sort" class="form-input">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" id="edit_cat_active" value="1"> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Lưu Thay Đổi Danh Mục</button>
                        </form>
                    </div>
                </div>

                <!-- Add Category Modal -->
                <div class="modal" id="addCategoryModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm Danh Mục Bot Mới</h4>
                            <button class="close-modal" onclick="closeModal('addCategoryModal')">&times;</button>
                        </div>
                        <form action="{{ route('admin.telegram.categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="name" class="form-input" placeholder="Ví dụ: ChatGPT & OpenAI..." required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Biểu tượng (Emoji)</label>
                                    <input type="text" name="icon" class="form-input" placeholder="Ví dụ: 🤖, 🎨, ✂️" value="📦" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" class="form-input" value="1">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" value="1" checked> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Thêm Danh Mục</button>
                        </form>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div class="modal" id="editCategoryModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Chỉnh Sửa Danh Mục Bot</h4>
                            <button class="close-modal" onclick="closeModal('editCategoryModal')">&times;</button>
                        </div>
                        <form id="editCategoryForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="name" id="edit_cat_name" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Biểu tượng (Emoji)</label>
                                    <input type="text" name="icon" id="edit_cat_icon" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="edit_cat_sort" class="form-input">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" id="edit_cat_active" value="1"> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Lưu Thay Đổi Danh Mục</button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- TAB 4: PRODUCTS -->
            @if($tab === 'products')
                <div class="content-card">
                    <div class="card-header-flex">
                        <h3 class="card-title"><i class="fa-solid fa-boxes-stacked"></i> Danh sách sản phẩm Bot ({{ $products->count() }})</h3>
                        <button class="btn-primary" onclick="openModal('addProductModal')">
                            <i class="fa-solid fa-plus"></i> Thêm sản phẩm mới
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Danh mục</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá bán</th>
                                    <th>Tồn kho (Key sẵn)</th>
                                    <th>Đã bán</th>
                                    <th>Loại giao hàng</th>
                                    <th>Trạng thái</th>
                                    <th style="text-align: right;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $p)
                                    <tr>
                                        <td>
                                            <span class="tag-pill">{{ $p->category ? $p->category->icon . ' ' . $p->category->name : 'Chưa phân loại' }}</span>
                                        </td>
                                        <td><strong>{{ $p->name }}</strong></td>
                                        <td>
                                            <strong style="color: var(--primary);">{{ number_format($p->price, 0, ',', '.') }}₫</strong>
                                            @if($p->original_price)
                                                <small style="text-decoration: line-through; color: var(--text-muted); display: block;">{{ number_format($p->original_price, 0, ',', '.') }}₫</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($p->delivery_type === 'static_text')
                                                <span class="badge-status badge-info">Vô hạn (Tự động)</span>
                                            @elseif($p->stock_count > 0)
                                                <span class="badge-status badge-success">📦 {{ $p->stock_count }} tài khoản</span>
                                            @else
                                                <span class="badge-status badge-danger">Hết hàng</span>
                                            @endif
                                        </td>
                                        <td>{{ $p->sold_count }}</td>
                                        <td>
                                            @if($p->delivery_type === 'key_stock')
                                                <span class="tag-pill">Kho Key / Acc</span>
                                            @elseif($p->delivery_type === 'static_text')
                                                <span class="tag-pill">Nội dung cố định</span>
                                            @else
                                                <span class="tag-pill">Thủ công</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($p->is_active)
                                                <span class="badge-status badge-success">Bán chạy</span>
                                            @else
                                                <span class="badge-status badge-danger">Tắt</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right; white-space: nowrap;">
                                            <button type="button" class="btn-outline" style="padding: 0.35rem 0.65rem; font-size: 0.8rem; margin-right: 4px;"
                                                data-prod="{{ json_encode([
                                                    'id' => $p->id,
                                                    'category_id' => $p->category_id,
                                                    'name' => $p->name,
                                                    'price' => $p->price,
                                                    'original_price' => $p->original_price,
                                                    'delivery_type' => $p->delivery_type,
                                                    'description' => $p->description,
                                                    'guide_text' => $p->guide_text,
                                                    'static_content' => $p->static_content,
                                                    'sort_order' => $p->sort_order,
                                                    'is_active' => $p->is_active ? 1 : 0,
                                                ]) }}"
                                                onclick="openEditProductModal(this)">
                                                <i class="fa-solid fa-pen-to-square"></i> Sửa
                                            </button>
                                            <form action="{{ route('admin.telegram.products.delete', $p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Edit Product Modal -->
                <div class="modal" id="editProductModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Chỉnh Sửa Sản Phẩm Bot</h4>
                            <button class="close-modal" onclick="closeModal('editProductModal')">&times;</button>
                        </div>
                        <form id="editProductForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Chọn Danh mục</label>
                                <select name="category_id" id="edit_prod_category_id" class="form-select" required>
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->icon }} {{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" id="edit_prod_name" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Giá bán (VND)</label>
                                    <input type="number" name="price" id="edit_prod_price" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Giá gốc hiển thị (gạch ngang)</label>
                                    <input type="number" name="original_price" id="edit_prod_original_price" class="form-input">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Loại giao hàng</label>
                                    <select name="delivery_type" id="edit_prod_delivery_type" class="form-select">
                                        <option value="key_stock">Xuất tự động từ Kho Key / Tài khoản</option>
                                        <option value="static_text">Gửi tin nhắn hướng dẫn / link cố định</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="edit_prod_sort" class="form-input">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Mô tả sản phẩm</label>
                                <textarea name="description" id="edit_prod_description" class="form-textarea" rows="3"></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Hướng dẫn sử dụng</label>
                                <textarea name="guide_text" id="edit_prod_guide" class="form-textarea" rows="2"></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" id="edit_prod_active" value="1"> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Lưu Thay Đổi Sản Phẩm</button>
                        </form>
                    </div>
                </div>

                <!-- Add Product Modal -->
                <div class="modal" id="addProductModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm Sản Phẩm Mới Bán Trên Bot</h4>
                            <button class="close-modal" onclick="closeModal('addProductModal')">&times;</button>
                        </div>
                        <form action="{{ route('admin.telegram.products.store') }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Chọn Danh mục</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->icon }} {{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-input" placeholder="Ví dụ: ChatGPT Plus 1 tháng BH 30 ngày" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Giá bán (VND)</label>
                                    <input type="number" name="price" class="form-input" placeholder="99000" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Giá gốc hiển thị (gạch ngang)</label>
                                    <input type="number" name="original_price" class="form-input" placeholder="150000">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Loại giao hàng</label>
                                <select name="delivery_type" class="form-select">
                                    <option value="key_stock">Xuất tự động từ Kho Key / Tài khoản (Khuyên dùng)</option>
                                    <option value="static_text">Gửi tin nhắn hướng dẫn / link cố định</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Mô tả sản phẩm (hiển thị khi bấm xem)</label>
                                <textarea name="description" class="form-textarea" rows="3" placeholder="Chi tiết quyền lợi, thời hạn sử dụng..."></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Hướng dẫn sử dụng (gửi kèm khi thanh toán thành công)</label>
                                <textarea name="guide_text" class="form-textarea" rows="2" placeholder="Ví dụ: Đăng nhập tại trang web..., mật khẩu là..."></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" value="1" checked> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Tạo Sản Phẩm</button>
                        </form>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div class="modal" id="editCategoryModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Chỉnh Sửa Danh Mục Bot</h4>
                            <button class="close-modal" onclick="closeModal('editCategoryModal')">&times;</button>
                        </div>
                        <form id="editCategoryForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="name" id="edit_cat_name" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Biểu tượng (Emoji)</label>
                                    <input type="text" name="icon" id="edit_cat_icon" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="edit_cat_sort" class="form-input">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" id="edit_cat_active" value="1"> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Lưu Thay Đổi Danh Mục</button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- TAB 5: STOCK / KEYS MANAGEMENT -->
            @if($tab === 'stock')
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem;">
                    <!-- Bulk Import Form -->
                    <div class="content-card">
                        <h3 class="card-title" style="margin-bottom: 1rem;"><i class="fa-solid fa-file-import"></i> Nhập Kho Hàng Loạt</h3>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">
                            Dán danh sách tài khoản hoặc mã key (mỗi dòng 1 key/acc). Hệ thống sẽ tự động tách và đưa vào kho để bot tự xuất khi khách mua.
                        </p>

                        <form action="{{ route('admin.telegram.stock.store') }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Chọn sản phẩm cần nhập</label>
                                <select name="product_id" class="form-select" required>
                                    @foreach($products as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }} (Hiện có {{ $p->stock_count }} key)</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" style="margin-bottom: 1.25rem;">
                                <label class="form-label">Danh sách tài khoản / Key (Mỗi dòng 1 mục)</label>
                                <textarea name="keys_content" class="form-textarea" rows="10" placeholder="user01@gmail.com|Pass123
user02@gmail.com|Pass123
KEY-PRO-ABC123-XYZ
https://link-invite-canva.com/..." required></textarea>
                            </div>

                            <button type="submit" class="btn-primary" style="width: 100%;">
                                <i class="fa-solid fa-upload"></i> Nhập Vào Kho Ngay
                            </button>
                        </form>
                    </div>

                    <!-- Stock List Table -->
                    <div class="content-card">
                        <h3 class="card-title" style="margin-bottom: 1rem;"><i class="fa-solid fa-list-check"></i> Danh sách Key / Tài khoản trong kho ({{ $stockKeys->total() }})</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Nội dung tài khoản / Key</th>
                                        <th>Trạng thái</th>
                                        <th>Đơn hàng</th>
                                        <th style="text-align: right;">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stockKeys as $k)
                                        <tr>
                                            <td><strong>{{ $k->product ? $k->product->name : 'N/A' }}</strong></td>
                                            <td><code>{{ Str::limit($k->account_data, 35) }}</code></td>
                                            <td>
                                                @if($k->is_used)
                                                    <span class="badge-status badge-danger"><i class="fa-solid fa-check"></i> Đã bán</span>
                                                @else
                                                    <span class="badge-status badge-success"><i class="fa-solid fa-box"></i> Còn trống</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($k->used_by_order_id)
                                                    <a href="{{ route('admin.telegram.index', ['tab' => 'orders']) }}" class="tag-pill">Đơn #{{ $k->used_by_order_id }}</a>
                                                @else
                                                    <span style="color: var(--text-muted);">-</span>
                                                @endif
                                            </td>
                                            <td style="text-align: right;">
                                                <form action="{{ route('admin.telegram.stock.delete', $k->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa mã key này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" style="text-align: center; color: var(--text-muted); padding: 2rem;">Chưa có key nào trong kho. Hãy dán danh sách ở cột bên trái để nhập kho!</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-top: 1rem;">
                            {{ $stockKeys->appends(['tab' => 'stock'])->links() }}
                        </div>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div class="modal" id="editCategoryModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Chỉnh Sửa Danh Mục Bot</h4>
                            <button class="close-modal" onclick="closeModal('editCategoryModal')">&times;</button>
                        </div>
                        <form id="editCategoryForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="name" id="edit_cat_name" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Biểu tượng (Emoji)</label>
                                    <input type="text" name="icon" id="edit_cat_icon" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="edit_cat_sort" class="form-input">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" id="edit_cat_active" value="1"> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Lưu Thay Đổi Danh Mục</button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- TAB 6: ORDERS -->
            @if($tab === 'orders')
                <div class="content-card">
                    <h3 class="card-title" style="margin-bottom: 1.5rem;"><i class="fa-solid fa-receipt"></i> Quản lý Đơn hàng Telegram ({{ $orders->total() }})</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Số tiền</th>
                                    <th>Phương thức</th>
                                    <th>Trạng thái</th>
                                    <th>Dữ liệu đã giao</th>
                                    <th>Thời gian</th>
                                    <th style="text-align: right;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $ord)
                                    <tr>
                                        <td><strong>#{{ $ord->order_code }}</strong></td>
                                        <td>
                                            <strong>{{ $ord->telegramUser ? $ord->telegramUser->full_name : 'N/A' }}</strong>
                                            <div style="font-size: 0.75rem; color: var(--text-muted);">ID: {{ $ord->telegramUser ? $ord->telegramUser->telegram_id : '' }}</div>
                                        </td>
                                        <td>{{ $ord->product_name }} (x{{ $ord->quantity }})</td>
                                        <td><strong style="color: var(--primary);">{{ number_format($ord->total_amount, 0, ',', '.') }}₫</strong></td>
                                        <td>
                                            @if($ord->payment_method === 'wallet')
                                                <span class="badge-status badge-info"><i class="fa-solid fa-wallet"></i> Ví</span>
                                            @else
                                                <span class="badge-status badge-success"><i class="fa-solid fa-qrcode"></i> VietQR</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($ord->status === 'completed')
                                                <span class="badge-status badge-success"><i class="fa-solid fa-circle-check"></i> Hoàn tất</span>
                                            @elseif($ord->status === 'pending')
                                                <span class="badge-status badge-warning"><i class="fa-solid fa-clock"></i> Chờ thanh toán</span>
                                            @else
                                                <span class="badge-status badge-danger">{{ strtoupper($ord->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($ord->delivered_data)
                                                <code title="{{ $ord->delivered_data }}">{{ Str::limit($ord->delivered_data, 20) }}</code>
                                            @else
                                                <span style="color: var(--text-muted);">Chưa giao</span>
                                            @endif
                                        </td>
                                        <td style="font-size: 0.8rem; color: var(--text-muted);">{{ $ord->created_at->format('d/m/Y H:i') }}</td>
                                        <td style="text-align: right; white-space: nowrap;">
                                            @if($ord->status === 'pending')
                                                <form action="{{ route('admin.telegram.orders.complete', $ord->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Duyệt đơn và tự động xuất tài khoản gửi cho khách qua Telegram?')">
                                                    @csrf
                                                    <button type="submit" class="btn-primary" style="padding: 0.35rem 0.65rem; font-size: 0.75rem;">
                                                        <i class="fa-solid fa-paper-plane"></i> Duyệt & Giao Key
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.telegram.orders.cancel', $ord->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hủy đơn hàng này?')">
                                                    @csrf
                                                    <button type="submit" class="btn-danger" style="padding: 0.35rem 0.65rem; font-size: 0.75rem;">
                                                        <i class="fa-solid fa-xmark"></i> Hủy
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="9" style="text-align: center; color: var(--text-muted); padding: 2rem;">Chưa có đơn hàng nào trên Bot.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top: 1rem;">
                        {{ $orders->appends(['tab' => 'orders'])->links() }}
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div class="modal" id="editCategoryModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Chỉnh Sửa Danh Mục Bot</h4>
                            <button class="close-modal" onclick="closeModal('editCategoryModal')">&times;</button>
                        </div>
                        <form id="editCategoryForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="name" id="edit_cat_name" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Biểu tượng (Emoji)</label>
                                    <input type="text" name="icon" id="edit_cat_icon" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="edit_cat_sort" class="form-input">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" id="edit_cat_active" value="1"> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Lưu Thay Đổi Danh Mục</button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- TAB 7: USERS & WALLET -->
            @if($tab === 'users')
                <div class="content-card">
                    <h3 class="card-title" style="margin-bottom: 1.5rem;"><i class="fa-solid fa-users"></i> Danh sách Khách hàng & Số dư ví ({{ $users->total() }})</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Telegram ID</th>
                                    <th>Tên hiển thị</th>
                                    <th>Username</th>
                                    <th>Số dư ví</th>
                                    <th>Tổng đã chi</th>
                                    <th>Đơn đã mua</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tham gia</th>
                                    <th style="text-align: right;">Thao tác ví</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $u)
                                    <tr>
                                        <td><code>{{ $u->telegram_id }}</code></td>
                                        <td><strong>{{ $u->full_name }}</strong></td>
                                        <td>{{ $u->username ? '@' . $u->username : '-' }}</td>
                                        <td><strong style="color: #7c3aed;">{{ number_format($u->balance, 0, ',', '.') }}₫</strong></td>
                                        <td>{{ number_format($u->total_spent, 0, ',', '.') }}₫</td>
                                        <td><span class="tag-pill">{{ $u->orders_count }} đơn</span></td>
                                        <td>
                                            @if($u->is_banned)
                                                <span class="badge-status badge-danger">Bị khóa</span>
                                            @else
                                                <span class="badge-status badge-success">Hoạt động</span>
                                            @endif
                                        </td>
                                        <td style="font-size: 0.8rem; color: var(--text-muted);">{{ $u->created_at->format('d/m/Y') }}</td>
                                        <td style="text-align: right; white-space: nowrap;">
                                            <button class="btn-outline" style="padding: 0.35rem 0.65rem; font-size: 0.75rem;" onclick="openBalanceModal({{ $u->id }}, '{{ $u->full_name }}', {{ $u->balance }})">
                                                <i class="fa-solid fa-money-bill-transfer"></i> Nạp/Trừ Ví
                                            </button>
                                            <form action="{{ route('admin.telegram.users.ban', $u->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn-danger" style="padding: 0.35rem 0.65rem; font-size: 0.75rem;">
                                                    {{ $u->is_banned ? 'Mở Khóa' : 'Khóa' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="9" style="text-align: center; color: var(--text-muted); padding: 2rem;">Chưa có người dùng nào bấm /start trên Bot.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top: 1rem;">
                        {{ $users->appends(['tab' => 'users'])->links() }}
                    </div>
                </div>

                <!-- Adjust Balance Modal -->
                <div class="modal" id="balanceModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cộng / Trừ Tiền Ví Thủ Công</h4>
                            <button class="close-modal" onclick="closeModal('balanceModal')">&times;</button>
                        </div>
                        <form id="balanceForm" method="POST">
                            @csrf
                            <p style="font-size: 0.9rem; margin-bottom: 1rem;">
                                Thành viên: <strong id="modalUserName"></strong><br>
                                Số dư hiện tại: <strong id="modalCurrentBalance" style="color: #7c3aed;"></strong>
                            </p>
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Số tiền điều chỉnh (VND)</label>
                                <input type="number" name="amount" class="form-input" placeholder="Ví dụ: 50000 để cộng, -20000 để trừ" required>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">* Nhập số dương để cộng tiền, số âm (-) để trừ tiền.</span>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label class="form-label">Lý do điều chỉnh (gửi tin nhắn thông báo cho khách)</label>
                                <input type="text" name="reason" class="form-input" placeholder="Ví dụ: Thưởng thành viên VIP, Hoàn tiền đơn hàng..." required>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Xác nhận cập nhật ví</button>
                        </form>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div class="modal" id="editCategoryModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Chỉnh Sửa Danh Mục Bot</h4>
                            <button class="close-modal" onclick="closeModal('editCategoryModal')">&times;</button>
                        </div>
                        <form id="editCategoryForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="name" id="edit_cat_name" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Biểu tượng (Emoji)</label>
                                    <input type="text" name="icon" id="edit_cat_icon" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" id="edit_cat_sort" class="form-input">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="is_active" id="edit_cat_active" value="1"> Bật hiển thị ngay trên Bot
                                </label>
                            </div>
                            <button type="submit" class="btn-primary" style="width: 100%;">Lưu Thay Đổi Danh Mục</button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- TAB 8: BROADCAST -->
            @if($tab === 'broadcast')
                <div class="content-card" style="max-width: 800px; margin: 0 auto;">
                    <h3 class="card-title" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-bullhorn"></i> Gửi Tin Nhắn / Khuyến Mãi Hàng Loạt (Broadcast)</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem;">
                        Tin nhắn sẽ được gửi tự động đến tất cả <strong>{{ $stats['total_users'] }} người dùng</strong> đang hoạt động trên Bot Telegram của bạn.
                    </p>

                    <form action="{{ route('admin.telegram.broadcast') }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn gửi thông báo này tới toàn bộ thành viên bot?')">
                        @csrf
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label">Nội dung tin nhắn (Hỗ trợ HTML: &lt;b&gt;, &lt;i&gt;, emojis...)</label>
                            <textarea name="message_content" class="form-textarea" rows="8" placeholder="🔥 SIÊU SALE HÔM NAY! 🔥
Giảm ngay 20% cho tất cả tài khoản CapCut Pro & ChatGPT Plus khi thanh toán qua ví.
Nhanh tay vào mua ngay số lượng có hạn!" required></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Chữ trên nút bấm (Tùy chọn)</label>
                                <input type="text" name="btn_text" class="form-input" placeholder="Ví dụ: 🛒 Xem Cửa Hàng Ngay">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Link chuyển đến khi bấm nút (Tùy chọn)</label>
                                <input type="url" name="btn_url" class="form-input" placeholder="https://t.me/{{ $settings['telegram_bot_username'] }} hoặc https://aicuatoi.com">
                            </div>
                        </div>

                        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 1rem;">
                            <i class="fa-solid fa-paper-plane"></i> Gửi Thông Báo Hàng Loạt Ngay
                        </button>
                    </form>
                </div>
            @endif
        </main>
    </div>

    <!-- Script to handle modals -->
    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function openEditCategoryModal(id, name, icon, sort, isActive) {
            document.getElementById('edit_cat_name').value = name;
            document.getElementById('edit_cat_icon').value = icon;
            document.getElementById('edit_cat_sort').value = sort;
            document.getElementById('edit_cat_active').checked = (isActive == 1);
            document.getElementById('editCategoryForm').action = '/admin/telegram/categories/' + id;
            openModal('editCategoryModal');
        }

        function openEditProductModal(btn) {
            const data = JSON.parse(btn.getAttribute('data-prod'));
            document.getElementById('edit_prod_category_id').value = data.category_id;
            document.getElementById('edit_prod_name').value = data.name;
            document.getElementById('edit_prod_price').value = data.price;
            document.getElementById('edit_prod_original_price').value = data.original_price || '';
            document.getElementById('edit_prod_delivery_type').value = data.delivery_type || 'key_stock';
            document.getElementById('edit_prod_sort').value = data.sort_order || 0;
            document.getElementById('edit_prod_description').value = data.description || '';
            document.getElementById('edit_prod_guide').value = data.guide_text || '';
            document.getElementById('edit_prod_active').checked = (data.is_active == 1);
            document.getElementById('editProductForm').action = '/admin/telegram/products/' + data.id;
            openModal('editProductModal');
        }

        function openBalanceModal(userId, userName, currentBalance) {
            document.getElementById('modalUserName').innerText = userName;
            document.getElementById('modalCurrentBalance').innerText = new Intl.NumberFormat('vi-VN').format(currentBalance) + '₫';
            document.getElementById('balanceForm').action = '/admin/telegram/users/' + userId + '/balance';
            openModal('balanceModal');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        };
    </script>
</body>
</html>
