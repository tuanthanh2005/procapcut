<?php
$listSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Blog',
    'name' => 'Cẩm Nang Công Nghệ & AI - AI CỦA TÔI',
    'description' => 'Chuyên trang chia sẻ hướng dẫn sử dụng CapCut Pro, Canva Pro, ChatGPT và các công cụ AI hỗ trợ SEO, thiết kế đồ họa đỉnh cao tại AI CỦA TÔI.',
    'url' => request()->url(),
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'AI CỦA TÔI',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('logo.png')
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Kinh Nghiệm & Tin Tức Công Nghệ | AI CỦA TÔI</title>
    <meta name="description" content="Chuyên trang chia sẻ hướng dẫn sử dụng CapCut Pro, Canva Pro, ChatGPT và các công cụ AI hỗ trợ SEO, thiết kế đồ họa đỉnh cao tại AI CỦA TÔI.">
    <meta name="keywords" content="blog công nghệ, hướng dẫn seo, tài liệu capcut pro, hướng dẫn canva, tin tức ai">
    <link rel="canonical" href="{{ request()->url() }}">

    <!-- JSON-LD Structure Data Schema for SEO -->
    <script type="application/ld+json">
        {!! json_encode($listSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    
    <!-- OpenGraph SEO -->
    <meta property="og:title" content="Kinh Nghiệm & Tin Tức Công Nghệ | AI CỦA TÔI">
    <meta property="og:description" content="Chuyên trang chia sẻ hướng dẫn sử dụng CapCut Pro, Canva Pro, ChatGPT và các công cụ AI hỗ trợ SEO, thiết kế đồ họa đỉnh cao tại AI CỦA TÔI.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    
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

        /* User dropmenu */
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
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            width: 220px;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: var(--transition);
            z-index: 110;
            overflow: hidden;
        }

        .user-dropdown-menu.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-dropdown-header {
            padding: 0.85rem 1rem;
            background: var(--bg-glass);
            display: flex;
            flex-direction: column;
        }

        .user-display-name {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text-main);
        }

        .user-display-email {
            font-size: 0.75rem;
            color: var(--text-dark);
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-dropdown-divider {
            height: 1px;
            background: var(--border-color);
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.75rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: var(--transition);
        }

        .user-dropdown-item:hover {
            background: var(--bg-glass);
            color: var(--primary);
            padding-left: 1.25rem;
        }

        .logout-btn-item {
            color: #ef4444 !important;
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

        /* Banner SEO Section */
        .blog-banner {
            padding: 3.5rem 0 2rem;
            text-align: center;
        }

        .blog-banner h1 {
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--text-main) 30%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .blog-banner p {
            font-size: 0.95rem;
            color: var(--text-dark);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Grid Layout */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .blog-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        .blog-card:hover {
            transform: translateY(-5px);
            border-color: var(--border-hover);
            box-shadow: var(--shadow-md);
        }

        .blog-img-wrapper {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: #e2e8f0;
        }

        .blog-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .blog-card:hover .blog-img-wrapper img {
            transform: scale(1.05);
        }

        .blog-meta-badge {
            position: absolute;
            bottom: 0.85rem;
            left: 0.85rem;
            background: rgba(15, 23, 42, 0.75);
            color: white;
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: var(--radius-full);
            backdrop-filter: blur(4px);
            font-weight: 500;
        }

        .blog-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .blog-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.4;
            margin-bottom: 0.65rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .blog-title:hover {
            color: var(--primary);
        }

        .blog-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .blog-card-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--text-dark);
            border-top: 1px solid var(--border-color);
            padding-top: 0.85rem;
        }

        .blog-author {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .blog-author i {
            color: var(--primary);
        }

        .read-more-btn {
            font-size: 0.8rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: var(--transition);
        }

        .read-more-btn:hover {
            color: var(--secondary);
            gap: 0.4rem;
        }

        /* Pagination CSS */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-bottom: 4rem;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
        }

        .pagination li a, .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.2rem;
            height: 2.2rem;
            border-radius: var(--radius-sm);
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .pagination li a:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination li.active span {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-color: transparent;
        }

        .pagination li.disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-posts-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            max-width: 600px;
            margin: 0 auto 4rem;
        }

        .empty-posts-state i {
            font-size: 3rem;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .empty-posts-state h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        /* Responsive Layouts */
        @media (max-width: 768px) {
            .navbar {
                flex-wrap: wrap;
                height: auto;
                padding: 0.75rem 0;
            }
            .cat-nav-bar {
                order: 3;
                width: 100%;
                justify-content: flex-start;
                margin-top: 0.5rem;
            }
            .search-wrapper {
                max-width: 180px;
            }
            .blog-grid {
                grid-template-columns: 1fr;
            }
        }
    
        /* Prevent auto zoom on iOS & Native app spacing */
        @media (max-width: 768px) {
            input, select, textarea, .form-input, .form-control {
                font-size: 16px !important;
            }
            .container {
                padding: 0 0.75rem !important;
            }
            /* Header adjustments */
            header {
                padding: 0.5rem 0 !important;
            }
            .navbar {
                display: grid !important;
                grid-template-columns: 1fr auto !important;
                gap: 0.35rem 0.75rem !important;
                align-items: center !important;
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
            }
            .search-input {
                height: 2.3rem !important;
            }
            .cat-nav-bar {
                grid-column: 1 / span 2 !important;
                grid-row: 3 !important;
                width: 100% !important;
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
            /* Responsive cart sidebar */
            .cart-sidebar {
                width: 100% !important;
                right: -100%;
            }
            .cart-sidebar.open {
                right: 0 !important;
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
</style>
</head>
<body>

    <!-- Top Alert Row -->
    <div class="top-ticker">
        <div class="marquee-wrapper">
            <div class="marquee-content">
                <span><i class="fa-solid fa-bolt"></i> Flash Sale: Nhập mã <strong>AI2026</strong> giảm ngay 20% cho tất cả tài khoản!</span>
                <span><i class="fa-solid fa-circle-check"></i> Hệ thống tự động kích hoạt tài khoản trong 30 giây!</span>
                <span><i class="fa-solid fa-shield-halved"></i> Cam kết bảo hành lỗi 1 đổi 1 trọn đời sử dụng!</span>
                <span><i class="fa-solid fa-heart-circle-check"></i> Hơn 10.000+ khách hàng tin dùng!</span>
                <span><i class="fa-solid fa-headset"></i> Hỗ trợ kỹ thuật 24/7 qua Zalo & Hotline!</span>
            </div>
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

                <!-- Categories pills in Header -->
                <div class="cat-nav-bar">
                    <a href="/" class="cat-pill"><i class="fa-solid fa-house"></i> Trang Chủ</a>
                    <a href="/products?category=gpt" class="cat-pill"><i class="fa-solid fa-brain"></i> Chat Gpt</a>
                    <a href="/products?category=gemini" class="cat-pill"><i class="fa-brands fa-google"></i> Gemini</a>
                    <a href="/products?category=capcut" class="cat-pill"><i class="fa-solid fa-video"></i> CapCut Pro</a>
                    <a href="/products?category=canva" class="cat-pill"><i class="fa-solid fa-palette"></i> Canva</a>
                    <a href="/products?category=other" class="cat-pill"><i class="fa-solid fa-cubes"></i> Sản Phẩm Khác</a>
                    <a href="/posts" class="cat-pill active"><i class="fa-solid fa-newspaper"></i> Bài Viết</a>
                </div>

                <div class="search-wrapper">
                    <input type="text" class="search-input" id="search-input" placeholder="Tìm bài viết..." onkeyup="if(event.key === 'Enter') handleSearch()">
                    <button class="search-btn" onclick="handleSearch()"><i class="fa-solid fa-search"></i></button>
                </div>

                <div class="nav-actions">
                    <a href="https://zalo.me/0569012134" target="_blank" class="action-icon-btn header-contact-btn" title="Liên hệ Zalo" style="color: var(--primary);">
                        <i class="fa-solid fa-phone"></i>
                    </a>
                    <button class="action-icon-btn" id="open-cart-btn" title="Giỏ hàng">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="badge" id="cart-count">0</span>
                    </button>
                    @auth
                        <div class="user-menu-wrapper">
                            <button class="action-icon-btn user-menu-btn" id="user-menu-btn" title="Tài khoản: {{ auth()->user()->name }}">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="user-avatar-img">
                                @else
                                    <i class="fa-solid fa-circle-user" style="font-size: 1.25rem;"></i>
                                @endif
                            </button>
                            <div class="user-dropdown-menu" id="user-dropdown-menu">
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

    <main class="container">
        
        <!-- Blog Banner -->
        <section class="blog-banner">
            <h1>Cẩm Nang Công Nghệ & AI</h1>
            <p>Khám phá các hướng dẫn sử dụng sản phẩm số, mẹo tối ưu hóa quy trình làm việc, thiết kế đồ họa và SEO bằng các công cụ AI đỉnh cao.</p>
        </section>

        <!-- Blog Grid -->
        @if ($posts->isEmpty())
            <div class="empty-posts-state">
                <i class="fa-solid fa-newspaper"></i>
                <h3>Chưa có bài viết nào</h3>
                <p>Hệ thống đang chuẩn bị cập nhật những tin tức bài viết bổ ích nhất. Quý khách vui lòng quay lại sau nhé!</p>
            </div>
        @else
            <section class="blog-grid">
                @foreach($posts as $post)
                    <article class="blog-card">
                        <div class="blog-img-wrapper">
                            @if($post->image_path)
                                <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?q=80&w=600&auto=format&fit=crop" alt="Placeholder image">
                            @endif
                            <span class="blog-meta-badge">{{ $post->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="blog-body">
                            <a href="{{ route('posts.show', $post->slug) }}" class="blog-title">{{ $post->title }}</a>
                            <p class="blog-desc">{{ $post->summary ?: 'Không có mô tả tóm tắt nào cho bài viết này.' }}</p>
                            <div class="blog-card-footer">
                                <span class="blog-author"><i class="fa-solid fa-user-pen"></i> Tác giả: Admin</span>
                                <a href="{{ route('posts.show', $post->slug) }}" class="read-more-btn">Đọc tiếp <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>

            <!-- Pagination Grid -->
            <div class="pagination-container">
                {{ $posts->links() }}
            </div>
        @endif

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
            <button class="checkout-btn" id="checkout-btn-side">
                <i class="fa-solid fa-credit-card"></i> Tiến Hành Thanh Toán
            </button>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-notify" id="toast-notify">
        <i class="fa-solid fa-circle-check" style="color: var(--success); font-size: 1.1rem;"></i>
        <span id="toast-message">Đã thêm vào giỏ hàng thành công!</span>
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
                    <div class="social-links">
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

        // Functions: Format Currency
        function formatVND(amount) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount).replace('₫', '₫');
        }

        // Functions: Open/Close Cart
        function openCart() {
            cartSidebar.classList.add('open');
            cartOverlay.classList.add('open');
        }

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

        // Functions: Update Quantity
        window.updateQty = function(index, direction) {
            cart[index].quantity += direction;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            renderCart();
        }

        // Functions: Remove Item
        window.removeFromCart = function(index) {
            cart.splice(index, 1);
            renderCart();
        }

        // Handlers: Search Box redirecting to products page
        window.handleSearch = function() {
            const query = document.getElementById('search-input').value.trim();
            if (query !== '') {
                window.location.href = `/products?search=${encodeURIComponent(query)}`;
            }
        }

        // Events listeners
        if (openCartBtn) openCartBtn.addEventListener('click', openCart);
        if (closeCartBtn) closeCartBtn.addEventListener('click', closeCart);
        if (cartOverlay) cartOverlay.addEventListener('click', closeCart);

        // User dropdown menu logic
        const userMenuBtn = document.getElementById('user-menu-btn');
        const userDropdownMenu = document.getElementById('user-dropdown-menu');

        if (userMenuBtn && userDropdownMenu) {
            userMenuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdownMenu.classList.toggle('open');
            });
            document.addEventListener('click', function() {
                userDropdownMenu.classList.remove('open');
            });
        }

        // Checkout Button in Sidebar
        const checkoutBtnSide = document.getElementById('checkout-btn-side');
        if (checkoutBtnSide) {
            checkoutBtnSide.addEventListener('click', function() {
                if (cart.length === 0) {
                    alert('Giỏ hàng trống!');
                    return;
                }
                window.location.href = '/checkout';
            });
        }

        // Initial rendering
        renderCart();
    </script>

    @include('partials.chat-bubble')
</body>
</html>
