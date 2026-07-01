<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cấu Hình Hệ Thống | AI CỦA TÔI Admin</title>
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
            color: var(--secondary);
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
            max-width: 1000px;
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

        /* Forms */
        .settings-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
        }

        .settings-card h2 {
            font-size: 1.15rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .settings-card h2 i {
            color: var(--primary);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            margin-bottom: 1.25rem;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .form-input {
            width: 100%;
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

        .btn-save-settings {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: var(--radius-md);
            font-weight: 800;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-save-settings:hover {
            background: var(--primary-hover);
        }

        /* Webhook info card */
        .webhook-info-box {
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            margin-top: 1rem;
        }

        .webhook-url-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            margin-top: 0.5rem;
            font-family: monospace;
            font-size: 0.85rem;
            color: #0369a1;
        }

        .copy-btn {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            font-size: 0.95rem;
        }

        .copy-btn:hover {
            color: var(--primary-hover);
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
                <a href="/admin/orders"><i class="fa-solid fa-receipt"></i> Đơn hàng</a>
            </li>
            <li class="menu-item active">
                <a href="/admin/settings"><i class="fa-solid fa-gears"></i> Cấu hình</a>
            </li>
        </ul>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="page-title">Cài Đặt Hệ Thống</div>
            
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

            <form action="/admin/settings" method="POST">
                @csrf
                @method('PUT')

                <!-- Bank Config -->
                <div class="settings-card">
                    <h2><i class="fa-solid fa-building-columns"></i> Cấu hình Ngân Hàng nhận thanh toán (VietQR)</h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="bank_name">Tên hiển thị ngân hàng</label>
                            <input type="text" name="bank_name" id="bank_name" class="form-input" placeholder="Ví dụ: MB Bank, Vietcombank..." value="{{ old('bank_name', $settings['bank_name']) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="bank_id">Mã ngân hàng (VietQR Bank ID)</label>
                            <input type="text" name="bank_id" id="bank_id" class="form-input" placeholder="Ví dụ: MB, VCB, TCB, ACB..." value="{{ old('bank_id', $settings['bank_id']) }}" required>
                            <span style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem;">
                                * Mã ngân hàng viết tắt chuẩn để sinh QR (ví dụ: MB, VCB, TCB, ACB, VPB).
                            </span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="bank_account_no">Số tài khoản ngân hàng</label>
                            <input type="text" name="bank_account_no" id="bank_account_no" class="form-input" placeholder="Nhập số tài khoản nhận tiền..." value="{{ old('bank_account_no', $settings['bank_account_no']) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="bank_account_name">Họ và tên chủ tài khoản (Không dấu)</label>
                            <input type="text" name="bank_account_name" id="bank_account_name" class="form-input" placeholder="Ví dụ: NGUYEN VAN A" value="{{ old('bank_account_name', $settings['bank_account_name']) }}" required>
                        </div>
                    </div>
                </div>

                <!-- SePay Config -->
                <div class="settings-card">
                    <h2><i class="fa-solid fa-bolt"></i> Tự động hóa thanh toán ngân hàng qua Webhook SePay</h2>
                    
                    <div class="form-group">
                        <label class="form-label" for="sepay_webhook_token">SePay Webhook Token xác thực (API Key)</label>
                        <input type="text" name="sepay_webhook_token" id="sepay_webhook_token" class="form-input" placeholder="Token bảo mật webhook..." value="{{ old('sepay_webhook_token', $settings['sepay_webhook_token']) }}" required>
                        <span style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem;">
                            * Dùng để xác thực yêu cầu gửi đến từ SePay tránh các bên giả mạo giao dịch. Bạn có thể tự đặt một chuỗi dài tùy ý và cấu hình trùng khớp trên trang cấu hình SePay.
                        </span>
                    </div>

                    <div class="webhook-info-box">
                        <h4 style="font-size: 0.85rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.35rem;">
                            Địa chỉ Webhook URL của bạn (Cấu hình trên sepay.vn):
                        </h4>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">
                            Vui lòng copy URL bên dưới và dán vào phần cấu hình Webhook URL trên trang quản trị SePay của bạn:
                        </p>
                        <div class="webhook-url-line">
                            <span id="webhook-url-val">{{ url('/webhook/sepay') }}?token={{ $settings['sepay_webhook_token'] }}</span>
                            <button type="button" class="copy-btn" onclick="copyWebhookUrl()"><i class="fa-regular fa-copy"></i> Copy</button>
                        </div>
                    </div>
                </div>

                <div style="text-align: right;">
                    <button type="submit" class="btn-save-settings">
                        <i class="fa-solid fa-floppy-disk"></i> Lưu tất cả cấu hình
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        function copyWebhookUrl() {
            const urlVal = document.getElementById('webhook-url-val').innerText;
            navigator.clipboard.writeText(urlVal).then(() => {
                alert('Đã copy địa chỉ Webhook URL kèm Token bảo mật!');
            });
        }
    </script>
</body>
</html>
