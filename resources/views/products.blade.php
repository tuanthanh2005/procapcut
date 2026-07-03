<?php
$category = request()->query('category', 'all');
$search = request()->query('search', '');

$seoConfig = [
    'all' => [
        'title' => 'Mua Bản Quyền Tài Khoản AI & Premium Tools Giá Rẻ | AI CỦA TÔI',
        'desc' => 'Chuyên nâng cấp tài khoản CapCut Pro chính chủ, ChatGPT Plus, Canva Pro giá rẻ. Kích hoạt tự động sau 30 giây, bảo hành uy tín trọn vòng đời sử dụng.',
        'h1' => 'Khám Phá Cửa Hàng Số',
        'keywords' => 'mua tài khoản capcut pro, mua tài khoản chatgpt plus, nâng cấp canva pro, google gemini advanced, claude pro, office 365 copilot giá rẻ, microsoft 365 copilot',
    ],
    'gpt' => [
        'title' => 'Mua Tài Khoản ChatGPT Plus (GPT-5) Giá Rẻ Chính Chủ | AI CỦA TÔI',
        'desc' => 'Dịch vụ nâng cấp tài khoản ChatGPT Plus chính chủ giá rẻ nhất. Trải nghiệm GPT-5, DALL-E 3 mượt mà ổn định, bảo hành lỗi 1 đổi 1 trong 30 ngày.',
        'h1' => 'Tài Khoản ChatGPT Plus Premium',
        'keywords' => 'mua tài khoản chatgpt plus, tài khoản chatgpt plus giá rẻ, nâng cấp gpt 5, mua chatgpt plus uy tín',
    ],
    'gemini' => [
        'title' => 'Nâng Cấp Google Gemini Advanced + 5TB Google One Giá Rẻ | AI CỦA TÔI',
        'desc' => 'Dịch vụ nâng cấp Google Gemini Advanced chính chủ trên Gmail. Tặng kèm dung lượng lưu trữ khổng lồ 5TB Google One siêu tiết kiệm, kích hoạt tự động 30s.',
        'h1' => 'Google Gemini Advanced + 5TB Google One',
        'keywords' => 'nâng cấp gemini advanced, mua google gemini advanced, gemini advanced 5tb google one',
    ],
    'capcut' => [
        'title' => 'Mua Tài Khoản CapCut Pro Giá Rẻ 1 Năm Chính Chủ | AI CỦA TÔI',
        'desc' => 'Dịch vụ nâng cấp tài khoản CapCut Pro 1 năm chính chủ giá rẻ nhất. Kích hoạt trực tiếp trên Email của bạn, sử dụng song song trên máy tính và điện thoại.',
        'h1' => 'Tài Khoản CapCut Pro Chính Chủ',
        'keywords' => 'mua tài khoản capcut pro, nâng cấp capcut pro chính chủ, tài khoản capcut pro giá rẻ, bản quyền capcut pro',
    ],
    'canva' => [
        'title' => 'Nâng Cấp Canva Pro Email Chính Chủ Giá Rẻ Nhất | AI CỦA TÔI',
        'desc' => 'Nâng cấp Canva Pro chính chủ trên chính Email của bạn. Mở khóa toàn bộ tính năng Canva VIP, thiết kế không giới hạn, Magic Studio AI, bảo hành dài hạn.',
        'h1' => 'Nâng Cấp Canva Pro Chính Chủ',
        'keywords' => 'nâng cấp canva pro chính chủ, mua tài khoản canva pro giá rẻ, canva pro email chính chủ',
    ],
    'other' => [
        'title' => 'Mua Tài Khoản Claude Pro & Premium Tools Giá Rẻ | AI CỦA TÔI',
        'desc' => 'Nâng cấp tài khoản Claude Pro (Sonnet 4.8), Microsoft 365 Copilot chính hãng kèm 1TB OneDrive giá rẻ. Hỗ trợ kích hoạt tự động 24/7.',
        'h1' => 'Premium Tools & Dịch Vụ AI Khác',
        'keywords' => 'mua tài khoản claude pro, tài khoản claude sonnet 4.8, mua claude pro uy tín, office 365 copilot, microsoft 365 copilot giá rẻ',
    ],
];

// Fallback if category doesn't exist
$currentSeo = $seoConfig[$category] ?? $seoConfig['all'];

if (!empty($search)) {
    $currentSeo['title'] = 'Kết quả tìm kiếm cho "' . htmlspecialchars($search) . '" | AI CỦA TÔI';
    $currentSeo['desc'] = 'Tìm kiếm tài khoản và dịch vụ số "' . htmlspecialchars($search) . '" tại AI CỦA TÔI. Đảm bảo chính chủ, giao hàng nhanh 30s.';
    $currentSeo['h1'] = 'Tìm kiếm: ' . htmlspecialchars($search);
}

