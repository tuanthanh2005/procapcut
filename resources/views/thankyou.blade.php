<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Đặt Hàng Thành Công | AI CỦA TÔI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-body: #f8fafc;
            --primary: #10b981; /* Green theme for success */
            --primary-hover: #059669;
            --secondary: #34d399;
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

        /* Navbar */
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

        .logo i {
            color: #0284c7;
            font-size: 1.6rem;
        }

        /* Thank you box */
        .thankyou-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 3rem 2rem;
            box-shadow: var(--shadow-md);
            margin-top: 3rem;
            margin-bottom: 4rem;
            text-align: center;
        }

        .success-icon {
            width: 5rem;
            height: 5rem;
            border-radius: 50%;
            background: #ecfdf5;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
            border: 1px solid #d1fae5;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .thankyou-card h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .thankyou-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        /* Order details box */
        .order-summary-box {
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            text-align: left;
            margin-bottom: 2rem;
        }

        .order-summary-box h3 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.5rem;
            color: var(--text-main);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            font-size: 0.88rem;
            color: var(--text-dark);
        }

        .summary-row.total {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--text-main);
            border-top: 1px dashed var(--border-color);
            padding-top: 0.75rem;
            margin-top: 0.75rem;
        }

        /* Instructions QR section */
        .payment-instructions {
            border-top: 1px solid var(--border-color);
            padding-top: 2rem;
            margin-top: 2rem;
        }

        .payment-instructions h2 {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .payment-instructions p.subtitle {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .payment-details-card {
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            text-align: left;
            margin-bottom: 1.5rem;
        }

        .instruction-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.65rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .instruction-line:last-child {
            border-bottom: none;
        }

        .instruction-line span.label {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .instruction-line span.value {
            font-size: 0.88rem;
            color: var(--text-main);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .copy-btn {
            background: none;
            border: none;
            color: #0284c7;
            cursor: pointer;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .copy-btn:hover {
            color: #0369a1;
        }

        /* QR Image */
        .qr-code-img {
            max-width: 250px;
            width: 100%;
            height: auto;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            margin: 1.5rem auto;
            display: block;
            background: #ffffff;
            padding: 0.5rem;
        }

        .trust-badge-line {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            color: var(--text-muted);
            font-size: 0.78rem;
            margin-top: 2rem;
        }

        .trust-badge-line span {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .trust-badge-line i {
            color: var(--primary);
        }

        .btn-return-home {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #0f172a;
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.75rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.88rem;
            transition: var(--transition);
            margin-top: 1.5rem;
        }

        .btn-return-home:hover {
            background: #000000;
        }

        /* Wide screen side-by-side layout styles */
        .thankyou-split-layout {
            display: flex;
            gap: 2.5rem;
            margin-top: 1.5rem;
            text-align: left;
        }

        .thankyou-left-col {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .thankyou-right-col {
            flex: 0.8;
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .payment-instructions {
            border-top: none;
            padding-top: 0;
            margin-top: 0;
        }

        @media (max-width: 768px) {
            .thankyou-split-layout {
                flex-direction: column;
                gap: 1.5rem;
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
                    @if(file_exists(public_path('logo.png')))
                        <img src="{{ asset('logo.png') }}?v={{ time() }}" alt="Logo" style="max-height: 2.2rem; object-fit: contain;">
                    @else
                        <i class="fa-solid fa-rocket logo-icon"></i>
                        <span>AI CỦA TÔI</span>
                    @endif
                </a>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="thankyou-card" style="padding: 2.5rem 2rem;">
            @if($order->status === 'cancelled')
                <!-- Cancelled State -->
                <div class="success-icon" style="background: #fef2f2; color: #ef4444; border-color: #fee2e2; margin-bottom: 1.5rem; animation: none;">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <h1 style="font-size: 1.6rem; margin-bottom: 0.5rem; color: #991b1b;">Đơn Hàng Đã Bị Hủy!</h1>
                <p style="margin-bottom: 2rem;">Đơn hàng mã <strong>#OD{{ 1000 + $order->id }}</strong> đã quá hạn thời gian thanh toán 5 phút nên đã tự động bị hủy.</p>
                <div style="background: #fff5f5; border: 1px solid #fee2e2; color: #991b1b; padding: 1.25rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-align: center; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.5;">
                    Giao dịch chuyển khoản cho đơn hàng này sẽ không được xử lý tự động nữa. Quý khách vui lòng quay lại trang chủ để tạo đơn hàng mới.
                </div>
                <div style="text-align: center;">
                    <a href="/" class="btn-return-home" style="margin: 0; background: #0f172a;"><i class="fa-solid fa-house"></i> Quay Lại Trang Chủ</a>
                </div>
            @else
                <!-- Pending Payment State -->
                <!-- Header section -->
                <div class="success-icon" style="background: #e0f2fe; color: #0284c7; border-color: #bae6fd; margin-bottom: 1rem;">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                </div>
                <h1 style="font-size: 1.6rem; margin-bottom: 0.5rem;">Đang Chờ Thanh Toán...</h1>
                <p style="margin-bottom: 0.5rem;">Đơn hàng mã <strong>#OD{{ 1000 + $order->id }}</strong> đang đợi bạn quét mã thanh toán chuyển khoản.</p>
                
                @php
                    $remainingSeconds = max(0, 300 - (time() - $order->created_at->timestamp));
                @endphp
                
                <div style="background: #fff1f2; color: #e11d48; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.85rem; font-weight: 800; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 1.5rem; border: 1px solid #ffe4e6;">
                    <i class="fa-regular fa-clock"></i>
                    Đơn hàng hết hạn sau: <span id="countdown-timer">05:00</span>
                </div>
                
                <div style="background: rgba(2, 132, 199, 0.05); color: #0284c7; padding: 0.75rem; border-radius: 8px; font-size: 0.8rem; font-weight: 700; margin-bottom: 1.5rem; display: inline-flex; align-items: center; gap: 0.5rem; justify-content: center; width: 100%;">
                    <i class="fa-solid fa-arrows-spin fa-spin"></i>
                    Hệ thống đang kiểm tra giao dịch qua SePay ngân hàng tự động...
                </div>

                <!-- Horizontal Split layout -->
                <div class="thankyou-split-layout">
                    <!-- Left column: Order summary and Payment details -->
                    <div class="thankyou-left-col">
                        <div class="order-summary-box" style="margin-bottom: 0;">
                            <h3 style="font-size: 0.95rem; margin-bottom: 0.75rem;">Chi Tiết Đơn Hàng</h3>
                            <div class="summary-row">
                                <span>Khách hàng:</span>
                                <span><strong>{{ $order->customer_name }}</strong> ({{ $order->customer_phone }})</span>
                            </div>
                            <div class="summary-row">
                                <span>Tài khoản cần nâng cấp:</span>
                                <span><strong>{{ $order->upgrade_details }}</strong></span>
                            </div>
                            <div class="summary-row">
                                <span>Phương thức:</span>
                                <span><strong>{{ $order->payment_method === 'momo' ? 'Ví điện tử Momo' : 'Chuyển khoản VietQR' }}</strong></span>
                            </div>
                            <div class="summary-row total" style="margin-top: 0.5rem; padding-top: 0.5rem; font-size: 1rem;">
                                <span>Tổng tiền thanh toán:</span>
                                <span>{{ number_format($order->price, 0, ',', '.') }}₫</span>
                            </div>
                        </div>

                        <div class="payment-instructions">
                            <div class="payment-details-card" style="margin-bottom: 0; padding: 1.25rem;">
                                <h3 style="font-size: 0.95rem; margin-bottom: 1rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; font-weight: 800; display: flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-solid fa-building-columns" style="color: var(--primary);"></i> Thông Tin Chuyển Khoản
                                </h3>
                                @if($order->payment_method === 'qr_bank')
                                    <div class="instruction-line">
                                        <span class="label">Ngân hàng</span>
                                        <span class="value">{{ \App\Models\Setting::getValue('bank_name', 'MB Bank') }}</span>
                                    </div>
                                    <div class="instruction-line">
                                        <span class="label">Số tài khoản</span>
                                        <span class="value">
                                            <span id="bank-acc">{{ \App\Models\Setting::getValue('bank_account_no', '0987654321') }}</span>
                                            <button class="copy-btn" onclick="copyText('bank-acc', 'số tài khoản')"><i class="fa-regular fa-copy"></i></button>
                                        </span>
                                    </div>
                                    <div class="instruction-line">
                                        <span class="label">Chủ tài khoản</span>
                                        <span class="value">{{ \App\Models\Setting::getValue('bank_account_name', 'TRAN THI THUY TRANG') }}</span>
                                    </div>
                                    <div class="instruction-line">
                                        <span class="label">Số tiền chuyển</span>
                                        <span class="value">
                                            <span id="bank-amount">{{ number_format($order->price, 0, ',', '.') }}₫</span>
                                            <button class="copy-btn" onclick="copyTextValue('{{ $order->price }}', 'số tiền')"><i class="fa-regular fa-copy"></i></button>
                                        </span>
                                    </div>
                                    <div class="instruction-line">
                                        <span class="label">Nội dung chuyển (Bắt buộc)</span>
                                        <span class="value" style="color: #ef4444; font-size: 0.88rem; font-weight: 800;">
                                            <span id="bank-memo">OD{{ 1000 + $order->id }}</span>
                                            <button class="copy-btn" onclick="copyText('bank-memo', 'nội dung chuyển khoản')"><i class="fa-regular fa-copy"></i></button>
                                        </span>
                                    </div>
                                @else
                                    <div class="instruction-line">
                                        <span class="label">Ví điện tử</span>
                                        <span class="value">MoMo</span>
                                    </div>
                                    <div class="instruction-line">
                                        <span class="label">Số điện thoại MoMo</span>
                                        <span class="value">
                                            <span id="momo-phone">0987654321</span>
                                            <button class="copy-btn" onclick="copyText('momo-phone', 'số điện thoại Momo')"><i class="fa-regular fa-copy"></i></button>
                                        </span>
                                    </div>
                                    <div class="instruction-line">
                                        <span class="label">Chủ tài khoản</span>
                                        <span class="value">TRAN THI THUY TRANG</span>
                                    </div>
                                    <div class="instruction-line">
                                        <span class="label">Số tiền cần chuyển</span>
                                        <span class="value">
                                            <span>{{ number_format($order->price, 0, ',', '.') }}₫</span>
                                            <button class="copy-btn" onclick="copyTextValue('{{ $order->price }}', 'số tiền')"><i class="fa-regular fa-copy"></i></button>
                                        </span>
                                    </div>
                                    <div class="instruction-line">
                                        <span class="label">Lời nhắn chuyển (Bắt buộc)</span>
                                        <span class="value" style="color: #ef4444; font-size: 0.88rem; font-weight: 800;">
                                            <span id="momo-memo">OD{{ 1000 + $order->id }}</span>
                                            <button class="copy-btn" onclick="copyText('momo-memo', 'nội dung chuyển khoản')"><i class="fa-regular fa-copy"></i></button>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right column: QR image, buttons and trust badge -->
                    <div class="thankyou-right-col">
                        @if($order->payment_method === 'qr_bank')
                            <h4 style="font-size: 0.88rem; font-weight: 800; margin-bottom: 0.5rem; text-align: center; color: var(--text-main);">Quét Mã QR VietQR để thanh toán nhanh</h4>
                            <img class="qr-code-img" src="https://img.vietqr.io/image/{{ \App\Models\Setting::getValue('bank_id', 'MB') }}-{{ \App\Models\Setting::getValue('bank_account_no', '0987654321') }}-compact.png?amount={{ $order->price }}&addInfo=OD{{ 1000 + $order->id }}&accountName={{ rawurlencode(\App\Models\Setting::getValue('bank_account_name', 'TRAN THI THUY TRANG')) }}" alt="VietQR Bank" style="max-width: 200px; margin: 0 auto 0.75rem auto;">
                            <p style="font-size: 0.7rem; color: var(--text-muted); font-style: italic; text-align: center; line-height: 1.3; margin-bottom: 1.5rem;">
                                * App Ngân hàng sẽ tự động điền Số tài khoản, Số tiền và Nội dung chuyển khoản chính xác 100%.
                            </p>
                        @else
                            <h4 style="font-size: 0.88rem; font-weight: 800; margin-bottom: 0.5rem; text-align: center; color: var(--text-main);">Chuyển tiền Ví MoMo thủ công</h4>
                            <div style="background: #ffffff; border: 1px solid var(--border-color); border-radius: 8px; padding: 1.5rem; text-align: center; width: 100%; margin-bottom: 1rem;">
                                <i class="fa-solid fa-mobile-screen-button" style="font-size: 2.5rem; color: #a21caf; margin-bottom: 0.5rem;"></i>
                                <p style="font-size: 0.78rem; color: var(--text-muted);">Mở App MoMo, chọn Chuyển tiền & Nhập đúng số điện thoại và Lời nhắn trên cột trái.</p>
                            </div>
                        @endif

                        <div style="width: 100%; display: flex; flex-direction: column; gap: 0.5rem; margin-top: auto;">
                            <button type="button" id="manual-check-btn" onclick="manualCheckPayment()" class="btn-return-home" style="background: #0284c7; margin: 0; width: 100%; justify-content: center; padding: 0.65rem 1rem; border: none; cursor: pointer;">
                                <i class="fa-solid fa-arrows-rotate"></i> Kiểm Tra Thanh Toán
                            </button>
                            <a href="/" class="btn-return-home" style="margin: 0; width: 100%; justify-content: center; padding: 0.65rem 1rem;"><i class="fa-solid fa-house"></i> Quay Lại Trang Chủ</a>
                        </div>
                        
                        <div style="display: flex; flex-direction: column; gap: 0.35rem; font-size: 0.72rem; color: var(--text-muted); margin-top: 1rem; width: 100%; border-top: 1px solid var(--border-color); padding-top: 0.75rem;">
                            <span><i class="fa-solid fa-shield-halved" style="color: var(--primary);"></i> Bảo mật giao dịch</span>
                            <span><i class="fa-solid fa-bolt" style="color: var(--primary);"></i> Nâng cấp siêu tốc 3-5 phút</span>
                            <span><i class="fa-solid fa-headset" style="color: var(--primary);"></i> Hỗ trợ Zalo 24/7</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer style="background: #0f172a; border-top: 1px solid rgba(255, 255, 255, 0.05); padding: 2rem 0; color: #94a3b8; font-size: 0.8rem; text-align: center;">
        <div class="container">
            &copy; {{ date('Y') }} AI CỦA TÔI. Nền tảng phân phối dịch vụ số hàng đầu Việt Nam.
        </div>
    </footer>

    <script>
        function copyText(elementId, typeLabel) {
            const text = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('Đã sao chép ' + typeLabel + ' vào bộ nhớ tạm!');
            });
        }

        function copyTextValue(value, typeLabel) {
            navigator.clipboard.writeText(value).then(() => {
                alert('Đã sao chép ' + typeLabel + ' vào bộ nhớ tạm!');
            });
        }

        // Auto-check order status via API polling & Countdown Timer
        const orderId = "{{ $order->id }}";
        let remainingSeconds = {{ $remainingSeconds ?? 300 }};
        
        // Polling status
        const checkInterval = setInterval(() => {
            fetch(`/api/orders/${orderId}/status`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'completed' || data.status === 'processing') {
                        clearInterval(checkInterval);
                        window.location.href = `/checkout/success/${orderId}`;
                    } else if (data.status === 'cancelled') {
                        clearInterval(checkInterval);
                        window.location.reload();
                    }
                })
                .catch(err => console.log('Checking status error:', err));
        }, 3000);

        // Countdown Timer
        if (remainingSeconds <= 0) {
            handleOrderExpired();
        } else {
            updateTimerDisplay(remainingSeconds);
            const timerInterval = setInterval(() => {
                remainingSeconds--;
                if (remainingSeconds <= 0) {
                    clearInterval(timerInterval);
                    handleOrderExpired();
                } else {
                    updateTimerDisplay(remainingSeconds);
                }
            }, 1000);
        }

        function updateTimerDisplay(secs) {
            const timerEl = document.getElementById('countdown-timer');
            if (!timerEl) return;
            const mins = Math.floor(secs / 60);
            const seconds = secs % 60;
            timerEl.innerText = (mins < 10 ? '0' : '') + mins + ':' + (seconds < 10 ? '0' : '') + seconds;
        }

        function handleOrderExpired() {
            clearInterval(checkInterval);
            fetch(`/api/orders/${orderId}/cancel`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {
                window.location.reload();
            })
            .catch(() => {
                window.location.reload();
            });
        }

        // Manual check payment status button handler
        function manualCheckPayment() {
            const btn = document.getElementById('manual-check-btn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Đang kiểm tra...';
            btn.disabled = true;

            fetch(`/api/orders/${orderId}/status`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'completed' || data.status === 'processing') {
                        clearInterval(checkInterval);
                        window.location.href = `/checkout/success/${orderId}`;
                    } else if (data.status === 'cancelled') {
                        clearInterval(checkInterval);
                        window.location.reload();
                    } else {
                        alert('Hệ thống chưa nhận được thanh toán chuyển khoản của bạn.\n\nNếu bạn đã chuyển khoản thành công, vui lòng đợi 1-2 phút để ngân hàng xử lý hoặc liên hệ Zalo hỗ trợ nhé!');
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                })
                .catch(err => {
                    alert('Có lỗi xảy ra khi kiểm tra. Vui lòng thử lại.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
        }
    </script>
</body>
</html>
