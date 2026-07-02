<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Thanh Toán Thành Công | AI CỦA TÔI</title>
    <meta name="description" content="Đơn hàng của bạn đã được thanh toán thành công và kích hoạt tại AI CỦA TÔI.">
    <meta name="robots" content="noindex, nofollow">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-body: #f8fafc;
            --primary: #0284c7;
            --primary-hover: #0369a1;
            --success: #10b981;
            --text-main: #0f172a;
            --text-dark: #334155;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --radius-md: 12px;
            --radius-lg: 20px;
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Header link home */
        .brand-header {
            text-align: center;
            padding: 2rem 0 1rem 0;
        }

        .brand-header a {
            text-decoration: none;
            color: var(--text-main);
            font-size: 1.5rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .brand-header a i {
            color: var(--primary);
        }

        /* Success card */
        .success-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.03);
            text-align: center;
            width: 100%;
        }

        .success-icon-box {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ecfdf5;
            color: var(--success);
            border: 3px solid #d1fae5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 1.5rem auto;
            animation: bounce 0.6s ease;
        }

        @keyframes bounce {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.1); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }

        .success-card h1 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #065f46;
            margin-bottom: 0.5rem;
        }

        .success-card p.subtitle {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        /* Key Box */
        .activation-key-box {
            background: #f0fdf4;
            border: 1px dashed #bbf7d0;
            border-radius: var(--radius-md);
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .key-header {
            font-size: 0.78rem;
            font-weight: 700;
            color: #166534;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.65rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .key-value-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            border: 1px solid #dcfce7;
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .key-value {
            font-family: monospace;
            font-size: 1.15rem;
            font-weight: 700;
            color: #15803d;
        }

        .copy-btn {
            background: none;
            border: none;
            color: #166534;
            cursor: pointer;
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .copy-btn:hover {
            color: #15803d;
            transform: scale(1.1);
        }

        /* Details list */
        .details-list {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            background: #f8fafc;
            padding: 1.25rem;
            text-align: left;
            margin-bottom: 2rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-bottom: 0.75rem;
            color: var(--text-dark);
        }

        .detail-row:last-child {
            margin-bottom: 0;
            border-top: 1px dashed var(--border-color);
            padding-top: 0.75rem;
            font-weight: 800;
        }

        .detail-row span.label {
            color: var(--text-muted);
        }

        /* Buttons */
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            padding: 0.85rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.88rem;
            width: 48%;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: #0f172a;
            color: white;
        }

        .btn-secondary:hover {
            background: #000000;
        }

        .btn-row {
            display: flex;
            justify-content: space-between;
        }

        /* Support Message Box */
        .support-msg-box {
            background: #f0f9ff;
            border: 1px dashed #bae6fd;
            padding: 1rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .support-msg-text-box {
            flex: 1;
            min-width: 0;
        }
        .support-msg-btn {
            background: #0284c7;
            color: white;
            border: none;
            padding: 0.5rem 0.8rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            white-space: nowrap;
            margin-left: 1rem;
            transition: all 0.2s;
        }
        .support-msg-btn:hover {
            background: #0369a1;
        }

        @media (max-width: 600px) {
            .btn-row {
                flex-direction: column;
                gap: 1rem;
            }
            .btn-action {
                width: 100%;
            }
            .support-msg-box {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .support-msg-btn {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <header class="brand-header">
        <a href="/">
            <i class="fa-solid fa-rocket"></i>
            <span>AI CỦA TÔI</span>
        </a>
    </header>

    <main class="container">
        <div class="success-card">
            <div class="success-icon-box">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            
            @if($order->status === 'completed')
                <h1>Giao Hàng Thành Công!</h1>
                <p class="subtitle">Đơn hàng mã <strong>#OD{{ 1000 + $order->id }}</strong> đã được hoàn tất thành công.</p>
            @else
                <h1>Đã Nhận Thanh Toán!</h1>
                <p class="subtitle">Hệ thống đã nhận đủ tiền thanh toán cho đơn hàng mã <strong>#OD{{ 1000 + $order->id }}</strong> từ SePay.</p>
            @endif

            @if($order->status === 'completed' && $order->activation_key)
                <!-- License activation key box -->
                <div class="activation-key-box">
                    <div class="key-header">
                        <i class="fa-solid fa-key"></i> Bản quyền / Mã kích hoạt của bạn:
                    </div>
                    <div class="key-value-row">
                        <span class="key-value" id="license-key">{{ $order->activation_key }}</span>
                        <button class="copy-btn" onclick="copyKey()" title="Copy mã kích hoạt"><i class="fa-regular fa-copy"></i></button>
                    </div>
                    <p style="font-size: 0.72rem; color: #166534; margin-top: 0.5rem; font-style: italic;">
                        * Copy mã trên và dán vào phần cài đặt tài khoản của bạn để nâng cấp Pro/Plus.
                    </p>
                </div>
            @else
                <div class="activation-key-box" style="background: #fffbeb; border-color: #fde68a;">
                    <div class="key-header" style="color: #92400e; text-transform: uppercase;">
                        <i class="fa-solid fa-arrows-spin fa-spin"></i> Trạng thái chờ duyệt nâng cấp:
                    </div>
                    <p style="font-size: 0.82rem; color: #92400e; font-weight: 600; line-height: 1.4; text-align: left;">
                        Đơn hàng đang chờ kỹ thuật viên duyệt và nâng cấp trực tiếp vào tài khoản <strong>{{ $order->upgrade_details }}</strong>. Vui lòng đợi 3-5 phút hoặc liên hệ Zalo hỗ trợ nếu quá thời gian trên.
                    </p>
                </div>
            @endif

            <!-- Copy info for Admin -->
            <div class="support-msg-box">
                <div class="support-msg-text-box">
                    <div style="font-size: 0.78rem; font-weight: 700; color: #0369a1; margin-bottom: 0.4rem;"><i class="fa-solid fa-copy"></i> MẪU TIN NHẮN GỬI HỖ TRỢ:</div>
                    <div id="admin-copy-text" style="font-size: 0.95rem; font-weight: 600; color: #0c4a6e;">OD{{ 1000 + $order->id }} - {{ $order->product_name }} - #OD{{ 1000 + $order->id }}</div>
                </div>
                <button type="button" onclick="copyAdminText()" class="support-msg-btn">
                    <i class="fa-regular fa-copy"></i> Copy
                </button>
            </div>

            <!-- Order details summary -->
            <div class="details-list">
                <div class="detail-row">
                    <span class="label">Nội dung thanh toán:</span>
                    <span><strong>OD{{ 1000 + $order->id }}</strong></span>
                </div>
                <div class="detail-row">
                    <span class="label">Mã đơn hàng:</span>
                    <span><strong>#OD{{ 1000 + $order->id }}</strong></span>
                </div>
                <div class="detail-row">
                    <span class="label">Sản phẩm:</span>
                    <span><strong>{{ $order->product_name }}</strong></span>
                </div>
                <div class="detail-row">
                    <span class="label">Email nâng cấp:</span>
                    <span>{{ $order->upgrade_details }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Thời gian:</span>
                    <span>{{ $order->updated_at->format('H:i - d/m/Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Tổng tiền đã thanh toán:</span>
                    <span>{{ number_format($order->price, 0, ',', '.') }}₫</span>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="btn-row">
                <a href="/orders" class="btn-action btn-primary">
                    <i class="fa-solid fa-clock-rotate-left"></i> Xem Đơn Hàng
                </a>
                <a href="/" class="btn-action btn-secondary">
                    <i class="fa-solid fa-house"></i> Quay Lại Trang Chủ
                </a>
            </div>
        </div>
    </main>

    <script>
        function copyKey() {
            const key = document.getElementById('license-key').innerText;
            navigator.clipboard.writeText(key).then(() => {
                alert('Đã copy mã kích hoạt: ' + key);
            }).catch(err => {
                console.error('Không thể copy: ', err);
            });
        }

        function copyAdminText() {
            const text = document.getElementById('admin-copy-text').innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('Đã copy nội dung! Bạn có thể dán (Paste) để gửi cho nhân viên hỗ trợ Zalo nhé.');
            }).catch(err => {
                console.error('Không thể copy: ', err);
            });
        }
    </script>
</body>
</html>