// Generate JSON-LD Schema dynamically
$schema = [];
if ($category === 'all' && empty($search)) {
    // ItemList Schema
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'Danh sách sản phẩm Premium - AI CỦA TÔI',
        'description' => 'Các sản phẩm tài khoản AI, Video Editor, Thiết kế đồ họa và Công cụ văn phòng tại AI CỦA TÔI.',
        'url' => request()->url(),
        'numberOfItems' => 6,
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'url' => request()->url() . '?category=capcut',
                'name' => 'CapCut Pro 1 Năm Chính Chủ',
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'url' => request()->url() . '?category=gpt',
                'name' => 'Tài Khoản ChatGPT Plus 1 Tháng',
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'url' => request()->url() . '?category=gemini',
                'name' => 'Google Gemini Advanced + 5TB Google One',
            ],
            [
                '@type' => 'ListItem',
                'position' => 4,
                'url' => request()->url() . '?category=canva',
                'name' => 'Canva Pro Nâng Cấp Email Chính Chủ',
            ],
            [
                '@type' => 'ListItem',
                'position' => 5,
                'url' => request()->url() . '?category=other',
                'name' => 'Tài Khoản Claude Pro 1 Tháng',
            ],
            [
                '@type' => 'ListItem',
                'position' => 6,
                'url' => request()->url() . '?category=other',
                'name' => 'Tài Khoản Office 365 + 1TB OneDrive + Copilot',
            ],
        ]
    ];
} else {
    // Single Product Category Schema
    $productData = [
        'capcut' => [
            'name' => 'CapCut Pro (Gói 1 Năm - Chính Chủ)',
            'description' => 'Mở khóa toàn bộ tính năng VIP trên CapCut. Nâng cấp trên Email chính chủ, sử dụng đồng thời trên PC & Mobile.',
            'price' => '250000',
            'sku' => 'CC-PRO-1Y',
            'rating' => '4.9',
            'reviewCount' => '142',
        ],
        'gpt' => [
            'name' => 'Tài Khoản ChatGPT Plus (GPT-5) 1 Tháng',
            'description' => 'Truy cập GPT-5 & DALL-E 3 mượt mà. Hỗ trợ tạo Custom GPTs riêng. Tài khoản dùng ổn định, bảo hành 1 đổi 1.',
            'price' => '299000',
            'sku' => 'GPT-PLUS-1M',
            'rating' => '4.8',
            'reviewCount' => '98',
        ],
        'gemini' => [
            'name' => 'Google Gemini Advanced + 5TB Google One',
            'description' => 'AI tích hợp sâu vào bộ công cụ Google Workspace. Tặng kèm dung lượng lưu trữ 5TB Google One. Nâng cấp trực tiếp trên Gmail chính chủ.',
            'price' => '199000',
            'sku' => 'GEMINI-ADV-1M',
            'rating' => '4.7',
            'reviewCount' => '54',
        ],
        'canva' => [
            'name' => 'Canva Pro Nâng Cấp Chính Chủ Email',
            'description' => 'Không giới hạn kho ảnh, mẫu thiết kế VIP. Sử dụng tính năng Magic Studio AI cao cấp. Bảo hành dài hạn trọn gói sử dụng.',
            'price' => '99000',
            'sku' => 'CANVA-PRO-1M',
            'rating' => '4.9',
            'reviewCount' => '210',
        ],
        'other' => [
            'name' => 'Tài Khoản Claude Pro (Sonnet 4.8) 1 Tháng',
            'description' => 'Tốc độ phản hồi cực nhanh, không giới hạn. Đỉnh cao viết code & phân tích dữ liệu. Bảo hành lỗi đổi mới trong 30 ngày.',
            'price' => '349000',
            'sku' => 'CLAUDE-PRO-1M',
            'rating' => '4.8',
            'reviewCount' => '76',
        ],
    ];

    $prod = $productData[$category] ?? $productData['capcut'];
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $prod['name'],
        'image' => 'https://aicuatoi.com/images/logo.png', // Fallback domain logo
        'description' => $prod['description'],
        'sku' => $prod['sku'],
        'mpn' => $prod['sku'],
        'brand' => [
            '@type' => 'Brand',
            'name' => 'AI CỦA TÔI'
        ],
        'offers' => [
            '@type' => 'Offer',
            'url' => request()->fullUrl(),
            'priceCurrency' => 'VND',
            'price' => $prod['price'],
            'priceValidUntil' => date('Y-12-31'),
            'itemCondition' => 'https://schema.org/NewCondition',
            'availability' => 'https://schema.org/InStock',
            'seller' => [
                '@type' => 'Organization',
                'name' => 'AI CỦA TÔI'
            ]
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => $prod['rating'],
            'reviewCount' => $prod['reviewCount']
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>{{ $currentSeo['title'] }}</title>
    <meta name="description" content="{{ $currentSeo['desc'] }}">
    <meta name="keywords" content="{{ $currentSeo['keywords'] }}">
    <link rel="canonical" href="{{ request()->url() }}">
    
    <!-- JSON-LD Structure Data Schema for SEO -->
    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Balanced Elegant Light Gray & White Theme */
            --bg-body: #f1f5f9; /* Slate 100 - Stronger background contrast */
            --bg-nav: rgba(255, 255, 255, 0.9);
            --bg-card: #ffffff; /* Pure White Card */
            --bg-card-hover: #ffffff;
            --bg-glass: rgba(15, 23, 42, 0.04);
            --bg-glass-hover: rgba(15, 23, 42, 0.08);
            
            --primary: #0284c7; /* Elegant Deep Sky Blue */
            --primary-glow: rgba(2, 132, 199, 0.2);
            --secondary: #0ea5e9; /* Sky Blue */
            --secondary-glow: rgba(14, 165, 233, 0.2);
            --accent: #d97706; /* Elegant Amber */
            --success: #059669; /* Emerald Green */
            
            --text-main: #0f172a; /* Slate 900 */
            --text-muted: #334155; /* Slate 700 - Darker for readability */
            --text-dark: #64748b; /* Slate 500 */
            
            --border-color: #cbd5e1; /* Slate 300 - Highly defined card boundaries */
            --border-hover: #0284c7; /* Stronger highlight border */
            
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-full: 9999px;
            
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.05);
            --shadow-md: 0 10px 25px -5px rgba(15, 23, 42, 0.1), 0 8px 16px -6px rgba(15, 23, 42, 0.06);
            --shadow-lg: 0 20px 30px -10px rgba(15, 23, 42, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            line-height: 1.5;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(2, 132, 199, 0.06) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(14, 165, 233, 0.05) 0%, transparent 45%);
            background-attachment: fixed;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Top Sale Ticker */
        .top-ticker {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.5rem 0;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 101;
            overflow: hidden;
            display: flex;
            align-items: center;
            height: 38px;
        }

        .marquee-wrapper {
            display: flex;
            overflow: hidden;
            width: 100%;
            user-select: none;
        }

        .marquee-content {
            display: flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: space-around;
            min-width: 100%;
            gap: 3rem;
            animation: marquee 30s linear infinite;
            padding-right: 3rem;
        }

        .marquee-content span {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            color: white;
        }

        .marquee-content span strong {
            color: #ffe066; /* Bright yellow accent for coupon code */
        }

        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        .top-ticker i {
            animation: pulse-icon 1.5s infinite;
        }

        @keyframes pulse-icon {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Header Navigation */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--bg-nav);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-color);
            padding: 1.1rem 0;
            transition: var(--transition);
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .logo {
            font-size: 1.45rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #0f172a, #334155);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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

        /* Search Bar */
        .search-wrapper {
            flex: 0 1 240px;
            position: relative;
        }

        .search-input {
            width: 100%;
            height: 2.5rem;
            background: #ffffff;
            border: 1px solid var(--border-color);
            padding: 0 1rem;
            padding-right: 2.5rem;
            border-radius: var(--radius-full);
            color: var(--text-main);
            font-family: inherit;
            font-size: 0.85rem;
            transition: var(--transition);
            box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.02);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 12px rgba(2, 132, 199, 0.15);
        }

        .search-btn {
            position: absolute;
            right: 0.4rem;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--text-muted);
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .search-btn:hover {
            color: var(--primary);
            background: var(--bg-glass-hover);
        }

        /* Actions */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .action-icon-btn {
            position: relative;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--text-main);
            background: #ffffff;
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 2px 4px rgba(15, 23, 42, 0.02);
        }

        .action-icon-btn:hover {
            background: var(--bg-body);
            border-color: var(--border-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.1);
        }

        .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: linear-gradient(135deg, #ef4444, #f43f5e);
            color: white;
            font-size: 0.68rem;
            font-weight: 700;
            width: 17px;
            height: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid var(--bg-card);
        }

        /* Navigation Categories Strip */
        .cat-nav-bar {
            margin-top: 0;
            padding-top: 5px;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            overflow-x: auto;
            padding-bottom: 5px;
            scrollbar-width: none;
            flex: 1 1 auto;
            max-width: none;
        }

        .cat-nav-bar::-webkit-scrollbar {
            display: none;
        }

        .cat-pill {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-muted);
            white-space: nowrap;
            padding: 0.35rem 0.65rem;
            border-radius: var(--radius-full);
            background: #ffffff;
            border: 1px solid var(--border-color);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.35rem;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.02);
            cursor: pointer;
        }

        .cat-pill:hover, .cat-pill.active {
            color: var(--primary);
            border-color: var(--border-hover);
            transform: translateY(-1px);
        }

        .cat-pill.active {
            background: linear-gradient(135deg, rgba(2, 132, 199, 0.05), rgba(14, 165, 233, 0.05));
            border-color: var(--primary);
            color: var(--primary);
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(2, 132, 199, 0.08);
        }

        .cat-pill i {
            font-size: 0.8rem;
        }

        /* Main Section */
        main {
            padding-top: 2.5rem !important;
            padding-bottom: 4rem !important;
        }

        /* Split Catalog 2/7 Layout Styles */
        .catalog-container {
            display: grid;
            grid-template-columns: 2.2fr 7.8fr;
            gap: 2rem;
            margin-bottom: 4rem;
            align-items: start;
        }

        .filter-sidebar {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
        }

        .filter-group {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .filter-group:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .filter-title {
            font-size: 0.92rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-title i {
            color: var(--primary);
        }

        /* Sidebar Category List */
        .sidebar-cat-list {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .sidebar-cat-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 0.88rem;
            font-family: inherit;
            padding: 0.5rem 0.75rem;
            border-radius: var(--radius-sm);
            text-align: left;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            font-weight: 500;
        }

        .sidebar-cat-btn:hover, .sidebar-cat-btn.active {
            background: var(--bg-body);
            color: var(--primary);
            font-weight: 600;
        }

        .sidebar-cat-btn.active {
            background: linear-gradient(135deg, rgba(2, 132, 199, 0.05), rgba(14, 165, 233, 0.05));
            border-left: 3px solid var(--primary);
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }

        /* Sidebar Price Filter */
        .price-slider-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .price-range-slider {
            width: 100%;
            accent-color: var(--primary);
            height: 5px;
            background: #cbd5e1;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
        }

        .price-inputs {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .price-quick-btns {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: 0.35rem;
        }

        .price-quick-btn {
            background: var(--bg-body);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 0.75rem;
            font-family: inherit;
            padding: 0.3rem 0.6rem;
            border-radius: var(--radius-full);
            cursor: pointer;
            transition: var(--transition);
        }

        .price-quick-btn:hover, .price-quick-btn.active {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(2, 132, 199, 0.05);
            font-weight: 600;
        }

        .btn-reset-filters {
            width: 100%;
            background: var(--bg-body);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 0.65rem;
            border-radius: var(--radius-sm);
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
        }

        .btn-reset-filters:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);
        }

        /* Products list side header */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--text-main);
            position: relative;
            padding-bottom: 0.4rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 2.5rem;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 3px;
        }

        /* E-COMMERCE PRODUCTS GRID */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.25rem;
            margin-bottom: 0;
        }

        .product-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .product-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .product-card:hover .product-name {
            color: var(--primary);
        }

        .stretched-link::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            content: "";
        }

        .product-sale-tag {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            color: white;
            padding: 0.25rem 0.6rem;
            font-size: 0.7rem;
            font-weight: 800;
            border-radius: var(--radius-full);
            z-index: 10;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.2);
        }

        .product-media {
            height: 150px;
            background: radial-gradient(circle, rgba(15, 23, 42, 0.02), transparent);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .product-media i {
            font-size: 4rem;
            transition: var(--transition);
        }

        .product-card:hover .product-media i {
            transform: scale(1.1) rotate(2deg);
        }

        /* Brand Colors */
        .color-capcut { background: linear-gradient(135deg, #000000, #475569); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .color-gpt { background: linear-gradient(135deg, #10a37f, #059669); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .color-claude { background: linear-gradient(135deg, #d97757, #ea580c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .color-gemini { background: linear-gradient(135deg, #1a73e8, #ea4335, #fbbc05, #34a853); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .color-canva { background: linear-gradient(135deg, #00c4cc, #7d2ae8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .color-office { background: linear-gradient(135deg, #ea3e23, #b81d05); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        .product-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-cat {
            font-size: 0.72rem;
            color: var(--primary);
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 0.05em;
            margin-bottom: 0.4rem;
        }

        .product-name {
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.4;
            margin-bottom: 0.5rem;
            min-height: 2.7rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Star Rating & Trust Info */
        .product-trust {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.85rem;
        }

        .stars {
            display: flex;
            color: var(--accent);
            font-size: 0.72rem;
            gap: 1px;
        }

        .sold-count {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .product-specs {
            margin-bottom: 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            flex: 1;
        }

        .product-specs li {
            font-size: 0.78rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .product-specs li i {
            color: var(--success);
            font-size: 0.75rem;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 0.85rem;
            border-top: 1px solid var(--border-color);
        }

        .price-group {
            display: flex;
            flex-direction: column;
        }

        .price-slashed {
            font-size: 0.72rem;
            color: var(--text-dark);
            text-decoration: line-through;
        }

        .price-active {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .btn-add-cart {
            background: #ffffff;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            width: 2.3rem;
            height: 2.3rem;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
            position: relative;
            z-index: 2;
        }

        .product-card:hover .btn-add-cart {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 4px 10px var(--primary-glow);
        }

        .btn-add-cart:hover {
            transform: scale(1.05);
        }

        /* Toast feedback */
        .toast-notify {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: #ffffff;
            border: 1px solid var(--success);
            padding: 0.75rem 1.25rem;
            border-radius: var(--radius-sm);
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transform: translateY(-100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 2000;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .toast-notify.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Slide-out Cart Sidebar */
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -360px;
            width: 340px;
            height: 100vh;
            background: #ffffff;
            border-left: 1px solid var(--border-color);
            box-shadow: -10px 0 30px rgba(15, 23, 42, 0.08);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cart-sidebar.open {
            right: 0;
        }

        .cart-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.4);
            z-index: 999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .cart-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        .cart-header {
            padding: 1.25rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-header h3 {
            font-size: 1.05rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-main);
        }

        .cart-close-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .cart-close-btn:hover {
            color: var(--text-main);
        }

        .cart-items-container {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            background: var(--bg-body);
        }

        .cart-item {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 2px 4px rgba(15, 23, 42, 0.01);
        }

        .cart-item-icon {
            width: 2.2rem;
            height: 2.2rem;
            background: var(--bg-body);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .cart-item-img-wrapper {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: var(--radius-sm);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            background: #ffffff;
            flex-shrink: 0;
        }

        .cart-item-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.15rem;
        }

        .cart-item-price {
            font-size: 0.78rem;
            color: var(--primary);
            font-weight: 600;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 0.35rem;
        }

        .qty-btn {
            width: 1.25rem;
            height: 1.25rem;
            background: var(--bg-body);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            font-size: 0.65rem;
            border-radius: 3px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-val {
            font-size: 0.75rem;
            font-weight: 600;
            min-width: 1rem;
            text-align: center;
        }

        .remove-item-btn {
            color: var(--text-dark);
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
            transition: var(--transition);
        }

        .remove-item-btn:hover {
            color: #ef4444;
        }

        .cart-footer {
            padding: 1.25rem;
            border-top: 1px solid var(--border-color);
            background: #ffffff;
        }

        .cart-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .total-label {
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        .total-val {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .checkout-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.75rem;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 0.88rem;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .checkout-btn:hover {
            box-shadow: 0 4px 12px var(--primary-glow);
            transform: translateY(-1px);
        }

        .empty-cart-msg {
            color: var(--text-muted);
            font-size: 0.8rem;
            text-align: center;
            padding: 3rem 1rem;
        }

        /* Footer design */
        footer {
            background: #0f172a; /* Slate 900 for dark professional contrast */
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 3rem 0 1.5rem;
            margin-top: 3rem;
            color: #94a3b8;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-col h4 {
            color: white;
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            position: relative;
        }

        .footer-col h4::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 1.5rem;
            height: 2px;
            background: var(--primary);
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .footer-links a {
            color: #94a3b8;
            font-size: 0.82rem;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: white;
            padding-left: 0.2rem;
        }

        .footer-socials {
            display: flex;
            gap: 0.85rem;
            margin-top: 1rem;
        }

        .social-circle {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: var(--transition);
        }

        .social-circle:hover {
            background: var(--primary);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: #475569;
            font-size: 0.78rem;
        }

        /* Prevent auto zoom on iOS & Native app spacing */
        @media (max-width: 768px) {
            input, select, textarea, .search-input {
                font-size: 16px !important;
            }
            .container {
                padding: 0 0.75rem !important;
                max-width: 100% !important;
                width: 100% !important;
            }
            /* Header adjustments for catalog */
            header {
                padding: 0.5rem 0 !important;
                width: 100% !important;
                overflow: visible !important;
            }
            .navbar {
                display: grid !important;
                grid-template-columns: 1fr auto !important;
                gap: 0.35rem 0.75rem !important;
                align-items: center !important;
                width: 100% !important;
                min-width: 0 !important;
            }
            .logo {
                grid-column: 1 !important;
                grid-row: 1 !important;
                font-size: 1.2rem !important;
            }
            .nav-actions {
                grid-column: 2 !important;
                grid-row: 1 !important;
                gap: 0.75rem !important;
            }
            .action-icon-btn {
                width: 2.25rem !important;
                height: 2.25rem !important;
            }
            .header-contact-btn {
                display: none !important;
            }
            .search-wrapper {
                grid-column: 1 / span 2 !important;
                grid-row: 2 !important;
                width: 100% !important;
                max-width: 100% !important;
                margin-top: 0.25rem !important;
                min-width: 0 !important;
            }
            .search-input {
                height: 2.3rem !important;
            }
            .cat-nav-bar {
                grid-column: 1 / span 2 !important;
                grid-row: 3 !important;
                width: 100% !important;
                min-width: 0 !important; /* Prevent expanding the navbar grid */
                justify-content: flex-start !important;
                padding: 0.25rem 0.25rem 0.5rem 0.25rem !important;
                margin: 0 !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
            }
            .cat-pill {
                padding: 0.3rem 0.6rem !important;
                font-size: 0.75rem !important;
            }
            /* Catalog sidebar conversion */
            .catalog-container {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
                width: 100% !important;
                min-width: 0 !important;
            }
            .filter-sidebar {
                padding: 1rem !important;
                width: 100% !important;
                min-width: 0 !important;
            }
            .filter-group {
                margin-bottom: 0.85rem !important;
                padding-bottom: 0.85rem !important;
                width: 100% !important;
                min-width: 0 !important;
            }
            /* Convert vertical sidebar categories to scrollable horizontal pills */
            .sidebar-cat-list {
                display: flex !important;
                flex-direction: row !important;
                overflow-x: auto !important;
                gap: 0.5rem !important;
                padding-bottom: 0.75rem !important;
                -webkit-overflow-scrolling: touch !important;
                width: 100% !important;
                min-width: 0 !important; /* Prevent parent overflow */
            }
            .sidebar-cat-list::-webkit-scrollbar {
                height: 4px !important;
            }
            .sidebar-cat-list::-webkit-scrollbar-track {
                background: #f1f5f9 !important; 
                border-radius: 4px !important;
            }
            .sidebar-cat-list::-webkit-scrollbar-thumb {
                background: #94a3b8 !important; 
                border-radius: 4px !important;
            }
            .sidebar-cat-btn {
                white-space: nowrap !important;
                width: auto !important;
                padding: 0.4rem 0.85rem !important;
                border: 1px solid var(--border-color) !important;
                border-radius: var(--radius-full) !important;
                font-size: 0.78rem !important;
                display: inline-flex !important;
                align-items: center !important;
                text-align: center !important;
            }
            .sidebar-cat-btn::after {
                content: none !important; /* Hide any arrows/badges if present */
            }
            .sidebar-cat-btn.active {
                border-left: 1px solid var(--primary) !important;
                border-color: var(--primary) !important;
                background: linear-gradient(135deg, rgba(2, 132, 199, 0.05), rgba(14, 165, 233, 0.05)) !important;
                border-radius: var(--radius-full) !important;
            }
            /* Cart sidebar responsiveness */
            .cart-sidebar {
                width: 100% !important;
                right: -100%;
            }
            .cart-sidebar.open {
                right: 0 !important;
            }
        }

        @media (max-width: 600px) {
            /* 2-column mobile products grid */
            .products-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.75rem !important;
                width: 100% !important;
            }
            .product-card {
                border-radius: var(--radius-md) !important;
                min-width: 0 !important;
            }
            .product-media {
                height: 110px !important;
                padding: 0.5rem !important;
                min-width: 0 !important;
            }
            .product-media img {
                max-width: 100% !important;
                max-height: 100% !important;
                object-fit: contain !important;
            }
            .product-media i {
                font-size: 2.2rem !important;
            }
            .product-body {
                padding: 0.75rem !important;
                display: flex !important;
                flex-direction: column !important;
            }
            .product-cat {
                font-size: 0.65rem !important;
                margin-bottom: 0.2rem !important;
            }
            .product-name {
                font-size: 0.8rem !important;
                min-height: 2.2rem !important;
                margin-bottom: 0.3rem !important;
                line-height: 1.3 !important;
                word-break: break-word !important;
            }
            .product-trust {
                margin-bottom: 0.4rem !important;
                gap: 0.25rem !important;
                flex-wrap: wrap !important;
            }
            .stars {
                font-size: 0.65rem !important;
            }
            .sold-count {
                font-size: 0.65rem !important;
            }
            .product-specs {
                display: none !important;
            }
            .product-footer {
                padding-top: 0.5rem !important;
                margin-top: auto !important;
            }
            .price-slashed {
                font-size: 0.65rem !important;
            }
            .price-active {
                font-size: 0.95rem !important;
            }
            .btn-add-cart {
                width: 2rem !important;
                height: 2rem !important;
                border-radius: var(--radius-sm) !important;
            }
        }

        /* User Dropdown Menu */
        .user-menu-wrapper {
            position: relative;
        }

        .user-avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            width: 220px;
            padding: 0.5rem 0;
            display: none;
            z-index: 150;
            animation: slide-up-dropdown 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .user-dropdown-menu.show {
            display: block;
        }

        @keyframes slide-up-dropdown {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .user-dropdown-header {
            padding: 0.75rem 1.25rem;
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .user-display-name {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-display-email {
            font-size: 0.75rem;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 0.15rem;
        }

        .user-dropdown-divider {
            height: 1px;
            background: var(--border-color);
            margin: 0.4rem 0;
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 1.25rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
        }

        .user-dropdown-item:hover {
            background: var(--bg-body);
            color: var(--primary);
        }

        .user-dropdown-item.logout-btn-item:hover {
            background: #fef2f2;
            color: #ef4444 !important;
        }

        /* Floating Back to Top Button */
        .back-to-top-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #ffffff;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            transform: translateY(10px);
        }

        .back-to-top-btn.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
            background: linear-gradient(135deg, var(--secondary), var(--primary));
        }
    
        .mobile-menu-toggle {
            display: none !important;
        }
        @media (max-width: 768px) {
            .cat-nav-bar {
                display: none !important;
            }
            .mobile-menu-toggle {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }
            /* Menu link styles */
            .menu-side-link {
                display: flex;
                align-items: center;
                gap: 0.85rem;
                padding: 0.75rem 1rem;
                border-radius: var(--radius-sm);
                font-size: 0.9rem;
                font-weight: 600;
                color: var(--text-muted);
                transition: var(--transition);
                text-decoration: none;
            }
            .menu-side-link:hover, .menu-side-link.active {
                background: #f0f9ff;
                color: var(--primary);
            }
            .menu-side-link i {
                font-size: 1.05rem;
                width: 1.25rem;
                text-align: center;
            }
        }

        .mobile-search-toggle {
            display: none !important;
        }
        @media (max-width: 768px) {
            .mobile-search-toggle {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }
            .search-wrapper {
                display: none !important;
                position: absolute !important;
                top: 100% !important;
                left: 0.75rem !important;
                right: 0.75rem !important;
                width: calc(100% - 1.5rem) !important;
                background: #ffffff !important;
                box-shadow: var(--shadow-md) !important;
                border: 1px solid var(--border-color) !important;
                border-radius: var(--radius-md) !important;
                z-index: 9999 !important;
                margin-top: 0.25rem !important;
                padding: 0.25rem !important;
            }
            .search-wrapper.show {
                display: flex !important;
                animation: slideSearchDown 0.2s ease-out forwards !important;
            }
            @keyframes slideSearchDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        }
        @media (max-width: 600px) {
            .footer-grid {
                grid-template-columns: 1fr !important;
                gap: 1.75rem;
                text-align: center;
            }
            .footer-col {
                grid-column: span 1 !important;
            }
            .footer-col h4::after {
                left: 50%;
                transform: translateX(-50%);
            }
            .footer-links {
                align-items: center;
            }
            .footer-socials {
                justify-content: center;
            }
            .footer-col .logo {
                width: 100%;
                justify-content: center;
            }
            .footer-col p {
                margin: 0 auto;
            }
        }
        /* Pagination CSS */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .pagination {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .pagination li a, .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 6px;
            background: #ffffff;
            border: 1px solid var(--border-color, #e2e8f0);
            color: var(--text-muted, #64748b);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .pagination li a:hover {
            border-color: var(--primary, #0284c7);
            color: var(--primary, #0284c7);
        }
        .pagination li.active span {
            background: linear-gradient(135deg, var(--primary, #0284c7) 0%, var(--secondary, #0ea5e9) 100%);
            color: white;
            border-color: transparent;
        }
        .pagination li.disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }
</style>
</head>
<body>

    <!-- Top Promotion Bar -->
    <div class="top-ticker">
        <div class="marquee-wrapper">
            <div class="marquee-content">
                <span><i class="fa-solid fa-bolt"></i> Flash Sale: Nhập mã <strong>AI2026</strong> giảm ngay 20% cho tất cả tài khoản!</span>
                <span><i class="fa-solid fa-circle-check"></i> Hệ thống tự động kích hoạt tài khoản trong 30 giây!</span>
                <span><i class="fa-solid fa-shield-halved"></i> Cam kết bảo hành lỗi 1 đổi 1 trọn đời sử dụng!</span>
                <span><i class="fa-solid fa-heart-circle-check"></i> Hơn 10.000+ khách hàng tin dùng!</span>
                <span><i class="fa-solid fa-headset"></i> Hỗ trợ kỹ thuật 24/7 qua Zalo & Hotline!</span>
            </div>
            <!-- Duplicate the content for seamless infinite scrolling loop -->
            <div class="marquee-content" aria-hidden="true">
                <span><i class="fa-solid fa-bolt"></i> Flash Sale: Nhập mã <strong>AI2026</strong> giảm ngay 20% cho tất cả tài khoản!</span>
                <span><i class="fa-solid fa-circle-check"></i> Hệ thống tự động kích hoạt tài khoản trong 30 giây!</span>
                <span><i class="fa-solid fa-shield-halved"></i> Cam kết bảo hành lỗi 1 đổi 1 trọn đời sử dụng!</span>
                <span><i class="fa-solid fa-heart-circle-check"></i> Hơn 10.000+ khách hàng tin dùng!</span>
                <span><i class="fa-solid fa-headset"></i> Hỗ trợ kỹ thuật 24/7 qua Zalo & Hotline!</span>
            </div>
        </div>
    </div>

    <!-- Header Area -->
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

                <!-- Categories pills in Header (Sync with Filter) -->
            <div class="cat-nav-bar">
                <a href="/" class="cat-pill"><i class="fa-solid fa-house"></i> Trang Chủ</a>
                <button class="cat-pill" data-category="all"><i class="fa-solid fa-cubes"></i> Sản Phẩm</button>
                <button class="cat-pill" data-category="gpt"><i class="fa-solid fa-brain"></i> Chat Gpt</button>
                <button class="cat-pill" data-category="gemini"><i class="fa-brands fa-google"></i> Gemini</button>
                <button class="cat-pill" data-category="capcut"><i class="fa-solid fa-video"></i> CapCut Pro</button>
                <button class="cat-pill" data-category="canva"><i class="fa-solid fa-palette"></i> Canva</button>
                <a href="/posts" class="cat-pill"><i class="fa-solid fa-newspaper"></i> Bài Viết</a>
            </div>

                <div class="search-wrapper">
                    <input type="text" class="search-input" id="search-input" placeholder="Tìm kiếm nhanh sản phẩm...">
                    <button class="search-btn"><i class="fa-solid fa-search"></i></button>
                </div>

                <div class="nav-actions">
                    <button class="action-icon-btn mobile-search-toggle" id="mobile-search-toggle" title="Tìm kiếm"><i class="fa-solid fa-magnifying-glass"></i></button>
                    
                    <button class="action-icon-btn mobile-menu-toggle" id="mobile-menu-toggle" title="Menu"><i class="fa-solid fa-bars"></i></button>
                    
                    <a href="https://zalo.me/0569012134" target="_blank" class="action-icon-btn header-contact-btn" title="Liên hệ Zalo" style="color: var(--primary);">
                        <i class="fa-solid fa-phone"></i>
                    </a>
                    <button class="action-icon-btn" id="open-cart-btn" title="Giỏ hàng">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="badge" id="cart-count">0</span>
                    </button>
                    @auth
                        <div class="user-menu-wrapper">
                            <button class="action-icon-btn user-menu-btn" title="Tài khoản: {{ auth()->user()->name }}">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="user-avatar-img">
                                @else
                                    <i class="fa-solid fa-circle-user" style="font-size: 1.25rem;"></i>
                                @endif
                            </button>
                            <div class="user-dropdown-menu">
                                <div class="user-dropdown-header">
                                    <span class="user-display-name">{{ auth()->user()->name }}</span>
                                    <span class="user-display-email">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="user-dropdown-divider"></div>
                                @if(auth()->user()->isAdmin())
                                    <a href="/admin/dashboard" class="user-dropdown-item" style="color: #ef4444; font-weight: 700;"><i class="fa-solid fa-user-shield"></i> Quản trị Admin</a>
                                    <div class="user-dropdown-divider"></div>
                                @endif
                                <a href="/orders" class="user-dropdown-item"><i class="fa-solid fa-clock-rotate-left"></i> Đơn hàng đã mua</a>
                                <a href="/profile" class="user-dropdown-item"><i class="fa-solid fa-user-gear"></i> Thiết lập tài khoản</a>
                                <div class="user-dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST" style="margin: 0; width: 100%;">
                                    @csrf
                                    <button type="submit" class="user-dropdown-item logout-btn-item">
                                        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="action-icon-btn" title="Đăng nhập tài khoản">
                            <i class="fa-solid fa-user-lock"></i>
                        </a>
                    @endauth
                </div>
            </div>

            
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="container">

        <!-- Products Section with Split Layout 2/7 -->
        <div class="section-header" id="catalog-section">
            <h1 class="section-title" id="page-h1-title">{{ $currentSeo['h1'] }}</h1>
        </div>

        <div class="catalog-container">
            <!-- Sidebar: Lọc sản phẩm (2 parts) -->
            <aside class="filter-sidebar">
                <!-- Search Box -->
                <div class="filter-group">
                    <h3 class="filter-title"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</h3>
                    <input type="text" class="search-input" id="sidebar-search" placeholder="Gõ tên sản phẩm..." style="width: 100%; border: 1px solid var(--border-color); padding: 0.6rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.85rem;">
                </div>

                <!-- Category List -->
                <div class="filter-group">
                    <h3 class="filter-title"><i class="fa-solid fa-layer-group"></i> Danh mục</h3>
                    <div class="sidebar-cat-list">
                        <button class="sidebar-cat-btn active" data-category="all">Tất Cả</button>
                        <button class="sidebar-cat-btn" data-category="gpt">Chat Gpt</button>
                        <button class="sidebar-cat-btn" data-category="gemini">Gemini</button>
                        <button class="sidebar-cat-btn" data-category="capcut">CapCut Pro</button>
                        <button class="sidebar-cat-btn" data-category="canva">Canva</button>
                        <button class="sidebar-cat-btn" data-category="other">Sản Phẩm Khác</button>
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="filter-group">
                    <h3 class="filter-title"><i class="fa-solid fa-tags"></i> Khoảng giá</h3>
                    <div class="price-slider-group">
                        <input type="range" class="price-range-slider" id="price-range" min="0" max="600000" step="20000" value="600000">
                        <div class="price-inputs">
                            <span>0₫</span>
                            <span id="price-limit-label">Tối đa: 600.000₫</span>
                        </div>
                        <div class="price-quick-btns">
                            <button class="price-quick-btn" data-max="100000">Dưới 100k</button>
                            <button class="price-quick-btn" data-max="300000">Dưới 300k</button>
                            <button class="price-quick-btn" data-max="600000">Tất cả giá</button>
                        </div>
                    </div>
                </div>

                <!-- Reset button -->
                <button class="btn-reset-filters" id="reset-filters-btn">
                    <i class="fa-solid fa-arrow-rotate-left"></i> Đặt Lại Bộ Lọc
                </button>
            </aside>

            <!-- Main grid area (7 parts) -->
            <div style="width: 100%;">
                <div style="margin-bottom: 1.25rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; color: var(--text-muted); font-weight: 500;">
                    <span id="products-count-label">Đang hiển thị 6 sản phẩm</span>
                </div>
                
                <div class="products-grid" id="products-container">
                    @foreach($products as $prod)
                        <div class="product-card" data-cat="{{ $prod->category }}" data-id="{{ $prod->options[0]['id'] ?? ($prod->slug . '-default') }}" data-name="{{ $prod->name }}" data-price="{{ $prod->default_price }}" data-slashed="{{ $prod->default_slashed }}" data-icon="{{ $prod->icon }}" data-image="{{ $prod->image_path }}">
                            @if($prod->tag)
                                <span class="product-sale-tag">{{ $prod->tag }}</span>
                            @endif
                            <a href="/product/{{ $prod->slug }}" class="stretched-link" style="display: block; width: 100%; text-decoration: none; color: inherit;">
                                <div class="product-media" style="display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 1.5rem; height: 160px;">
                                    @if($prod->image_path)
                                        <img src="{{ asset($prod->image_path) }}" alt="{{ $prod->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 8px;">
                                    @else
                                        <i class="fa-solid {{ strtok($prod->icon, ' ') }}"></i>
                                    @endif
                                </div>
                            </a>
                            <div class="product-body">
                                <span class="product-cat">{{ $prod->category_label }}</span>
                                <a href="/product/{{ $prod->slug }}" style="text-decoration: none; color: inherit;">
                                    <h3 class="product-name" title="{{ $prod->name }}">{{ $prod->name }}</h3>
                                </a>
                                <div class="product-trust">
                                    <div class="stars">
                                        @for ($i = 0; $i < floor($prod->rating); $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                        @if($prod->rating - floor($prod->rating) >= 0.5)
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                        @endif
                                    </div>
                                    <span class="sold-count">| Đã bán {{ $prod->sold }}</span>
                                </div>
                                <ul class="product-specs">
                                    @if(is_array($prod->features))
                                        @foreach(array_slice($prod->features, 0, 3) as $feat)
                                            <li><i class="fa-solid fa-circle-check"></i> {{ $feat }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="product-footer">
                                    <div class="price-group">
                                        <span class="price-slashed">{{ number_format($prod->default_slashed, 0, ',', '.') }}₫</span>
                                        <span class="price-active">{{ number_format($prod->default_price, 0, ',', '.') }}₫</span>
                                    </div>
                                    <button class="btn-add-cart" title="Thêm vào giỏ hàng">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination links -->
                <div class="pagination-container" style="margin-top: 2rem; display: flex; justify-content: center;">
                    {{ $products->links() }}
                </div>

                <!-- Empty State Message -->
                <div id="no-products-msg" style="display: none; text-align: center; padding: 4rem 1rem; background: #ffffff; border: 1px solid var(--border-color); border-radius: var(--radius-md); color: var(--text-muted); font-size: 0.9rem; margin-top: 1rem; box-shadow: var(--shadow-sm);">
                    <i class="fa-solid fa-circle-question" style="font-size: 2.5rem; color: var(--text-dark); margin-bottom: 1rem; display: block;"></i>
                    Không tìm thấy sản phẩm nào khớp với bộ lọc của bạn.
                </div>
            </div>
        </div>

    </main>

    <!-- Slide-out Cart Sidebar -->
    <div class="cart-overlay" id="cart-overlay"></div>
    <div class="cart-sidebar" id="cart-sidebar">
        <div class="cart-header">
            <h3><i class="fa-solid fa-shopping-cart" style="color: var(--primary);"></i> Giỏ Hàng Của Bạn</h3>
            <button class="cart-close-btn" id="close-cart-btn"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="cart-items-container" id="cart-items-wrapper">
            <!-- Dynamic Cart Items here -->
            <div class="empty-cart-msg">Giỏ hàng đang trống. Hãy chọn những dịch vụ số sịn nhất nhé!</div>
        </div>
        <div class="cart-footer">
            <div class="cart-total-row">
                <span class="total-label">Tổng tiền tạm tính:</span>
                <span class="total-val" id="cart-total-price">0₫</span>
            </div>
            <button class="checkout-btn" id="checkout-btn">
                <i class="fa-solid fa-credit-card"></i> Tiến Hành Thanh Toán
            </button>
        </div>
    </div>

    <!-- Toast Notification (Add to cart feedback) -->
    <div class="toast-notify" id="toast-notify">
        <i class="fa-solid fa-circle-check" style="color: var(--success); font-size: 1.1rem;"></i>
        <span id="toast-message">Đã thêm vào giỏ hàng thành công!</span>
    </div>

    
    <!-- Slide-out Mobile Menu Sidebar -->
    <div class="menu-overlay" id="menu-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 9999; opacity: 0; transition: opacity 0.3s ease;"></div>
    <div class="menu-sidebar" id="menu-sidebar" style="position: fixed; top: 0; left: -280px; width: 280px; height: 100%; background: #ffffff; box-shadow: 10px 0 30px rgba(15, 23, 42, 0.1); z-index: 10000; display: flex; flex-direction: column; transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1); overflow-y: auto; padding: 1.5rem 1.25rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);">
            <h3 style="margin: 0; font-size: 1rem; font-weight: 800; color: var(--text-main);"><i class="fa-solid fa-bars" style="color: var(--primary); margin-right: 0.5rem;"></i> DANH MỤC</h3>
            <button id="menu-close-btn" style="background: none; border: none; font-size: 1.3rem; color: var(--text-muted); cursor: pointer;"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <nav style="display: flex; flex-direction: column; gap: 0.75rem;">
            <a href="/" class="menu-side-link"><i class="fa-solid fa-house"></i> Trang Chủ</a>
            <a href="/products?category=gpt" class="menu-side-link"><i class="fa-solid fa-brain"></i> Chat Gpt</a>
            <a href="/products?category=gemini" class="menu-side-link"><i class="fa-brands fa-google"></i> Gemini</a>
            <a href="/products?category=capcut" class="menu-side-link"><i class="fa-solid fa-video"></i> CapCut Pro</a>
            <a href="/products?category=canva" class="menu-side-link"><i class="fa-solid fa-palette"></i> Canva</a>
            <a href="/products" class="menu-side-link"><i class="fa-solid fa-cubes"></i> Sản Phẩm</a>
            <a href="/posts" class="menu-side-link"><i class="fa-solid fa-newspaper"></i> Bài Viết</a>
            <a href="https://zalo.me/0569012134" target="_blank" class="menu-side-link" style="color: var(--primary); font-weight: 700;"><i class="fa-solid fa-phone"></i> Liên Hệ Zalo</a>
        </nav>
    </div>

    <!-- Footer Area -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col" style="grid-column: span 1.5;">
                    <a href="/" class="logo" style="margin-bottom: 1rem; display: inline-flex; align-items: center; background: none; -webkit-text-fill-color: white; text-decoration: none;">
                        @if(file_exists(public_path('logo.png')))
                            <img src="{{ asset('logo.png') }}?v={{ time() }}" alt="Logo" style="max-height: 2.2rem; object-fit: contain;">
                        @else
                            <i class="fa-solid fa-rocket logo-icon" style="filter: none;"></i>
                            <span style="color: white;">AI CỦA TÔI</span>
                        @endif
                    </a>
                    <p style="font-size: 0.8rem; color: #94a3b8; line-height: 1.6; max-width: 280px;">
                        Hệ thống cung cấp dịch vụ nâng cấp tài khoản số, phần mềm đồ họa, thiết kế và AI hàng đầu Việt Nam. Tự động - Uy tín - Giá rẻ.
                    </p>
                    <div class="footer-socials">
                        <a href="{{ App\Models\Setting::getValue('social_facebook', 'https://facebook.com') }}" class="social-circle" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="{{ App\Models\Setting::getValue('social_telegram', 'https://t.me') }}" class="social-circle" target="_blank"><i class="fa-brands fa-telegram"></i></a>
                        <a href="{{ App\Models\Setting::getValue('social_zalo', 'https://zalo.me') }}" class="social-circle" target="_blank" style="font-weight: 800; font-family: 'Inter', sans-serif; font-size: 0.95rem;">Zalo</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Sản Phẩm</h4>
                    <div class="footer-links">
                        <a href="#">Tài khoản CapCut Pro</a>
                        <a href="#">Tài khoản ChatGPT Plus</a>
                        <a href="#">Tài khoản Claude Pro</a>
                        <a href="#">Canva Pro Nâng Cấp</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Dịch Vụ & Hỗ Trợ</h4>
                    <div class="footer-links">
                        <a href="/posts">Tin Tức & Bài Viết</a>
                        <a href="#">Chính Sách Bảo Hành</a>
                        <a href="#">Điều Khoản Sử Dụng</a>
                        <a href="#">Hướng Dẫn Mua Hàng</a>
                        <a href="https://zalo.me/0569012134" target="_blank">Zalo Support 24/7</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Liên Hệ</h4>
                    <div class="footer-links" style="gap: 0.8rem;">
                        <a href="https://zalo.me/0569012134" target="_blank" style="font-size: 0.8rem; color: #94a3b8; text-decoration: none; display: flex; align-items: center;"><i class="fa-solid fa-phone" style="color: var(--primary); margin-right: 0.4rem;"></i> Zalo: 0569012134</a>
                        <a href="https://t.me/specademy" target="_blank" style="font-size: 0.8rem; color: #94a3b8; text-decoration: none; display: flex; align-items: center;"><i class="fa-brands fa-telegram" style="color: var(--primary); margin-right: 0.4rem;"></i> Telegram: @specademy</a>
                        <span style="font-size: 0.8rem; color: #94a3b8;"><i class="fa-solid fa-clock" style="color: var(--primary); margin-right: 0.4rem;"></i> Làm việc: 24/7 kể cả ngày lễ</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; {{ date('Y') }} AI CỦA TÔI. Nền tảng phân phối dịch vụ số hàng đầu.
            </div>
        </div>
    </footer>

    <!-- Interactive Javascript Logic -->
    <script>
        // State variables
        let cart = [];
        const savedCart = localStorage.getItem('capcut_store_cart');
        if (savedCart) {
            try {
                cart = JSON.parse(savedCart);
            } catch(e) {
                cart = [];
            }
        }
        
        // Filter states
        let filterState = {
            category: 'all',
            search: '',
            maxPrice: 600000
        };

        // Elements
        const cartSidebar = document.getElementById('cart-sidebar');
        const cartOverlay = document.getElementById('cart-overlay');
        const openCartBtn = document.getElementById('open-cart-btn');
        const closeCartBtn = document.getElementById('close-cart-btn');
        const cartItemsWrapper = document.getElementById('cart-items-wrapper');
        const cartTotalPrice = document.getElementById('cart-total-price');
        const cartCount = document.getElementById('cart-count');
        const toastNotify = document.getElementById('toast-notify');
        const toastMessage = document.getElementById('toast-message');

        // Filter elements
        const sidebarSearchInput = document.getElementById('sidebar-search');
        const headerSearchInput = document.getElementById('search-input');
        const priceRangeSlider = document.getElementById('price-range');
        const priceLimitLabel = document.getElementById('price-limit-label');
        const productsCountLabel = document.getElementById('products-count-label');
        const noProductsMsg = document.getElementById('no-products-msg');
        const productsContainer = document.getElementById('products-container');
        const resetFiltersBtn = document.getElementById('reset-filters-btn');

        // Functions: Format Currency
        function formatVND(amount) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount).replace('₫', '₫');
        }

        // Functions: Open/Close Cart
        function openCart() {
            cartSidebar.classList.add('open');
            cartOverlay.classList.add('open');
        }

        // Functions: Close Cart
        function closeCart() {
            cartSidebar.classList.remove('open');
            cartOverlay.classList.remove('open');
        }

        // Functions: Render Cart HTML
        function renderCart() {
            if (cart.length === 0) {
                cartItemsWrapper.innerHTML = `<div class="empty-cart-msg">Giỏ hàng đang trống. Hãy chọn những dịch vụ số sịn nhất nhé!</div>`;
                cartTotalPrice.innerText = '0₫';
                cartCount.innerText = '0';
                return;
            }

            let html = '';
            let total = 0;
            let count = 0;

            cart.forEach((item, index) => {
                total += item.price * item.quantity;
                count += item.quantity;

                let mediaHtml = '';
                if (item.image) {
                    mediaHtml = `
                        <div class="cart-item-img-wrapper">
                            <img src="/${item.image}" alt="${item.name}" class="cart-item-img">
                        </div>
                    `;
                } else {
                    mediaHtml = `
                        <div class="cart-item-icon">
                            <i class="fa-solid ${item.icon}"></i>
                        </div>
                    `;
                }

                html += `
                    <div class="cart-item">
                        ${mediaHtml}
                        <div class="cart-item-details">
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-price">${formatVND(item.price)}</div>
                            <div class="cart-item-quantity">
                                <button class="qty-btn" onclick="updateQty(${index}, -1)"><i class="fa-solid fa-minus"></i></button>
                                <span class="qty-val">${item.quantity}</span>
                                <button class="qty-btn" onclick="updateQty(${index}, 1)"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <button class="remove-item-btn" onclick="removeFromCart(${index})">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                `;
            });

            cartItemsWrapper.innerHTML = html;
            cartTotalPrice.innerText = formatVND(total);
            cartCount.innerText = count;

            // Persist to localStorage
            localStorage.setItem('capcut_store_cart', JSON.stringify(cart));
        }

        // Functions: Add item to Cart
        function addToCart(id, name, price, icon, image) {
            const existingIndex = cart.findIndex(item => item.id === id);
            if (existingIndex > -1) {
                cart[existingIndex].quantity += 1;
            } else {
                cart.push({ id, name, price, icon, image, quantity: 1 });
            }
            renderCart();
            showToast(`Đã thêm "${name}" vào giỏ hàng thành công!`);
            openCart();
        }

        // Functions: Remove from Cart
        window.removeFromCart = function(index) {
            cart.splice(index, 1);
            renderCart();
        };

        // Functions: Update Quantity
        window.updateQty = function(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            renderCart();
        };

        // Functions: Show Toast
        function showToast(msg) {
            toastMessage.innerText = msg;
            toastNotify.classList.add('show');
            setTimeout(() => {
                toastNotify.classList.remove('show');
            }, 3000);
        }

        // Apply filters to product grid
        function applyFilters() {
            let visibleCount = 0;
            const query = filterState.search.toLowerCase().trim();
            const category = filterState.category;
            const maxPrice = filterState.maxPrice;

            document.querySelectorAll('.product-card').forEach(card => {
                const cardName = card.getAttribute('data-name').toLowerCase();
                const cardCat = card.getAttribute('data-cat');
                const cardPrice = parseInt(card.getAttribute('data-price'));

                const matchesSearch = cardName.includes(query) || cardCat.includes(query);
                const matchesCategory = category === 'all' || cardCat === category;
                const matchesPrice = cardPrice <= maxPrice;

                if (matchesSearch && matchesCategory && matchesPrice) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update product counts
            productsCountLabel.innerText = `Đang hiển thị ${visibleCount} sản phẩm`;
            
            // Show/hide empty state
            if (visibleCount === 0) {
                noProductsMsg.style.display = 'block';
                productsContainer.style.display = 'none';
            } else {
                noProductsMsg.style.display = 'none';
                productsContainer.style.display = 'grid';
            }

            // Sync address bar URL with filter state
            updateURLParams();
        }

        // Update URL query parameters dynamically
        function updateURLParams() {
            const url = new URL(window.location);
            
            if (filterState.category && filterState.category !== 'all') {
                url.searchParams.set('category', filterState.category);
            } else {
                url.searchParams.delete('category');
            }
            
            if (filterState.search) {
                url.searchParams.set('search', filterState.search);
            } else {
                url.searchParams.delete('search');
            }
            
            window.history.replaceState({}, '', url);
        }

        const categoryTitles = {
            all: 'Khám Phá Cửa Hàng Số',
            gpt: 'Tài Khoản ChatGPT Plus Premium',
            gemini: 'Google Gemini Advanced + 5TB Google One',
            capcut: 'Tài Khoản CapCut Pro Chính Chủ',
            canva: 'Nâng Cấp Canva Pro Chính Chủ',
            other: 'Premium Tools & Dịch Vụ AI Khác'
        };

        const seoTitles = {
            all: 'Cửa Hàng Bản Quyền Tài Khoản AI & Premium Tools | AI CỦA TÔI',
            gpt: 'Mua Tài Khoản ChatGPT Plus (GPT-5) Premium Giá Rẻ | AI CỦA TÔI',
            gemini: 'Nâng Cấp Google Gemini Advanced Kèm 5TB Google One | AI CỦA TÔI',
            capcut: 'Nâng Cấp Tài Khoản CapCut Pro Gói 1 Năm Chính Chủ | AI CỦA TÔI',
            canva: 'Nâng Cấp Canva Pro Kích Hoạt Email Chính Chủ | AI CỦA TÔI',
            other: 'Mua Tài Khoản Premium Tools & Dịch Vụ AI Giá Tốt | AI CỦA TÔI'
        };

        // Sync header category pill and sidebar category btn
        function updateCategoryUI(cat) {
            filterState.category = cat;

            // Update H1 Title
            const h1Element = document.getElementById('page-h1-title');
            if (h1Element && categoryTitles[cat]) {
                h1Element.innerText = categoryTitles[cat];
            }

            // Update Tab Title
            if (seoTitles[cat]) {
                document.title = seoTitles[cat];
            }

            // Update top bar pills
            document.querySelectorAll('.cat-pill').forEach(pill => {
                if (pill.getAttribute('data-category') === cat) {
                    pill.classList.add('active');
                } else {
                    pill.classList.remove('active');
                }
            });

            // Update sidebar buttons
            document.querySelectorAll('.sidebar-cat-btn').forEach(btn => {
                if (btn.getAttribute('data-category') === cat) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            applyFilters();
        }

        // Set search UI & State
        function updateSearchState(query) {
            filterState.search = query;
            sidebarSearchInput.value = query;
            headerSearchInput.value = query;
            applyFilters();
        }

        // Set Price range UI & State
        function updatePriceState(val) {
            filterState.maxPrice = val;
            priceRangeSlider.value = val;
            priceLimitLabel.innerText = `Tối đa: ${formatVND(val)}`;
            
            // Check quick filters
            document.querySelectorAll('.price-quick-btn').forEach(btn => {
                const max = parseInt(btn.getAttribute('data-max'));
                if (max === val) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            applyFilters();
        }

        // Reset all filters
        function resetFilters() {
            filterState.category = 'all';
            filterState.search = '';
            filterState.maxPrice = 600000;

            sidebarSearchInput.value = '';
            headerSearchInput.value = '';
            priceRangeSlider.value = 600000;
            priceLimitLabel.innerText = `Tối đa: ${formatVND(600000)}`;

            document.querySelectorAll('.cat-pill').forEach(pill => {
                if (pill.getAttribute('data-category') === 'all') pill.classList.add('active');
                else pill.classList.remove('active');
            });

            document.querySelectorAll('.sidebar-cat-btn').forEach(btn => {
                if (btn.getAttribute('data-category') === 'all') btn.classList.add('active');
                else btn.classList.remove('active');
            });

            document.querySelectorAll('.price-quick-btn').forEach(btn => {
                if (btn.getAttribute('data-max') === '600000') btn.classList.add('active');
                else btn.classList.remove('active');
            });

            applyFilters();
        }

        // Event listeners for Cart buttons
        if (openCartBtn) openCartBtn.addEventListener('click', openCart);
        if (closeCartBtn) closeCartBtn.addEventListener('click', closeCart);
        if (cartOverlay) cartOverlay.addEventListener('click', closeCart);

        // User Menu Dropdown Toggle
        const userMenuBtn = document.querySelector('.user-menu-btn');
        const userDropdownMenu = document.querySelector('.user-dropdown-menu');
        if (userMenuBtn && userDropdownMenu) {
            userMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdownMenu.classList.toggle('show');
            });
            document.addEventListener('click', () => {
                userDropdownMenu.classList.remove('show');
            });
        }

        // Bind all Add to Cart buttons in DOM
        document.querySelectorAll('.btn-add-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const card = this.closest('.product-card');
                const id = card.getAttribute('data-id');
                const name = card.getAttribute('data-name');
                const price = parseInt(card.getAttribute('data-price'));
                const icon = card.getAttribute('data-icon');
                const image = card.getAttribute('data-image');
                addToCart(id, name, price, icon, image);
            });
        });

        // Checkout Button Click
        const checkoutBtn = document.getElementById('checkout-btn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', () => {
                if (cart.length === 0) {
                    alert('Giỏ hàng của bạn đang trống!');
                    return;
                }
                window.location.href = '/checkout';
            });
        }

        // Bind Category Pill clicks (Header)
        document.querySelectorAll('.cat-pill').forEach(pill => {
            pill.addEventListener('click', function() {
                const cat = this.getAttribute('data-category');
                if (cat) {
                    updateCategoryUI(cat);
                }
            });
        });

        // Bind Sidebar Category Button clicks
        document.querySelectorAll('.sidebar-cat-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const cat = this.getAttribute('data-category');
                if (cat) {
                    updateCategoryUI(cat);
                }
            });
        });

        // Search inputs change handlers
        headerSearchInput.addEventListener('input', function(e) {
            updateSearchState(e.target.value);
        });

        sidebarSearchInput.addEventListener('input', function(e) {
            updateSearchState(e.target.value);
        });

        // Price range slider change handlers
        priceRangeSlider.addEventListener('input', function(e) {
            updatePriceState(parseInt(e.target.value));
        });

        // Quick price buttons clicks
        document.querySelectorAll('.price-quick-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const max = parseInt(this.getAttribute('data-max'));
                updatePriceState(max);
            });
        });

        // Reset filter button click
        resetFiltersBtn.addEventListener('click', resetFilters);

        // Check if category or search is passed via URL query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const catParam = urlParams.get('category');
        const searchParam = urlParams.get('search');
        
        updateCategoryUI(catParam || 'all');
        if (searchParam) {
            updateSearchState(searchParam);
        }

        // Render initial cart from localStorage
        renderCart();

        // Back to Top Scroll behavior (with safety check to prevent JS halt)
        const backToTopBtn = document.getElementById('back-to-top-btn');
        if (backToTopBtn) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            });
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    
        // Mobile Menu Toggle logic (Executed immediately since script is at body end)
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const menuSidebar = document.getElementById('menu-sidebar');
        const menuOverlay = document.getElementById('menu-overlay');
        const menuClose = document.getElementById('menu-close-btn');

        if (menuToggle && menuSidebar && menuOverlay && menuClose) {
            menuToggle.addEventListener('click', () => {
                menuOverlay.style.display = 'block';
                setTimeout(() => {
                    menuOverlay.style.opacity = '1';
                    menuSidebar.style.left = '0';
                }, 10);
            });

            const closeMenu = () => {
                menuOverlay.style.opacity = '0';
                menuSidebar.style.left = '-280px';
                setTimeout(() => {
                    menuOverlay.style.display = 'none';
                }, 300);
            };

            menuClose.addEventListener('click', closeMenu);
            menuOverlay.addEventListener('click', closeMenu);
        }

        // Highlight active side link
        const currentPath = window.location.pathname + window.location.search;
        document.querySelectorAll('.menu-side-link').forEach(link => {
            const href = link.getAttribute('href');
            if (href === currentPath || (href === '/' && currentPath === '') || (href !== '/' && currentPath.startsWith(href))) {
                link.classList.add('active');
            }
        });

        // Mobile Search Toggle logic
        const searchToggle = document.getElementById('mobile-search-toggle');
        const searchWrapper = document.querySelector('.search-wrapper');
        const searchInput = document.querySelector('.search-input');

        if (searchToggle && searchWrapper && searchInput) {
            searchToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                searchWrapper.classList.toggle('show');
                if (searchWrapper.classList.contains('show')) {
                    searchInput.focus();
                }
            });
            
            document.addEventListener('click', (e) => {
                if (!searchWrapper.contains(e.target) && e.target !== searchToggle) {
                    searchWrapper.classList.remove('show');
                }
            });
        }
</script>
    
    <!-- Floating Back to Top Button -->
    <button id="back-to-top-btn" class="back-to-top-btn" title="Cuộn lên đầu trang">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    @include('partials.chat-bubble')
</body>
</html>
