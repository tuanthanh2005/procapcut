<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm | AI CỦA TÔI Admin</title>
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
        }

        .section-header h2 {
            font-size: 1.05rem;
            font-weight: 800;
        }

        .btn-add {
            padding: 0.6rem 1.1rem;
            font-size: 0.85rem;
            font-weight: 700;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: var(--transition);
        }

        .btn-add:hover {
            background: var(--primary-hover);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.88rem;
        }

        th {
            padding: 0.85rem 1rem;
            background: #f8fafc;
            color: var(--text-muted);
            font-weight: 700;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 1.1rem 1rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .product-icon-cell {
            font-size: 1.25rem;
            color: var(--primary);
            width: 40px;
        }

        .p-name {
            font-weight: 700;
            color: var(--text-main);
            text-decoration: none;
        }

        .p-name:hover {
            color: var(--primary);
        }

        .p-slug {
            display: block;
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 0.15rem;
        }

        .cat-badge {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            font-size: 0.72rem;
            font-weight: 700;
            border-radius: 4px;
            background: #f1f5f9;
            color: #475569;
        }

        .actions-cell {
            display: flex;
            gap: 0.5rem;
        }

        .btn-tbl-action {
            width: 2rem;
            height: 2rem;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            background: #ffffff;
            color: var(--text-dark);
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-tbl-action:hover {
            background: var(--bg-body);
            color: var(--primary);
        }

        .btn-tbl-delete:hover {
            background: #fef2f2;
            color: #ef4444;
            border-color: #fca5a5;
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
            <li class="menu-item active">
                <a href="/admin/products"><i class="fa-solid fa-cubes"></i> Quản lý sản phẩm</a>
            </li>
            <li class="menu-item">
                <a href="/admin/orders"><i class="fa-solid fa-shopping-cart"></i> Đơn hàng</a>
            </li>
            <li class="menu-item">
                <a href="/profile"><i class="fa-solid fa-users"></i> Khách hàng</a>
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
            <h1 class="page-title">Quản Lý Sản Phẩm</h1>
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
            @if(session('success_message'))
                <div class="alert">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success_message') }}
                </div>
            @endif

            <!-- Table of Products -->
            <section class="data-section">
                <div class="section-header">
                    <h2>Danh sách sản phẩm dịch vụ</h2>
                    <a href="{{ route('admin.products.create') }}" class="btn-add">
                        <i class="fa-solid fa-plus"></i> Thêm Sản Phẩm Mới
                    </a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá bán</th>
                            <th>Giá gốc</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $prod)
                            <tr>
                                <td>
                                    <div class="product-icon-cell">
                                        <i class="fa-solid {{ strtok($prod->icon, ' ') }}"></i>
                                    </div>
                                </td>
                                <td>
                                    <a href="/product/{{ $prod->slug }}" target="_blank" class="p-name">{{ $prod->name }}</a>
                                    <span class="p-slug">Slug: /product/{{ $prod->slug }}</span>
                                </td>
                                <td>
                                    <span class="cat-badge">{{ $prod->category_label }}</span>
                                </td>
                                <td><strong>{{ number_format($prod->default_price, 0, ',', '.') }}₫</strong></td>
                                <td><span style="text-decoration: line-through; color: var(--text-muted);">{{ number_format($prod->default_slashed, 0, ',', '.') }}₫</span></td>
                                <td>
                                    <div class="actions-cell">
                                        <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn-tbl-action" title="Sửa sản phẩm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không? Hành động này không thể hoàn tác!')" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-tbl-action btn-tbl-delete" title="Xóa sản phẩm">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </main>
    </div>

</body>
</html>
