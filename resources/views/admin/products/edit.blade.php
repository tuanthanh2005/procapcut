<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Chỉnh Sửa Sản Phẩm | AI CỦA TÔI Admin</title>
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

        .content-container {
            padding: 2.5rem;
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
        }

        /* Alert error */
        .alert {
            padding: 0.85rem 1.25rem;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #ef4444;
        }

        /* Form layout */
        .form-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .form-card h2 {
            font-size: 1.15rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--bg-body);
            padding-bottom: 0.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 0.88rem;
            color: var(--text-main);
            background: #f8fafc;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-submit:hover {
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.15);
        }

        .btn-cancel {
            background: #f1f5f9;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.88rem;
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

        .ck-editor__editable_inline {
            min-height: 250px;
            background: #f8fafc !important;
            color: var(--text-main) !important;
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
            <h1 class="page-title">Chỉnh Sửa Sản Phẩm</h1>
            <div class="user-info-bar">
                <div class="admin-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="admin-name">{{ auth()->user()->name }}</div>
                    <span class="admin-badge" style="background:#fef2f2; color:#ef4444; border:1px solid #fee2e2; font-size:0.68rem; font-weight:700; padding:0.15rem 0.4rem; border-radius:4px;">Admin</span>
                </div>
            </div>
        </header>

        <main class="content-container">
            @if($errors->any())
                <div class="alert">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="form-card" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <h2>Thông tin sản phẩm chung</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="name">Tên sản phẩm</label>
                        <input type="text" name="name" id="name" class="form-input" placeholder="Ví dụ: Tài Khoản Claude Pro" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="slug">Đường dẫn Slug (unique)</label>
                        <input type="text" name="slug" id="slug" class="form-input" placeholder="Ví dụ: claude-pro" value="{{ old('slug', $product->slug) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="category">Danh mục sản phẩm</label>
                        <select name="category" id="category" class="form-input" required onchange="updateCategoryLabel(this.value)">
                            <option value="" disabled>-- Chọn danh mục --</option>
                            <option value="capcut" {{ old('category', $product->category) === 'capcut' ? 'selected' : '' }}>Video Editor (CapCut)</option>
                            <option value="gpt" {{ old('category', $product->category) === 'gpt' ? 'selected' : '' }}>AI Chatbot (ChatGPT)</option>
                            <option value="gemini" {{ old('category', $product->category) === 'gemini' ? 'selected' : '' }}>Google AI Suite (Gemini)</option>
                            <option value="canva" {{ old('category', $product->category) === 'canva' ? 'selected' : '' }}>Graphic Design (Canva)</option>
                            <option value="other" {{ old('category', $product->category) === 'other' ? 'selected' : '' }}>Sản phẩm khác (Claude, Office...)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="category_label">Nhãn hiển thị danh mục</label>
                        <input type="text" name="category_label" id="category_label" class="form-input" placeholder="Nhãn tự động cập nhật..." value="{{ old('category_label', $product->category_label) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="width: 100%;">
                        <label class="form-label" for="image_path">Hình ảnh sản phẩm (File upload)</label>
                        <input type="file" name="image_path" id="image_path" class="form-input" accept="image/*">
                        <span style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem; display: block;">
                            <i class="fa-solid fa-circle-info"></i> Kích thước khuyên dùng: Hình vuông (500x500 px hoặc tỉ lệ 1:1), định dạng JPG, PNG, WEBP, tối đa 2MB.
                        </span>
                        @if($product->image_path)
                            <div style="margin-top: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                <span style="font-size: 0.75rem; color: var(--text-muted);">Ảnh hiện tại:</span>
                                <img src="{{ asset($product->image_path) }}" alt="Product Image" style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                            </div>
                        @endif
                        <input type="hidden" name="icon" value="{{ $product->icon ?? 'fa-cube' }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="default_price">Giá bán mặc định (VNĐ)</label>
                        <input type="number" name="default_price" id="default_price" class="form-input" placeholder="Ví dụ: 250000" value="{{ old('default_price', $product->default_price) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default_slashed">Giá gốc gạch ngang (VNĐ)</label>
                        <input type="number" name="default_slashed" id="default_slashed" class="form-input" placeholder="Ví dụ: 600000" value="{{ old('default_slashed', $product->default_slashed) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="rating">Sao đánh giá</label>
                        <input type="number" name="rating" id="rating" class="form-input" step="0.1" min="1" max="5" placeholder="4.9" value="{{ old('rating', $product->rating) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="review_count">Số lượt đánh giá</label>
                        <input type="number" name="review_count" id="review_count" class="form-input" placeholder="120" value="{{ old('review_count', $product->review_count) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="sold">Số lượng đã bán hiển thị</label>
                    <input type="text" name="sold" id="sold" class="form-input" placeholder="Ví dụ: 1.5k" value="{{ old('sold', $product->sold) }}" required>
                </div>

                <h2>Mô tả chi tiết sản phẩm (Hỗ trợ HTML viết tay/rich text)</h2>
                <div class="form-group">
                    <textarea name="description" id="description" class="form-input" rows="8" style="resize: vertical; font-family: inherit;" placeholder="Ví dụ: <p><strong>CapCut Pro chính chủ</strong>...</p>">{{ old('description', $product->description) }}</textarea>
                </div>

                <h2>Các tính năng nổi bật (Mỗi dòng là một tính năng)</h2>
                <div class="form-group">
                    <textarea name="features" id="features" class="form-input" rows="4" style="resize: vertical; font-family: inherit;" placeholder="Mở khóa toàn bộ hiệu ứng VIP&#10;Nâng cấp trực tiếp chính chủ email&#10;Xuất video chất lượng cao 4K">{{ old('features', $featuresStr) }}</textarea>
                </div>

                <h2>Cấu hình gói bản quyền (Options)</h2>
                <div id="options-builder-container" style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.5rem;">
                    <!-- Option items will be appended here dynamically -->
                </div>
                <button type="button" class="btn-cancel" id="btn-add-option" style="background: #e0f2fe; color: #0369a1; border-color: #bae6fd; font-size: 0.82rem; padding: 0.5rem 1.5rem; margin-bottom: 1.5rem; display: inline-flex; align-items: center; gap: 0.35rem;">
                    <i class="fa-solid fa-plus"></i> Thêm Gói Bản Quyền Mới
                </button>
                <input type="hidden" name="options" id="options-hidden-input">

                <h2>Thông tin SEO (Tốt cho công cụ tìm kiếm)</h2>
                <div class="form-group">
                    <label class="form-label" for="seo_title">SEO Title (Tiêu đề trang chi tiết)</label>
                    <input type="text" name="seo_title" id="seo_title" class="form-input" placeholder="Ví dụ: Mua tài khoản Claude Pro chính chủ giá rẻ nhất" value="{{ old('seo_title', $product->seo_title) }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="seo_desc">SEO Meta Description (Mô tả tìm kiếm)</label>
                    <textarea name="seo_desc" id="seo_desc" class="form-input" rows="3" style="resize: vertical; font-family: inherit;" placeholder="Nhập mô tả tìm kiếm hấp dẫn giúp tăng lượng click từ Google.">{{ old('seo_desc', $product->seo_desc) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="seo_keywords">SEO Keywords (Ngăn cách bởi dấu phẩy)</label>
                    <input type="text" name="seo_keywords" id="seo_keywords" class="form-input" placeholder="Ví dụ: mua tài khoản claude pro, claude pro giá rẻ" value="{{ old('seo_keywords', $product->seo_keywords) }}">
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-submit">Cập Nhật Sản Phẩm <i class="fa-solid fa-save"></i></button>
                    <a href="{{ route('admin.products.index') }}" class="btn-cancel">Hủy bỏ</a>
                </div>
            </form>
        </main>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo' ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        const container = document.getElementById('options-builder-container');
        const addBtn = document.getElementById('btn-add-option');
        const hiddenInput = document.getElementById('options-hidden-input');

        // Function to create an option row element
        function createOptionRow(data = {}) {
            const row = document.createElement('div');
            row.className = 'option-item-row';
            row.style.background = '#f8fafc';
            row.style.border = '1px solid #e2e8f0';
            row.style.padding = '1.25rem';
            row.style.borderRadius = 'var(--radius-md)';
            row.style.display = 'grid';
            row.style.gridTemplateColumns = '1fr auto';
            row.style.gap = '1.5rem';
            row.style.alignItems = 'center';

            const fieldsGrid = document.createElement('div');
            fieldsGrid.style.display = 'grid';
            fieldsGrid.style.gridTemplateColumns = '1fr 1fr';
            fieldsGrid.style.gap = '1rem';

            const idGroup = createFormGroup('Mã gói (ID duy nhất, ví dụ: capcut-1m)', 'opt-id', 'text', data.id || '', true);
            const nameGroup = createFormGroup('Tên hiển thị gói (ví dụ: Gói 1 Tháng)', 'opt-name', 'text', data.name || '', true);
            const priceGroup = createFormGroup('Giá bán (VNĐ)', 'opt-price', 'number', data.price !== undefined ? data.price : '', true);
            const slashedGroup = createFormGroup('Giá gốc gạch ngang (VNĐ)', 'opt-slashed', 'number', data.slashed !== undefined ? data.slashed : '', true);
            const descGroup = createFormGroup('Mô tả ngắn của gói', 'opt-desc', 'text', data.description || '', true);
            descGroup.style.gridColumn = 'span 2';

            fieldsGrid.appendChild(idGroup);
            fieldsGrid.appendChild(nameGroup);
            fieldsGrid.appendChild(priceGroup);
            fieldsGrid.appendChild(slashedGroup);
            fieldsGrid.appendChild(descGroup);

            const actionCol = document.createElement('div');
            actionCol.style.display = 'flex';
            actionCol.style.flexDirection = 'column';
            actionCol.style.gap = '0.75rem';
            actionCol.style.alignItems = 'flex-end';

            const inStock = data.in_stock !== false; // Default is true if undefined

            const label = document.createElement('label');
            label.style.display = 'flex';
            label.style.alignItems = 'center';
            label.style.gap = '0.35rem';
            label.style.fontSize = '0.8rem';
            label.style.fontWeight = '700';
            label.style.cursor = 'pointer';
            label.style.userSelect = 'none';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.className = 'opt-instock';
            checkbox.checked = inStock;
            checkbox.style.width = '1.15rem';
            checkbox.style.height = '1.15rem';
            checkbox.style.accentColor = 'var(--primary)';

            label.appendChild(checkbox);
            label.appendChild(document.createTextNode(' Còn hàng'));

            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.className = 'btn-cancel';
            deleteBtn.style.color = '#ef4444';
            deleteBtn.style.borderColor = '#fca5a5';
            deleteBtn.style.background = '#fef2f2';
            deleteBtn.style.padding = '0.4rem 0.75rem';
            deleteBtn.style.fontSize = '0.78rem';
            deleteBtn.innerHTML = '<i class="fa-solid fa-trash-can"></i> Xóa';
            deleteBtn.onclick = () => {
                row.remove();
                updateHiddenInput();
            };

            actionCol.appendChild(label);
            actionCol.appendChild(deleteBtn);

            row.appendChild(fieldsGrid);
            row.appendChild(actionCol);

            // Listen to inputs change to update hidden value
            row.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', updateHiddenInput);
                input.addEventListener('change', updateHiddenInput);
            });

            return row;
        }

        function createFormGroup(labelText, className, type, value, required = false) {
            const group = document.createElement('div');
            group.style.display = 'flex';
            group.style.flexDirection = 'column';
            group.style.gap = '0.35rem';

            const label = document.createElement('label');
            label.style.fontSize = '0.75rem';
            label.style.fontWeight = '700';
            label.style.color = 'var(--text-muted)';
            label.innerText = labelText;

            const input = document.createElement('input');
            input.type = type;
            input.className = 'form-input ' + className;
            input.value = value;
            input.required = required;
            input.style.padding = '0.6rem 0.85rem';
            input.style.fontSize = '0.82rem';

            group.appendChild(label);
            group.appendChild(input);
            return group;
        }

        // Collect elements and serialize as JSON
        function updateHiddenInput() {
            const rows = container.querySelectorAll('.option-item-row');
            const options = [];
            rows.forEach(row => {
                const id = row.querySelector('.opt-id').value.trim();
                const name = row.querySelector('.opt-name').value.trim();
                const price = parseFloat(row.querySelector('.opt-price').value) || 0;
                const slashed = parseFloat(row.querySelector('.opt-slashed').value) || 0;
                const description = row.querySelector('.opt-desc').value.trim();
                const in_stock = row.querySelector('.opt-instock').checked;

                if (id) {
                    options.push({ id, name, price, slashed, description, in_stock });
                }
            });
            hiddenInput.value = JSON.stringify(options);
        }

        // Initialize with default or old input
        const initialOptions = {!! old('options', $optionsJson) !!};
        initialOptions.forEach(opt => {
            container.appendChild(createOptionRow(opt));
        });
        updateHiddenInput();

        addBtn.addEventListener('click', () => {
            const newRow = createOptionRow();
            container.appendChild(newRow);
            newRow.querySelector('.opt-id').focus();
            updateHiddenInput();
        });

        // Submit listener to sync before POST
        document.querySelector('form').addEventListener('submit', (e) => {
            updateHiddenInput();
        });

        function updateCategoryLabel(category) {
            const labels = {
                'capcut': 'Video Editor',
                'gpt': 'AI Chatbot',
                'gemini': 'Google AI Suite',
                'canva': 'Graphic Design',
                'other': 'Sản phẩm khác'
            };
            document.getElementById('category_label').value = labels[category] || '';
        }
    </script>
</body>
</html>
