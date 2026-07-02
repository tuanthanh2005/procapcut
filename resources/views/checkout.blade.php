<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Thanh Toán Đơn Hàng | AI CỦA TÔI</title>
    <meta name="description" content="Thanh toán đơn hàng nâng cấp tài khoản của bạn an toàn, nhanh chóng tại AI CỦA TÔI.">
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
        }

        /* Layout columns */
        .checkout-wrapper {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
            margin-bottom: 4rem;
            align-items: start;
        }

        .checkout-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2.25rem;
            box-shadow: var(--shadow-sm);
        }

        .checkout-card h2 {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-main);
        }

        .checkout-card h2 i {
            color: var(--primary);
        }

        /* Form styling */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
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
            color: var(--text-dark);
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
            font-weight: 500;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }

        /* Payment selector */
        .payment-methods-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .payment-method-card {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--transition);
            background: #f8fafc;
            position: relative;
        }

        .payment-method-card:hover {
            border-color: var(--primary);
        }

        .payment-method-card.active {
            border-color: var(--primary);
            background: rgba(2, 132, 199, 0.02);
            box-shadow: 0 0 0 1px var(--primary);
        }

        .payment-method-card input[type="radio"] {
            accent-color: var(--primary);
            width: 1.15rem;
            height: 1.15rem;
        }

        .payment-method-info {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .payment-method-info span {
            font-size: 0.85rem;
            font-weight: 700;
        }

        .payment-method-info p {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        /* Cart summary items */
        .summary-items-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .summary-item-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            justify-content: space-between;
        }

        .summary-item-details {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .summary-item-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 8px;
            background: #f0f9ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .summary-item-img-wrapper {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            background: #ffffff;
            flex-shrink: 0;
        }

        .summary-item-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .summary-item-text h4 {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.15rem;
        }

        .summary-item-text p {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .summary-item-price {
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--text-main);
        }

        /* Promo code input */
        .promo-code-box {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1.5rem;
        }

        .btn-apply-promo {
            background: var(--text-main);
            color: #ffffff;
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.82rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-apply-promo:hover {
            background: #000000;
        }

        /* Bill pricing totals */
        .bill-pricing {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .bill-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .bill-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.5rem;
        }

        .bill-total-row span {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .bill-total-row .final-price {
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--primary);
        }

        .btn-checkout-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 1rem;
            border-radius: var(--radius-md);
            font-size: 1rem;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.15);
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-checkout-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.25);
        }

        /* Error alert */
        .checkout-alert {
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fee2e2;
            padding: 1rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Prevent auto zoom on iOS & Native app spacing */
        @media (max-width: 768px) {
            input, select, textarea, .form-input {
                font-size: 16px !important;
            }
            .container {
                padding: 0 0.75rem !important;
            }
            /* Header spacing adjustments */
            header {
                padding: 0.5rem 0 !important;
            }
            .navbar {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                height: 50px !important;
            }
            .logo {
                font-size: 1.2rem !important;
            }
            .action-icon-btn {
                width: 2.25rem !important;
                height: 2.25rem !important;
            }
            /* Checkout content structure */
            .checkout-wrapper {
                grid-template-columns: 1fr !important;
                gap: 1.25rem !important;
                margin-top: 1.25rem !important;
                margin-bottom: 2.5rem !important;
            }
            .checkout-card {
                padding: 1.25rem !important;
                border-radius: var(--radius-md) !important;
            }
            .form-row {
                grid-template-columns: 1fr !important;
                gap: 0 !important;
            }
            .form-group {
                margin-bottom: 1rem !important;
            }
            .payment-methods-grid {
                grid-template-columns: 1fr !important;
                gap: 0.5rem !important;
            }
            .payment-method-card {
                padding: 0.85rem !important;
                min-height: 48px !important;
            }
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
                    <a href="/products" class="action-icon-btn" title="Quay lại cửa hàng"><i class="fa-solid fa-store"></i></a>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="checkout-wrapper">
            <!-- Left Column: Checkout Form -->
            <div>
                <form action="/checkout" method="POST" id="checkout-form">
                    @csrf
                    
                    @if($errors->any())
                        <div class="checkout-alert">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <div class="checkout-card" style="margin-bottom: 1.5rem;">
                        <h2><i class="fa-regular fa-id-card"></i> Thông Tin Khách Hàng</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="customer_name">Họ và tên của bạn</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-input" placeholder="Ví dụ: Nguyễn Văn A" value="{{ old('customer_name', auth()->user()->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="customer_phone">Số điện thoại Zalo</label>
                                <input type="text" name="customer_phone" id="customer_phone" class="form-input" placeholder="Ví dụ: 0987654321" value="{{ old('customer_phone') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="customer_email">Email liên hệ nhận hóa đơn</label>
                            <input type="email" name="customer_email" id="customer_email" class="form-input" placeholder="tenbancan@gmail.com" value="{{ old('customer_email', auth()->user()->email) }}" required>
                        </div>
                    </div>

                    <div class="checkout-card" style="margin-bottom: 1.5rem;">
                        <h2><i class="fa-solid fa-circle-info"></i> Thông Tin Nâng Cấp Tài Khoản</h2>
                        
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" for="upgrade_details">Tài khoản cần nâng cấp (Nhập Email / Tên tài khoản để shop nâng cấp)</label>
                            <textarea name="upgrade_details" id="upgrade_details" class="form-input" rows="3" style="resize: vertical;" placeholder="Nhập email tài khoản CapCut Pro hoặc ChatGPT cần nâng cấp tại đây..." required>{{ old('upgrade_details') }}</textarea>
                        </div>
                    </div>

                    <div class="checkout-card">
                        <h2><i class="fa-regular fa-credit-card"></i> Phương Thức Thanh Toán</h2>
                        
                        <div class="payment-methods-grid">
                            <div class="payment-method-card active" onclick="selectPaymentMethod('qr_bank')">
                                <input type="radio" name="payment_method" id="payment_qr_bank" value="qr_bank" checked style="margin-right: 0.25rem;">
                                <div class="payment-method-info">
                                    <span>Chuyển Khoản QR Ngân Hàng</span>
                                    <p>Tạo mã VietQR quét nhanh tự động</p>
                                </div>
                            </div>
                            
                            <div class="payment-method-card" style="opacity: 0.5; cursor: not-allowed;">
                                <input type="radio" name="payment_method" id="payment_momo" value="momo" disabled style="margin-right: 0.25rem;">
                                <div class="payment-method-info">
                                    <span>Ví điện tử Momo <strong style="color: #ef4444; font-size: 0.72rem;">(Tạm đóng)</strong></span>
                                    <p>Chuyển ví Momo nhanh chóng</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden inputs to submit cart json -->
                    <input type="hidden" name="items_json" id="items_json_hidden">
                </form>
            </div>

            <!-- Right Column: Cart Summary -->
            <div class="checkout-card">
                <h2><i class="fa-solid fa-basket-shopping"></i> Tóm Tắt Đơn Hàng</h2>
                
                <div class="summary-items-list" id="summary-items-container">
                    <!-- Loaded dynamically via JS -->
                </div>

                <div class="promo-code-box">
                    <input type="text" id="promo-input" class="form-input" placeholder="Nhập mã giảm giá (nếu có)" style="background: #ffffff;">
                    <button type="button" class="btn-apply-promo" onclick="applyPromoCode()">Áp dụng</button>
                </div>
                <div id="promo-status" style="font-size: 0.75rem; font-weight: 700; margin-top: -1.25rem; margin-bottom: 1.25rem; display: none;"></div>

                <div class="bill-pricing">
                    <div class="bill-row">
                        <span>Tổng tiền hàng:</span>
                        <span id="bill-subtotal">0₫</span>
                    </div>
                    <div class="bill-row" id="discount-row" style="display: none; color: #10b981;">
                        <span>Mã giảm giá (AI2026 -20%):</span>
                        <span id="bill-discount">-0₫</span>
                    </div>
                    <div class="bill-row">
                        <span>Phí dịch vụ kích hoạt:</span>
                        <span style="color: #10b981; font-weight: 700;">Miễn phí</span>
                    </div>
                    <div class="bill-total-row">
                        <span>Tổng thanh toán:</span>
                        <span class="final-price" id="bill-total">0₫</span>
                    </div>
                </div>

                <button type="button" class="btn-checkout-submit" onclick="submitCheckoutForm()">
                    <i class="fa-solid fa-shield-check"></i> Xác Nhận Đặt Hàng & Thanh Toán
                </button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer style="background: #0f172a; border-top: 1px solid rgba(255, 255, 255, 0.05); padding: 2rem 0; color: #94a3b8; font-size: 0.8rem; text-align: center; margin-top: auto;">
        <div class="container">
            &copy; {{ date('Y') }} AI CỦA TÔI. Nền tảng phân phối dịch vụ số uy tín hàng đầu.
        </div>
    </footer>

    <script>
        let cart = [];
        let subtotal = 0;
        let discount = 0;
        let discountPercent = 0;
        let activePromoCode = '';

        // Load cart items from localStorage on DOM load
        document.addEventListener('DOMContentLoaded', () => {
            const savedCart = localStorage.getItem('capcut_store_cart');
            if (savedCart) {
                try {
                    cart = JSON.parse(savedCart);
                } catch(e) {
                    cart = [];
                }
            }

            if (cart.length === 0) {
                alert('Giỏ hàng trống! Bạn sẽ được chuyển hướng về trang chủ.');
                window.location.href = '/';
                return;
            }

            // Sync hidden inputs
            document.getElementById('items_json_hidden').value = JSON.stringify(cart);

            renderSummary();
        });

        // Format currency function
        function formatVND(amount) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
        }

        // Render Summary Lists
        function renderSummary() {
            const container = document.getElementById('summary-items-container');
            container.innerHTML = '';
            subtotal = 0;

            cart.forEach(item => {
                const itemTotal = item.price * (item.quantity || 1);
                subtotal += itemTotal;

                let mediaHtml = '';
                if (item.image) {
                    mediaHtml = `
                        <div class="summary-item-img-wrapper">
                            <img src="/${item.image}" alt="${item.name}" class="summary-item-img">
                        </div>
                    `;
                } else {
                    mediaHtml = `
                        <div class="summary-item-icon">
                            <i class="fa-solid ${item.icon ? item.icon.split(' ')[0] : 'fa-cube'}"></i>
                        </div>
                    `;
                }

                const row = document.createElement('div');
                row.className = 'summary-item-row';
                row.innerHTML = `
                    <div class="summary-item-details">
                        ${mediaHtml}
                        <div class="summary-item-text">
                            <h4>${item.name}</h4>
                            <p>Số lượng: ${item.quantity || 1}</p>
                        </div>
                    </div>
                    <span class="summary-item-price">${formatVND(itemTotal)}</span>
                `;
                container.appendChild(row);
            });

            calculateTotal();
        }

        // Apply promo discount code
        function applyPromoCode() {
            const input = document.getElementById('promo-input').value.trim().toUpperCase();
            const statusDiv = document.getElementById('promo-status');

            if (input === 'AI2026') {
                discountPercent = 0.20; // 20% discount
                activePromoCode = 'AI2026';
                statusDiv.style.color = '#10b981';
                statusDiv.innerText = 'Áp dụng mã giảm giá AI2026 giảm 20% thành công!';
                statusDiv.style.display = 'block';
            } else if (input === '') {
                discountPercent = 0;
                activePromoCode = '';
                statusDiv.style.display = 'none';
            } else {
                discountPercent = 0;
                activePromoCode = '';
                statusDiv.style.color = '#ef4444';
                statusDiv.innerText = 'Mã giảm giá không hợp lệ hoặc đã hết hạn.';
                statusDiv.style.display = 'block';
            }

            calculateTotal();
        }

        // Calculate total and discounts
        function calculateTotal() {
            discount = Math.round(subtotal * discountPercent);
            const total = subtotal - discount;

            document.getElementById('bill-subtotal').innerText = formatVND(subtotal);

            const discountRow = document.getElementById('discount-row');
            if (discount > 0) {
                discountRow.style.display = 'flex';
                document.getElementById('bill-discount').innerText = '-' + formatVND(discount);
            } else {
                discountRow.style.display = 'none';
            }

            document.getElementById('bill-total').innerText = formatVND(total);
        }

        // Select payment method visually
        function selectPaymentMethod(method) {
            document.querySelectorAll('.payment-method-card').forEach(card => {
                card.classList.remove('active');
            });

            if (method === 'qr_bank') {
                document.getElementById('payment_qr_bank').checked = true;
                document.getElementById('payment_qr_bank').parentElement.classList.add('active');
            } else {
                document.getElementById('payment_momo').checked = true;
                document.getElementById('payment_momo').parentElement.classList.add('active');
            }
        }

        // Submit form validation
        function submitCheckoutForm() {
            // Apply promo calculation to the hidden cart JSON before submitting
            // We can recalculate price in options if coupon code is active
            if (activePromoCode === 'AI2026') {
                // Modify items inside the hidden field to reflect the 20% discount on backend
                const discountedCart = cart.map(item => {
                    const cloned = {...item};
                    cloned.price = Math.round(cloned.price * 0.8);
                    return cloned;
                });
                document.getElementById('items_json_hidden').value = JSON.stringify(discountedCart);
            }

            // Trigger HTML5 validations
            const form = document.getElementById('checkout-form');
            if (form.reportValidity()) {
                // Clear cart from localStorage upon success right before submitting
                localStorage.removeItem('capcut_store_cart');
                form.submit();
            }
        }
    </script>
</body>
</html>
