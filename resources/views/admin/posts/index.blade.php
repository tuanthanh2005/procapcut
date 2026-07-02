<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Quản Lý Bài Viết | AI CỦA TÔI Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-glow: rgba(79, 70, 229, 0.15);
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #475569;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Left */
        .sidebar {
            width: 260px;
            background: #0f172a;
            color: #94a3b8;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #ffffff;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .logo-area i {
            color: var(--primary-light);
            font-size: 1.5rem;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            flex-grow: 1;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #94a3b8;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .menu-item a:hover, .menu-item.active a {
            background: #1e293b;
            color: #ffffff;
        }

        .menu-item.active a i {
            color: var(--primary-light);
        }

        /* Main Wrapper Right */
        .main-wrapper {
            margin-left: 260px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .top-navbar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .user-info-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-avatar {
            width: 2.25rem;
            height: 2.25rem;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .admin-name {
            font-size: 0.875rem;
            font-weight: 600;
        }

        .admin-badge {
            font-size: 0.7rem;
            background: #fef2f2;
            color: #ef4444;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
        }

        /* Content Container */
        .content-container {
            padding: 2rem;
            flex-grow: 1;
        }

        .alert {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 1rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .alert i {
            font-size: 1.1rem;
        }

        .data-section {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .section-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .section-header h2 {
            font-size: 1rem;
            font-weight: 700;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px var(--primary-glow);
        }

        .btn-add:hover {
            background: #4338ca;
            transform: translateY(-1px);
        }

        /* Data Table */
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.875rem;
        }

        th {
            background: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        tr:hover td {
            background: #f8fafc;
        }

        .post-img-cell {
            width: 60px;
            height: 40px;
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            background: #cbd5e1;
        }

        .post-img-cell img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .p-title {
            color: var(--text-main);
            font-weight: 700;
            text-decoration: none;
            display: block;
            margin-bottom: 4px;
        }

        .p-title:hover {
            color: var(--primary);
        }

        .p-slug {
            font-size: 0.75rem;
            color: var(--text-muted);
            display: block;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 600;
            display: inline-block;
        }

        .status-badge.published {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.draft {
            background: #f3f4f6;
            color: #374151;
        }

        .actions-cell {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-tbl-action {
            width: 2rem;
            height: 2rem;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            background: #ffffff;
        }

        .btn-tbl-action:hover {
            background: #f1f5f9;
            color: var(--text-main);
            border-color: #cbd5e1;
        }

        .btn-tbl-delete:hover {
            background: #fef2f2;
            color: #ef4444;
            border-color: #fca5a5;
        }

        .empty-row-msg {
            text-align: center;
            color: var(--text-muted);
            padding: 3rem 0;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-wrapper {
                margin-left: 0;
            }
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
            <li class="menu-item active">
                <a href="/admin/posts"><i class="fa-solid fa-newspaper"></i> Quản lý bài viết</a>
            </li>
            <li class="menu-item">
                <a href="/admin/orders"><i class="fa-solid fa-shopping-cart"></i> Đơn hàng</a>
            </li>
            <li class="menu-item">
                <a href="/admin/chat"><i class="fa-solid fa-comments"></i> Hỗ trợ Chat</a>
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
            <h1 class="page-title">Quản Lý Bài Viết SEO</h1>
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

            <!-- Table of Posts -->
            <section class="data-section">
                <div class="section-header">
                    <h2>Danh sách các bài viết trên hệ thống</h2>
                    <a href="{{ route('admin.posts.create') }}" class="btn-add">
                        <i class="fa-solid fa-plus"></i> Thêm Bài Viết Mới
                    </a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề bài viết</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($posts->isEmpty())
                            <tr>
                                <td colspan="5" class="empty-row-msg">Không có bài viết nào được tìm thấy.</td>
                            </tr>
                        @else
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <div class="post-img-cell">
                                            @if($post->image_path)
                                                <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}">
                                            @else
                                                <img src="https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?q=80&w=150&auto=format&fit=crop" alt="Placeholder">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="p-title">{{ $post->title }}</a>
                                        <span class="p-slug">Slug: /post/{{ $post->slug }}</span>
                                    </td>
                                    <td>
                                        @if($post->is_published)
                                            <span class="status-badge published">Đã xuất bản</span>
                                        @else
                                            <span class="status-badge draft">Nháp</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="actions-cell">
                                            <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="btn-tbl-action" title="Xem bài viết trên trang chủ">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn-tbl-action" title="Chỉnh sửa bài viết">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không? Hành động này không thể hoàn tác!')" style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-tbl-action btn-tbl-delete" title="Xóa bài viết">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </section>
        </main>
    </div>

</body>
</html>
