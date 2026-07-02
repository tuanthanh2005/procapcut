<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Trang Quản Trị Admin | AI CỦA TÔI</title>
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
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        /* Stat cards grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-info h3 {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
        }

        .stat-info p {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: var(--radius-md);
            background: rgba(2, 132, 199, 0.08);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
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
            margin-bottom: 1.25rem;
        }

        .section-header h2 {
            font-size: 1.05rem;
            font-weight: 800;
        }

        .btn-action {
            padding: 0.45rem 0.85rem;
            font-size: 0.82rem;
            font-weight: 600;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-action:hover {
            background: var(--primary-hover);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.88rem;
        }

        th {
            padding: 0.75rem 1rem;
            background: #f8fafc;
            color: var(--text-muted);
            font-weight: 700;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.72rem;
            font-weight: 700;
            border-radius: 4px;
        }

        .status-success {
            background: #ecfdf5;
            color: #10b981;
            border: 1px solid #d1fae5;
        }

        .status-pending {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fef3c7;
        }
    </style>
</head>
<body>

    <!-- Sidebar Left -->
    <aside class="sidebar">
        <a href="/" class="logo-area">
            <i class="fa-solid fa-rocket"></i>
            <span>AI CỦA TÔI</span>
        </a>

        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="/admin/dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            </li>
            <li class="menu-item">
                <a href="/admin/products"><i class="fa-solid fa-cubes"></i> Quản lý sản phẩm</a>
            </li>
            <li class="menu-item">
                <a href="/admin/posts"><i class="fa-solid fa-newspaper"></i> Quản lý bài viết</a>
            </li>
            <li class="menu-item">
                <a href="/admin/orders"><i class="fa-solid fa-shopping-cart"></i> Đơn hàng</a>
            </li>
            <li class="menu-item">
                <a href="/admin/chat"><i class="fa-solid fa-comments"></i> Hỗ trợ Chat</a>
            </li>
            <li class="menu-item">
                <a href="/admin/customers"><i class="fa-solid fa-users"></i> Khách hàng</a>
            </li>
            <li class="menu-item active">
                <a href="/admin/seo"><i class="fa-brands fa-google"></i> Google Index API</a>
            </li>
            <li class="menu-item">
                <a href="/admin/settings"><i class="fa-solid fa-gears"></i> Cấu hình</a>
            </li>
            <li class="menu-item" style="margin-top: auto;">
                <a href="/"><i class="fa-solid fa-house"></i> Quay lại website</a>
            </li>
        </ul>
    </aside>

    <!-- Main Wrapper Right -->
    <div class="main-wrapper">
        <header class="top-navbar">
            <h1 class="page-title">Trang quản trị</h1>
            <div class="user-info-bar">
                <div class="admin-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="admin-name">{{ auth()->user()->name }}</div>
                    <span class="admin-badge">Administrator</span>
                </div>
            </div>
        </header>

        <main class="content-container">
            <div class="data-section">
                <div class="section-header" style="margin-bottom: 2rem;">
                    <h2><i class="fa-brands fa-google" style="color:#ea4335; margin-right: 8px;"></i> Google Indexing API (Tự động Ping)</h2>
                    <p style="color: var(--text-muted); font-weight:normal; margin-top:0.5rem; font-size:0.9rem;">Chọn các danh mục bên dưới hoặc nhập thêm link thủ công để ép Google thu thập dữ liệu ngay lập tức.</p>
                </div>

                @if(session('success'))
                    <div style="background: #ecfdf5; border: 1px solid #10b981; color: #047857; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; font-weight: 600;">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div style="background: #fef2f2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; font-weight: 600;">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.seo.indexUrls') }}" method="POST">
                    @csrf
                    
                    <h3 style="margin-bottom: 1rem; font-size: 0.95rem; font-weight: 700; color:var(--text-main); border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">1. Đẩy nhanh theo nhóm nội dung</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 0.8rem; margin-bottom: 2rem;">
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; font-size: 0.9rem;">
                            <input type="checkbox" name="index_static" value="1" style="width: 18px; height: 18px;">
                            <span>Trang chủ, Trang Danh mục Sản phẩm & Bài viết</span>
                        </label>
                        
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; font-size: 0.9rem;">
                            <input type="checkbox" name="index_products" value="1" style="width: 18px; height: 18px;">
                            <span>Tất cả các link <strong>Sản phẩm</strong> (Products) hiện có</span>
                        </label>
                        
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; font-size: 0.9rem;">
                            <input type="checkbox" name="index_posts" value="1" style="width: 18px; height: 18px;">
                            <span>Tất cả các link <strong>Bài viết Blog</strong> (Posts) hiện có</span>
                        </label>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; margin-bottom: 1rem;">
                        <h3 style="font-size: 0.95rem; font-weight: 700; color:var(--text-main); margin:0;">2. Thêm link thủ công (Custom URLs)</h3>
                        <button type="button" id="add-url-btn" style="background: rgba(2, 132, 199, 0.1); color: var(--primary); border:none; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 700; font-size: 0.8rem; cursor: pointer;">
                            <i class="fa-solid fa-plus"></i> Thêm link
                        </button>
                    </div>
                    
                    <div id="manual-urls-container" style="display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 2.5rem;">
                        <!-- First input row -->
                        <div class="url-input-row" style="display: flex; gap: 0.5rem;">
                            <input type="url" name="manual_urls[]" placeholder="https://aicuatoi.com/link-can-index" style="flex: 1; padding: 0.75rem 1rem; border: 1px solid var(--border-color); border-radius: var(--radius-md); font-family: 'Inter', sans-serif; font-size: 0.9rem; outline: none;">
                        </div>
                    </div>

                    <div style="text-align: right;">
                        <button type="submit" class="btn-action" style="padding: 0.75rem 2rem; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 8px; box-shadow: 0 4px 10px rgba(2, 132, 199, 0.3);">
                            <i class="fa-solid fa-paper-plane"></i> Gửi Yêu Cầu Index Ngay
                        </button>
                    </div>
                </form>
            </div>

            <script>
                document.getElementById('add-url-btn').addEventListener('click', function() {
                    const container = document.getElementById('manual-urls-container');
                    
                    const row = document.createElement('div');
                    row.className = 'url-input-row';
                    row.style.display = 'flex';
                    row.style.gap = '0.5rem';
                    row.style.alignItems = 'center';
                    
                    const input = document.createElement('input');
                    input.type = 'url';
                    input.name = 'manual_urls[]';
                    input.placeholder = 'https://aicuatoi.com/link-can-index';
                    input.style.flex = '1';
                    input.style.padding = '0.75rem 1rem';
                    input.style.border = '1px solid var(--border-color)';
                    input.style.borderRadius = '10px';
                    input.style.fontFamily = "'Inter', sans-serif";
                    input.style.fontSize = '0.9rem';
                    input.style.outline = 'none';
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';
                    removeBtn.style.background = '#fef2f2';
                    removeBtn.style.color = '#ef4444';
                    removeBtn.style.border = 'none';
                    removeBtn.style.padding = '0.75rem';
                    removeBtn.style.borderRadius = '8px';
                    removeBtn.style.cursor = 'pointer';
                    removeBtn.style.display = 'flex';
                    removeBtn.style.alignItems = 'center';
                    removeBtn.style.justifyContent = 'center';
                    
                    removeBtn.onclick = function() {
                        row.remove();
                    };
                    
                    row.appendChild(input);
                    row.appendChild(removeBtn);
                    
                    container.appendChild(row);
                });
            </script>
        </main>
    </div>

</body>
</html>
