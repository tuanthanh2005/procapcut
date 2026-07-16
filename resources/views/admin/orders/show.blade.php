<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Xử Lý Đơn Hàng #OD{{ 1000 + $order->id }} | Admin</title>
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

        .content-container {
            padding: 2.5rem;
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .btn-back:hover {
            color: var(--text-main);
        }

        /* Grid */
        .details-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 2rem;
            align-items: start;
        }

        .details-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
        }

        .details-card h2 {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 1.25rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .details-card h2 i {
            color: var(--primary);
        }

        /* Lists */
        .info-list {
            list-style: none;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            font-size: 0.85rem;
            border-bottom: 1px solid #f8fafc;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .info-val {
            font-weight: 700;
            color: var(--text-main);
            text-align: right;
        }

        /* Form */
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
            padding: 0.65rem 0.85rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            background: #f8fafc;
            color: var(--text-main);
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: 600;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--primary);
            background: #ffffff;
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            width: 100%;
            transition: var(--transition);
        }

        .btn-submit:hover {
            background: var(--primary-hover);
        }

        /* Order items summary */
        .item-box {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1rem;
            background: #f8fafc;
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .item-quantity {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.2rem;
        }

        .item-price {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--text-main);
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
        <header class="top-navbar">
            <div class="page-title">Xử Lý Đơn Hàng #OD{{ 1000 + $order->id }}</div>
        </header>

        <main class="content-container">
            <a href="/admin/orders" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Quay lại danh sách</a>

            <div class="details-grid">
                <!-- Left: Order Details & Products -->
                <div>
                    <!-- Order details card -->
                    <div class="details-card">
                        <h2><i class="fa-solid fa-circle-info"></i> Thông tin đơn hàng</h2>
                        <ul class="info-list">
                            <li class="info-row">
                                <span class="info-label">Mã đơn hàng:</span>
                                <span class="info-val" style="color: var(--primary);">#OD{{ 1000 + $order->id }}</span>
                            </li>
                            <li class="info-row">
                                <span class="info-label">Ngày đặt hàng:</span>
                                <span class="info-val">{{ $order->created_at->format('H:i d/m/Y') }}</span>
                            </li>
                            <li class="info-row">
                                <span class="info-label">Phương thức thanh toán:</span>
                                <span class="info-val">{{ $order->payment_method === 'momo' ? 'Ví điện tử Momo' : 'Chuyển khoản QR MB Bank' }}</span>
                            </li>
                            <li class="info-row">
                                <span class="info-label">Email / Tài khoản cần nâng cấp:</span>
                                <span class="info-val" style="color: #ef4444; font-size: 0.95rem;">{{ $order->upgrade_details }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Products list card -->
                    <div class="details-card">
                        <h2><i class="fa-solid fa-basket-shopping"></i> Danh sách sản phẩm mua</h2>
                        
                        @if(!empty($order->items))
                            @foreach($order->items as $item)
                                <div class="item-box">
                                    <div>
                                        <div class="item-name">
                                            @if(isset($item['icon']))
                                                <i class="fa-solid {{ strtok($item['icon'], ' ') }}" style="color: var(--primary); margin-right: 0.25rem;"></i>
                                            @endif
                                            {{ $item['name'] }}
                                        </div>
                                        <div class="item-quantity">Số lượng: {{ $item['quantity'] ?? 1 }}</div>
                                    </div>
                                    <span class="item-price">{{ number_format($item['price'], 0, ',', '.') }}₫</span>
                                </div>
                            @endforeach
                        @else
                            <div class="item-box">
                                <div>
                                    <div class="item-name">{{ $order->product_name }}</div>
                                    <div class="item-quantity">Đơn hàng legacy</div>
                                </div>
                                <span class="item-price">{{ number_format($order->price, 0, ',', '.') }}₫</span>
                            </div>
                        @endif

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; border-top: 1px dashed var(--border-color); padding-top: 1rem;">
                            <span style="font-weight: 800; font-size: 0.9rem;">Tổng tiền đơn hàng:</span>
                            <span style="font-size: 1.25rem; font-weight: 900; color: var(--primary);">{{ number_format($order->price, 0, ',', '.') }}₫</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Action & Customer Info -->
                <div>
                    <!-- Customer Card -->
                    <div class="details-card">
                        <h2><i class="fa-regular fa-user"></i> Khách hàng</h2>
                        <ul class="info-list">
                            <li class="info-row">
                                <span class="info-label">Họ tên:</span>
                                <span class="info-val">{{ $order->customer_name ?? $order->user->name }}</span>
                            </li>
                            <li class="info-row">
                                <span class="info-label">Số điện thoại:</span>
                                <span class="info-val">{{ $order->customer_phone ?? 'Không có' }}</span>
                            </li>
                            <li class="info-row">
                                <span class="info-label">Email:</span>
                                <span class="info-val" style="word-break: break-all;">{{ $order->customer_email ?? $order->user->email }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Processing status form -->
                    <form action="/admin/orders/{{ $order->id }}/status" method="POST" id="order-status-form">
                        @csrf
                        @method('PUT')

                        <div class="details-card">
                            <h2><i class="fa-solid fa-sliders"></i> Xử lý & Phê duyệt</h2>
                            
                            <div class="form-group">
                                <label class="form-label" for="status">Trạng thái đơn hàng</label>
                                <select name="status" id="status" class="form-input">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ thanh toán</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Chờ duyệt (Đã thanh toán)</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Hoàn thành (Đã cấp key)</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </div>

                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label class="form-label" for="activation_key">Mã kích hoạt / Tài khoản bàn giao</label>
                                <input type="text" name="activation_key" id="activation_key" class="form-input" placeholder="Gõ Key kích hoạt hoặc tài khoản..." value="{{ old('activation_key', $order->activation_key) }}">
                                <span style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem;">
                                    * Thông tin này sẽ hiện trực tiếp tại trang lịch sử mua hàng của khách hàng sau khi chuyển trạng thái thành "Hoàn thành".
                                </span>
                            </div>

                            <div style="border-top: 1px solid var(--border-color); margin: 1.5rem 0; padding-top: 1.5rem;">
                                <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-regular fa-envelope" style="color: var(--primary);"></i> Gửi Email Bàn Giao
                                </h3>
                                
                                <div class="form-group">
                                    <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; user-select: none; font-weight: bold; margin-bottom: 0.75rem;">
                                        <input type="checkbox" name="send_email" id="send_email" value="1" checked style="width: 16px; height: 16px; accent-color: var(--primary);">
                                        Gửi email bàn giao tài khoản cho khách hàng
                                    </label>
                                </div>

                                <div class="form-group" id="email_content_group" style="margin-bottom: 0;">
                                    <label class="form-label" for="email_content">Mẫu Email gửi khách hàng (Có thể chỉnh sửa)</label>
                                    <textarea name="email_content" id="email_content" class="form-input" rows="12" style="font-family: inherit; font-size: 0.82rem; line-height: 1.5; resize: vertical; background: #ffffff; font-weight: normal; padding: 0.75rem;" placeholder="Nội dung email...">Chào {{ $order->customer_name ?? ($order->user ? $order->user->name : 'Khách hàng') }},

Đơn hàng #OD{{ 1000 + $order->id }} mua sản phẩm "{{ $order->product_name }}" của bạn tại website AI CỦA TÔI (https://aicuatoi.com) đã hoàn thành và kích hoạt thành công!

Dưới đây là thông tin tài khoản / mã kích hoạt bàn giao của bạn:
--------------------------------------------------
[Nội dung tài khoản / key]
--------------------------------------------------

Hệ thống đã tự động kích hoạt gói dịch vụ. Bạn có thể sử dụng ngay bây giờ.
Nếu gặp bất kỳ khó khăn nào trong quá trình cài đặt hoặc sử dụng, vui lòng liên hệ Zalo hỗ trợ: 0569012134 để được hỗ trợ 24/7.

Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của AI CỦA TÔI (https://aicuatoi.com)!</textarea>
                                    <span style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem;">
                                        * Giữ nguyên dòng <b>[Nội dung tài khoản / key]</b> để hệ thống tự động thay thế bằng thông tin bàn giao thực tế khi gửi.
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit" style="margin-top: 1.5rem; width: 100%;"><i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const activationKeyInput = document.getElementById('activation_key');
            const sendEmailCheckbox = document.getElementById('send_email');
            const emailContentGroup = document.getElementById('email_content_group');
            const statusSelect = document.getElementById('status');
            const form = document.getElementById('order-status-form');

            // Toggle visibility of email content based on checkbox state
            sendEmailCheckbox.addEventListener('change', function () {
                if (sendEmailCheckbox.checked) {
                    emailContentGroup.style.display = 'flex';
                } else {
                    emailContentGroup.style.display = 'none';
                }
            });

            // Automatically select completed status if activation key is filled and status is pending/processing
            activationKeyInput.addEventListener('input', function() {
                if (activationKeyInput.value.trim() !== '' && (statusSelect.value === 'pending' || statusSelect.value === 'processing')) {
                    statusSelect.value = 'completed';
                }
            });

            // Show Yes/No confirmation dialog before submitting
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                let confirmMessage = "Bạn có chắc chắn muốn cập nhật trạng thái đơn hàng?";
                if (sendEmailCheckbox.checked) {
                    const emailDestination = {!! json_encode($order->customer_email ?? ($order->user ? $order->user->email : '')) !!};
                    confirmMessage = `XÁC NHẬN PHÊ DUYỆT ĐƠN HÀNG\n\n- Trạng thái mới: ${statusSelect.options[statusSelect.selectedIndex].text}\n- Bàn giao: ${activationKeyInput.value}\n- Gửi email bàn giao tới: ${emailDestination}\n\nBạn có đồng ý phê duyệt và gửi email này không?`;
                }

                if (confirm(confirmMessage)) {
                    form.submit();
                }
            });
        });
    </script>

</body>
</html>
