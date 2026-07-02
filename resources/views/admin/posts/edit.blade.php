<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Chỉnh Sửa Bài Viết | AI CỦA TÔI Admin</title>
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
            --text-dark: #64748b;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.05);
            --transition: all 0.25s ease;
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
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
            padding: 1rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .form-card h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.25rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.5rem;
        }

        .form-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-label {
            font-size: 0.825rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .form-input {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            color: var(--text-main);
            background: #ffffff;
            transition: var(--transition);
            outline: none;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        textarea.form-input {
            resize: vertical;
            min-height: 80px;
        }

        .form-help {
            font-size: 0.725rem;
            color: var(--text-dark);
            margin-top: 0.15rem;
        }

        .preview-img-wrapper {
            margin-top: 0.5rem;
            width: 120px;
            height: 80px;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .preview-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            border-top: 1px solid var(--border-color);
            padding-top: 1.5rem;
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 2px 4px var(--primary-glow);
        }

        .btn-submit:hover {
            background: #4338ca;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            padding: 0.7rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-wrapper {
                margin-left: 0;
            }
            .form-row {
                flex-direction: column;
                gap: 1.25rem;
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
            <h1 class="page-title">Chỉnh Sửa Bài Viết</h1>
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
            @if($errors->any())
                <div class="alert">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" class="form-card" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <h2>Nội dung bài viết</h2>
                
                <div class="form-row">
                    <div class="form-group" style="flex: 2;">
                        <label class="form-label" for="title">Tiêu đề bài viết</label>
                        <input type="text" name="title" id="title" class="form-input" placeholder="Nhập tiêu đề bài viết..." value="{{ old('title', $post->title) }}" required onkeyup="generateSlug(this.value)">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label" for="slug">Đường dẫn Slug (unique)</label>
                        <input type="text" name="slug" id="slug" class="form-input" placeholder="duong-dan-bai-viet" value="{{ old('slug', $post->slug) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="summary">Tóm tắt ngắn (Summary / Excerpt)</label>
                        <textarea name="summary" id="summary" class="form-input" placeholder="Mô tả ngắn gọn nội dung bài viết hiển thị trên danh sách..." style="height: 100px;">{{ old('summary', $post->summary) }}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="content">Nội dung chi tiết (Hỗ trợ HTML)</label>
                        <textarea name="content" id="content" class="form-input" placeholder="Nội dung bài viết..." style="height: 250px; font-family: monospace;">{{ old('content', $post->content) }}</textarea>
                        <div class="form-help">Hỗ trợ viết mã HTML thô. Bạn có thể sử dụng các thẻ như &lt;h2&gt;, &lt;p&gt;, &lt;strong&gt;, &lt;img&gt; để trình bày bài viết đẹp mắt hơn.</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="image_path">Ảnh đại diện (Thumbnail)</label>
                        <input type="file" name="image_path" id="image_path" class="form-input" accept="image/*">
                        @if($post->image_path)
                            <div class="preview-img-wrapper">
                                <img src="{{ asset($post->image_path) }}" alt="Current thumbnail">
                            </div>
                        @endif
                        <div class="form-help">Chấp nhận file định dạng JPG, PNG, WEBP, GIF dung lượng tối đa 2MB. Bỏ trống nếu muốn giữ nguyên ảnh hiện tại.</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="is_published">Trạng thái bài viết</label>
                        <select name="is_published" id="is_published" class="form-input">
                            <option value="1" {{ old('is_published', $post->is_published ? '1' : '0') === '1' ? 'selected' : '' }}>Xuất bản</option>
                            <option value="0" {{ old('is_published', $post->is_published ? '1' : '0') === '0' ? 'selected' : '' }}>Nháp</option>
                        </select>
                    </div>
                </div>

                <h2>Tối ưu SEO (Meta Tags)</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="meta_title">SEO Title (Tiêu đề SEO)</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-input" placeholder="Tiêu đề hiển thị trên Google..." value="{{ old('meta_title', $post->meta_title) }}">
                        <div class="form-help">Bỏ trống để tự động lấy Tiêu đề bài viết. Khuyên dùng dưới 60 ký tự.</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="meta_desc">SEO Description (Mô tả SEO)</label>
                        <textarea name="meta_desc" id="meta_desc" class="form-input" placeholder="Mô tả tóm tắt hiển thị trên kết quả tìm kiếm..." style="height: 80px;">{{ old('meta_desc', $post->meta_desc) }}</textarea>
                        <div class="form-help">Bỏ trống để tự động lấy Tóm tắt ngắn. Khuyên dùng dưới 160 ký tự.</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="meta_keywords">SEO Keywords (Từ khóa SEO)</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-input" placeholder="Ví dụ: huong dan capcut, capcut pro gia re..." value="{{ old('meta_keywords', $post->meta_keywords) }}">
                        <div class="form-help">Các từ khóa cách nhau bởi dấu phẩy.</div>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-submit">Lưu Thay Đổi <i class="fa-solid fa-save"></i></button>
                    <a href="{{ route('admin.posts.index') }}" class="btn-cancel">Hủy Bỏ</a>
                </div>
            </form>
        </main>
    </div>

    <script>
        function generateSlug(text) {
            let slug = text.toLowerCase();
            slug = slug.replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a');
            slug = slug.replace(/[éèẻẽẹêếềểễệ]/g, 'e');
            slug = slug.replace(/[íìỉĩị]/g, 'i');
            slug = slug.replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o');
            slug = slug.replace(/[úùủũụưứừửữự]/g, 'u');
            slug = slug.replace(/[ýỳỷỹỵ]/g, 'y');
            slug = slug.replace(/đ/g, 'd');
            slug = slug.replace(/[^a-z0-9 -]/g, '');
            slug = slug.replace(/\s+/g, '-');
            slug = slug.replace(/-+/g, '-');
            slug = slug.replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
        }
    </script>
</body>
</html>
