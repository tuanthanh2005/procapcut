<?php
// Product details view - $product, $related, and $slug variables are dynamically supplied by the route from DB

// Generate single Product JSON-LD Schema
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product['name'],
    'image' => $product['image_path'] ? asset($product['image_path']) : 'https://aicuatoi.com/images/logo.png',
    'description' => $product['seo_desc'],
    'sku' => $product['options'][0]['id'] ?? 'CC-PRO',
    'mpn' => $product['options'][0]['id'] ?? 'CC-PRO',
    'brand' => [
        '@type' => 'Brand',
        'name' => 'AI CỦA TÔI'
    ],
    'offers' => [
        '@type' => 'Offer',
        'url' => request()->fullUrl(),
        'priceCurrency' => 'VND',
        'price' => $product['default_price'],
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
        'ratingValue' => $product['rating'],
        'reviewCount' => $product['review_count']
    ]
];
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product['seo_title'] }}</title>
    <meta name="description" content="{{ $product['seo_desc'] }}">
    <meta name="keywords" content="{{ $product['seo_keywords'] }}">
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
            --bg-body: #f1f5f9;
            --bg-nav: rgba(255, 255, 255, 0.9);
            --bg-card: #ffffff;
            --bg-card-hover: #ffffff;
            --bg-glass: rgba(15, 23, 42, 0.04);
            --bg-glass-hover: rgba(15, 23, 42, 0.08);
            
            --primary: #0284c7;
            --primary-glow: rgba(2, 132, 199, 0.2);
            --secondary: #0ea5e9;
            --secondary-glow: rgba(14, 165, 233, 0.2);
            --accent: #d97706;
            --success: #059669;
            
            --text-main: #0f172a;
            --text-muted: #334155;
            --text-dark: #64748b;
            
            --border-color: #cbd5e1;
            --border-hover: #0284c7;
            
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
            padding-top: 6px;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Top Sale Ticker */
        .top-ticker {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            text-align: center;
            padding: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 101;
        }

        .top-ticker i {
            animation: pulse-icon 1.5s infinite;
        }

        @keyframes pulse-icon {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Header design */
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
            text-decoration: none;
        }

        .logo-icon {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.6rem;
            filter: drop-shadow(0 2px 4px var(--primary-glow));
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
            text-decoration: none;
        }

        .action-icon-btn:hover {
            background: var(--bg-body);
            border-color: var(--border-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.1);
        }

        .action-icon-btn .badge {
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
            margin-top: 1rem;
            padding-top: 6px;
            display: flex;
            justify-content: center;
            gap: 1.25rem;
            overflow-x: auto;
            padding-bottom: 0.35rem;
            scrollbar-width: none;
        }

        .cat-nav-bar::-webkit-scrollbar {
            display: none;
        }

        .cat-pill {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-muted);
            white-space: nowrap;
            padding: 0.4rem 0.85rem;
            border-radius: var(--radius-full);
            background: #ffffff;
            border: 1px solid var(--border-color);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.4rem;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.02);
            cursor: pointer;
            text-decoration: none;
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

        /* Main layout split */
        main {
            padding-top: 2.5rem !important;
            padding-bottom: 4rem !important;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.78rem;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        .breadcrumb a {
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        /* Product details grid */
        .details-grid {
            display: grid;
            grid-template-columns: 4.5fr 7.5fr;
            gap: 2.5rem;
            align-items: start;
            margin-bottom: 4rem;
        }

        /* Left Column: Media & Spec highlights */
        .left-col {
            position: sticky;
            top: 6.5rem;
        }

        .media-box {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 4rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
            position: relative;
        }

        .media-box i {
            font-size: 5rem;
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.05));
        }

        .sale-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--accent);
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 0.6rem;
            border-radius: var(--radius-sm);
        }

        /* Quick Specs section */
        .quick-specs-box {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
        }

        .quick-specs-box h3 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.5rem;
        }

        .spec-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .spec-list li {
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            line-height: 1.4;
        }

        .spec-list li i {
            color: var(--success);
            margin-top: 0.15rem;
        }

        /* Color classes */
        .color-capcut { color: #0f172a; }
        .color-gpt { color: #10a37f; }
        .color-gemini { color: #1a73e8; }
        .color-canva { color: #00c4cc; }

        /* Right Column: Pricing options, buy action */
        .right-col {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .product-meta-header {
            margin-bottom: 1.25rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1.25rem;
        }

        .category-tag {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .product-title {
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--text-main);
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }

        .trust-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .trust-stars {
            color: #d97706;
            display: flex;
            gap: 0.1rem;
        }

        /* Pricing & Slashed Row */
        .price-box-wrapper {
            background: #f8fafc;
            border-radius: var(--radius-md);
            padding: 1.25rem;
            margin-bottom: 1.5rem;
            border: 1px dashed var(--border-color);
        }

        .price-row {
            display: flex;
            align-items: baseline;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .active-price {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--text-main);
        }

        .slashed-price {
            font-size: 1rem;
            text-decoration: line-through;
            color: var(--text-dark);
        }

        .selected-desc {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Package Options selector */
        .options-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.75rem;
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
            margin-bottom: 1.75rem;
        }

        .option-item {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .option-item:hover {
            border-color: var(--primary);
            background: rgba(2, 132, 199, 0.01);
        }

        .option-item.selected {
            border-color: var(--primary);
            background: rgba(2, 132, 199, 0.03);
            box-shadow: 0 0 0 1px var(--primary);
        }

        .option-item.out-of-stock {
            opacity: 0.6;
            background: #f1f5f9;
            border-color: var(--border-color);
            cursor: not-allowed;
        }

        .option-item.out-of-stock:hover {
            border-color: var(--border-color);
            background: #f1f5f9;
        }

        .opt-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .opt-name::before {
            content: '';
            width: 14px;
            height: 14px;
            border: 1.5px solid var(--border-color);
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            transition: var(--transition);
        }

        .option-item.selected .opt-name::before {
            border-color: var(--primary);
            background: var(--primary);
            box-shadow: inset 0 0 0 2.5px white;
        }

        .opt-price {
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--text-main);
        }

        /* Quantity and Actions */
        .purchase-actions {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .btn-large {
            padding: 0.95rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: var(--radius-sm);
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
        }

        .btn-primary-large {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.2);
        }

        .btn-primary-large:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.3);
        }

        .btn-outline-large {
            background: white;
            border: 1.5px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline-large:hover {
            background: rgba(2, 132, 199, 0.03);
            transform: translateY(-1px);
        }

        /* Trust guarantees badge grid */
        .trust-badges {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
            border-top: 1px solid var(--border-color);
            padding-top: 1.5rem;
            margin-top: 1rem;
        }

        .badge-item {
            text-align: center;
        }

        .badge-item i {
            font-size: 1.25rem;
            color: var(--primary);
            margin-bottom: 0.35rem;
        }

        .badge-item p {
            font-size: 0.68rem;
            font-weight: 600;
            color: var(--text-muted);
            line-height: 1.3;
        }

        /* Related products section */
        .related-section {
            margin-top: 4rem;
        }

        .related-title {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--text-main);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.4rem;
        }

        .related-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 2.5rem;
            height: 3px;
            background: var(--primary);
            border-radius: var(--radius-full);
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .related-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            text-decoration: none;
            color: var(--text-main);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            box-shadow: var(--shadow-sm);
        }

        .related-card:hover {
            transform: translateY(-3px);
            border-color: var(--primary);
            box-shadow: var(--shadow-md);
        }

        .rel-media {
            background: var(--bg-body);
            border-radius: var(--radius-sm);
            padding: 2.5rem 1rem;
            text-align: center;
        }

        .rel-media i {
            font-size: 3rem;
        }

        .rel-cat {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--primary);
        }

        .rel-name {
            font-size: 0.85rem;
            font-weight: 700;
            line-height: 1.4;
            height: 2.4rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .rel-price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border-color);
            padding-top: 0.75rem;
            margin-top: 0.25rem;
        }

        .rel-price {
            font-weight: 800;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .rel-arrow {
            font-size: 0.78rem;
            color: var(--primary);
            font-weight: 700;
        }

        /* Detail tabs wrapper & styling */
        .detail-tabs-wrapper {
            margin-top: 3rem;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .tab-headers {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            border-bottom: 2px solid var(--bg-body);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
        }

        .tab-divider {
            width: 1.5px;
            height: 16px;
            background-color: var(--border-color);
        }

        .tab-btn {
            background: none;
            border: none;
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-dark);
            cursor: pointer;
            padding: 0.5rem 0;
            position: relative;
            transition: var(--transition);
            font-family: inherit;
        }

        .tab-btn:hover {
            color: var(--primary);
        }

        .tab-btn.active {
            color: var(--primary);
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -0.65rem;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary);
            border-radius: var(--radius-full);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Description Content styling */
        .desc-text {
            font-size: 0.92rem;
            color: var(--text-muted);
            line-height: 1.8;
        }

        .desc-text h4 {
            color: var(--text-main);
            font-size: 1.15rem;
            font-weight: 800;
            margin: 1.5rem 0 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .desc-text h4 i {
            color: var(--primary);
        }

        .desc-text p {
            margin-bottom: 1rem;
        }

        .desc-text ul {
            margin-bottom: 1.25rem;
            padding-left: 1.25rem;
            list-style-type: disc;
        }

        .desc-text ul li {
            margin-bottom: 0.5rem;
        }

        .desc-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .desc-table td, .desc-table th {
            border: 1px solid var(--border-color);
            padding: 0.85rem 1.1rem;
            font-size: 0.88rem;
        }

        .desc-table th {
            background: #f8fafc;
            font-weight: 700;
            color: var(--text-main);
            text-align: left;
        }

        .reviews-box {
            margin-top: 0;
        }

        .reviews-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .reviews-header h3 {
            font-size: 1.1rem;
            font-weight: 800;
        }

        .rev-aggregate {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .rev-big-num {
            font-size: 1.5rem;
            font-weight: 900;
        }

        .rev-item {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .rev-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .rev-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .rev-author {
            font-weight: 700;
            font-size: 0.85rem;
        }

        .rev-stars {
            color: #d97706;
            font-size: 0.75rem;
        }

        .rev-text {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Slide-out Cart Sidebar */
        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(4px);
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: var(--transition);
        }

        .cart-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }

        .cart-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            max-width: 400px;
            height: 100vh;
            background: #ffffff;
            box-shadow: -10px 0 30px rgba(15, 23, 42, 0.15);
            z-index: 1001;
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .cart-sidebar.show {
            transform: translateX(0);
        }

        .cart-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cart-header h3 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .cart-close-btn {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: var(--text-dark);
            transition: var(--transition);
        }

        .cart-close-btn:hover {
            color: var(--text-main);
        }

        .cart-items-container {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }

        .empty-cart-msg {
            text-align: center;
            color: var(--text-dark);
            font-size: 0.85rem;
            padding: 3rem 1rem;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border-color);
            position: relative;
        }

        .cart-item-icon {
            width: 2.2rem;
            height: 2.2rem;
            background: var(--bg-body);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-name {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.25rem;
        }

        .cart-item-price {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.4rem;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .qty-btn {
            width: 1.35rem;
            height: 1.35rem;
            border: 1px solid var(--border-color);
            background: white;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            transition: var(--transition);
        }

        .qty-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .qty-val {
            font-size: 0.78rem;
            font-weight: 700;
            min-width: 1.25rem;
            text-align: center;
        }

        .remove-item-btn {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            font-size: 0.85rem;
            padding: 0.25rem;
            transition: var(--transition);
        }

        .remove-item-btn:hover {
            color: #b91c1c;
        }

        .cart-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            background: #f8fafc;
        }

        .cart-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .total-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-muted);
        }

        .total-val {
            font-size: 1.15rem;
            font-weight: 900;
            color: var(--text-main);
        }

        .checkout-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.85rem;
            border-radius: var(--radius-sm);
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.15);
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .checkout-btn:hover {
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.25);
            transform: translateY(-1px);
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

        /* Fake Live Sales Notification Popup */
        .live-sale-popup {
            position: fixed;
            bottom: 1.5rem;
            left: 1.5rem;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            z-index: 998;
            transform: translateY(150px);
            opacity: 0;
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.4s ease;
            max-width: 320px;
        }

        .live-sale-popup.show {
            transform: translateY(0);
            opacity: 1;
        }

        .buyer-avatar {
            width: 2.2rem;
            height: 2.2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 700;
            color: white;
        }

        .buyer-info {
            font-size: 0.75rem;
            line-height: 1.4;
            color: var(--text-muted);
        }

        .buyer-name {
            font-weight: 700;
            color: var(--text-main);
        }

        .bought-item {
            color: var(--primary);
            font-weight: 600;
        }

        .time-ago {
            display: block;
            font-size: 0.65rem;
            color: var(--text-dark);
            margin-top: 0.15rem;
        }

        /* Footer design */
        footer {
            background: #0f172a;
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
            text-decoration: none;
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

        /* Responsive */
        @media (max-width: 900px) {
            .details-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .left-col {
                position: relative;
                top: 0;
            }
            .related-grid {
                grid-template-columns: 1fr;
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
    </style>
</head>
<body>

    <!-- Top Promotion Bar -->
    <div class="top-ticker">
        <i class="fa-solid fa-bolt"></i>
        <span>Flash Sale: Nhập mã <strong>AI2026</strong> giảm ngay 20% cho tất cả tài khoản!</span>
    </div>

    <!-- Header Area -->
    <header>
        <div class="container">
            <div class="navbar">
                <a href="/" class="logo">
                    <i class="fa-solid fa-rocket logo-icon"></i>
                    <span>AI CỦA TÔI</span>
                </a>

                <div class="nav-actions">
                    <a href="/products" class="action-icon-btn" title="Cửa hàng"><i class="fa-solid fa-store"></i></a>
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
                    <button class="action-icon-btn" id="open-cart-btn" title="Giỏ hàng">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="badge" id="cart-count">0</span>
                    </button>
                </div>
            </div>

            <!-- Categories pills in Header -->
            <div class="cat-nav-bar">
                <a href="/products?category=all" class="cat-pill"><i class="fa-solid fa-border-all"></i> Tất Cả</a>
                <a href="/products?category=gpt" class="cat-pill"><i class="fa-solid fa-brain"></i> Chat Gpt</a>
                <a href="/products?category=gemini" class="cat-pill"><i class="fa-brands fa-google"></i> Gemini</a>
                <a href="/products?category=capcut" class="cat-pill"><i class="fa-solid fa-video"></i> CapCut Pro</a>
                <a href="/products?category=canva" class="cat-pill"><i class="fa-solid fa-palette"></i> Canva</a>
                <a href="/products?category=other" class="cat-pill"><i class="fa-solid fa-cubes"></i> Sản Phẩm Khác</a>
                <a href="https://zalo.me" target="_blank" class="cat-pill" style="color: var(--primary); font-weight: 600;"><i class="fa-solid fa-phone"></i> Liên Hệ</a>
            </div>
        </div>
    </header>

    <main class="container">
        <!-- Breadcrumb navigation -->
        <div class="breadcrumb">
            <a href="/">Trang Chủ</a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="/products?category={{ $product['category'] }}">{{ $product['category_label'] }}</a>
            <i class="fa-solid fa-angle-right"></i>
            <span>{{ $product['name'] }}</span>
        </div>

        <div class="details-grid">
            <!-- Left Column: Image Spec highlights -->
            <div class="left-col">
                <div class="media-box" style="display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 2rem; height: 320px; background: #ffffff; border: 1px solid var(--border-color); border-radius: var(--radius-lg); position: relative;">
                    @if($product['tag'])
                        <span class="sale-badge">{{ $product['tag'] }}</span>
                    @endif
                    @if($product->image_path)
                        <img src="{{ asset($product->image_path) }}" alt="{{ $product['name'] }}" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 8px;">
                    @else
                        <i class="fa-solid {{ strtok($product['icon'], ' ') }}" style="font-size: 6rem; color: var(--primary);"></i>
                    @endif
                </div>

                <div class="quick-specs-box">
                    <h3>Tính Năng Nổi Bật</h3>
                    <ul class="spec-list">
                        @foreach ($product['features'] as $feat)
                            <li><i class="fa-solid fa-circle-check"></i> {{ $feat }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Right Column: Package select, active price details -->
            <div class="right-col">
                <div class="product-meta-header">
                    <span class="category-tag">{{ $product['category_label'] }}</span>
                    <h1 class="product-title">{{ $product['name'] }}</h1>
                    <div class="trust-row">
                        <div class="trust-stars">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <span>| Đã bán {{ $product['sold'] }} sản phẩm</span>
                    </div>
                </div>

                <!-- Price display card -->
                <div class="price-box-wrapper">
                    <div class="price-row">
                        <span class="active-price" id="display-price">250.000₫</span>
                        <span class="slashed-price" id="display-slashed">600.000₫</span>
                    </div>
                    <p class="selected-desc" id="display-desc">Vui lòng chọn một gói cước nâng cấp bên dưới.</p>
                </div>

                <!-- Options -->
                <div>
                    <h3 class="options-title">Chọn Gói Bản Quyền:</h3>
                    <div class="options-grid">
                        @php
                            $defaultSelectedIdx = -1;
                            // Find the first option that is in stock to set as default
                            foreach ($product['options'] as $idx => $opt) {
                                $isOutOfStock = isset($opt['in_stock']) && $opt['in_stock'] === false;
                                if (!$isOutOfStock) {
                                    $defaultSelectedIdx = $idx;
                                    break;
                                }
                            }
                        @endphp
                        @foreach ($product['options'] as $idx => $opt)
                            @php
                                $isOutOfStock = isset($opt['in_stock']) && $opt['in_stock'] === false;
                            @endphp
                            <div class="option-item {{ $isOutOfStock ? 'out-of-stock' : '' }} {{ $idx === $defaultSelectedIdx ? 'selected' : '' }}" 
                                 data-id="{{ $opt['id'] }}" 
                                 data-name="{{ $opt['name'] }}" 
                                 data-price="{{ $opt['price'] }}" 
                                 data-slashed="{{ $opt['slashed'] }}" 
                                 data-desc="{{ $opt['description'] }}"
                                 @if(!$isOutOfStock) onclick="selectOption(this)" @endif>
                                <span class="opt-name">{{ $opt['name'] }} @if($isOutOfStock) <strong style="color: #ef4444; font-size: 0.75rem; margin-left: 0.25rem;">(Hết hàng)</strong> @endif</span>
                                <span class="opt-price" @if($isOutOfStock) style="text-decoration: line-through; color: var(--text-dark);" @endif>{{ number_format($opt['price'], 0, ',', '.') }}₫</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                @php
                    $isAllOutOfStock = true;
                    foreach ($product['options'] as $opt) {
                        if (!isset($opt['in_stock']) || $opt['in_stock'] !== false) {
                            $isAllOutOfStock = false;
                            break;
                        }
                    }
                @endphp
                <!-- Purchase actions -->
                <div class="purchase-actions">
                    @if($isAllOutOfStock)
                        <button class="btn-large btn-primary-large" style="background: #94a3b8; border-color: #cbd5e1; cursor: not-allowed; width: 100%;" disabled>
                            <i class="fa-solid fa-ban"></i> Sản Phẩm Hết Hàng
                        </button>
                    @else
                        <button class="btn-large btn-primary-large" onclick="handleAddToCart()">
                            <i class="fa-solid fa-bolt"></i> Mua Ngay
                        </button>
                    @endif
                </div>

                <!-- Small trust badges inside right col -->
                <div class="trust-badges">
                    <div class="badge-item">
                        <i class="fa-solid fa-shield-halved"></i>
                        <p>100% Chính Chủ</p>
                    </div>
                    <div class="badge-item">
                        <i class="fa-solid fa-user-shield"></i>
                        <p>Bảo Hành Trọn Gói</p>
                    </div>
                    <div class="badge-item">
                        <i class="fa-solid fa-clock"></i>
                        <p>Auto Duyệt 30s</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Section: Description (First), Reviews (Second) -->
        <div class="detail-tabs-wrapper">
            <div class="tab-headers">
                <button class="tab-btn active" id="btn-desc" onclick="switchTab('desc')">Mô Tả Chi Tiết</button>
                <div class="tab-divider"></div>
                <button class="tab-btn" id="btn-reviews" onclick="switchTab('reviews')">Đánh Giá</button>
            </div>

            <!-- Tab 1: Product Description -->
            <div class="tab-content active" id="tab-desc">
                <div class="desc-text">
                    {!! $product->description !!}
                </div>
            </div>

            <!-- Tab 2: Customer Reviews -->
            <div class="tab-content" id="tab-reviews">
                <div class="reviews-box">
                    <div class="reviews-header">
                        <h3>Đánh Giá Của Khách Hàng</h3>
                        <div class="rev-aggregate">
                            <span class="rev-big-num">{{ $product['rating'] }}</span>
                            <div>
                                <div class="rev-stars">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                </div>
                                <span style="font-size: 0.72rem; color: var(--text-dark);">Dựa trên {{ $product['review_count'] }} đánh giá</span>
                            </div>
                        </div>
                    </div>

                    <div class="reviews-list">
                        @if($product['category'] === 'capcut')
                            <div class="rev-item">
                                <div class="rev-meta">
                                    <span class="rev-author">Nguyễn Hoàng Long</span>
                                    <span class="rev-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                                </div>
                                <p class="rev-text">Đã nâng cấp thành công trên email chính chủ cá nhân. Mọi hiệu ứng Pro và chuyển cảnh VIP chạy mượt mà trên cả máy tính Mac và điện thoại iPhone của mình.</p>
                            </div>
                            <div class="rev-item">
                                <div class="rev-meta">
                                    <span class="rev-author">Lê Thuỳ Trang (Tiktok Creator)</span>
                                    <span class="rev-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                                </div>
                                <p class="rev-text">Shop bàn giao tài khoản siêu tốc luôn, chưa đầy 1 phút sau thanh toán đã nhận được email báo nâng cấp thành công. Sẽ tiếp tục ủng hộ lâu dài.</p>
                            </div>
                        @elseif($product['category'] === 'gpt')
                            <div class="rev-item">
                                <div class="rev-meta">
                                    <span class="rev-author">Phạm Minh Đức (Developer)</span>
                                    <span class="rev-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                                </div>
                                <p class="rev-text">Tài khoản Plus dùng siêu ổn định, viết code và phân tích sơ đồ rất nhanh. Giá rẻ hơn nhiều so với tự mua trực tiếp bằng thẻ visa.</p>
                            </div>
                        @else
                            <div class="rev-item">
                                <div class="rev-meta">
                                    <span class="rev-author">Trần Anh Tuấn</span>
                                    <span class="rev-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                                </div>
                                <p class="rev-text">Giao dịch nhanh chóng, nhân viên hỗ trợ nhiệt tình qua zalo kích hoạt chỉ 30 giây. Rất hài lòng về chất lượng phục vụ.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Related products section -->
        <section class="related-section">
            <h2 class="related-title">Sản Phẩm Đề Xuất Liên Quan</h2>
            <div class="related-grid">
                @foreach ($related as $rel)
                    <a href="/product/{{ $rel['slug'] }}" class="related-card">
                        <div class="rel-media">
                            <i class="fa-solid {{ $rel['icon'] }}"></i>
                        </div>
                        <div>
                            <span class="rel-cat">{{ $rel['category_label'] }}</span>
                            <h4 class="rel-name">{{ $rel['name'] }}</h4>
                        </div>
                        <div class="rel-price-row">
                            <span class="rel-price">{{ number_format($rel['default_price'], 0, ',', '.') }}₫</span>
                            <span class="rel-arrow">Xem chi tiết <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </main>

    <!-- Slide-out Cart Sidebar -->
    <div class="cart-overlay" id="cart-overlay"></div>
    <div class="cart-sidebar" id="cart-sidebar">
        <div class="cart-header">
            <h3><i class="fa-solid fa-shopping-cart" style="color: var(--primary);"></i> Giỏ Hàng Của Bạn</h3>
            <button class="cart-close-btn" id="close-cart-btn"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="cart-items-container" id="cart-items-wrapper">
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

    <!-- Toast Notification -->
    <div class="toast-notify" id="toast-notify">
        <i class="fa-solid fa-circle-check" style="color: var(--success); font-size: 1.1rem;"></i>
        <span id="toast-message">Đã thêm vào giỏ hàng thành công!</span>
    </div>

    <!-- Live sale popup notification -->
    <div class="live-sale-popup" id="live-sale-popup">
        <div class="buyer-avatar" id="live-avatar">H</div>
        <div class="buyer-info">
            <div>Khách hàng <span class="buyer-name" id="live-name">Nguyễn Văn A</span></div>
            <div>Đã mua <span class="bought-item" id="live-item">CapCut Pro Gói 1 Năm</span></div>
            <span class="time-ago" id="live-time">30 giây trước</span>
        </div>
    </div>

    <!-- Footer Area -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col" style="grid-column: span 1.5;">
                    <a href="/" class="logo" style="margin-bottom: 1rem; display: inline-flex;">
                        <i class="fa-solid fa-rocket logo-icon" style="filter: none;"></i>
                        <span style="color: white;">AI CỦA TÔI</span>
                    </a>
                    <p style="font-size: 0.8rem; color: #94a3b8; line-height: 1.6; max-width: 280px;">
                        Hệ thống cung cấp dịch vụ nâng cấp tài khoản số, phần mềm đồ họa, thiết kế và AI hàng đầu Việt Nam. Tự động - Uy tín - Giá rẻ.
                    </p>
                    <div class="footer-socials">
                        <a href="#" class="social-circle"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-circle"><i class="fa-brands fa-telegram"></i></a>
                        <a href="#" class="social-circle"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Sản Phẩm</h4>
                    <div class="footer-links">
                        <a href="/product/capcut">Tài khoản CapCut Pro</a>
                        <a href="/product/chatgpt">Tài khoản ChatGPT Plus</a>
                        <a href="/product/gemini">Tài khoản Google Gemini</a>
                        <a href="/product/canva">Canva Pro Nâng Cấp</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Dịch Vụ & Hỗ Trợ</h4>
                    <div class="footer-links">
                        <a href="#">Chính sách bảo hành</a>
                        <a href="#">Hướng dẫn thanh toán</a>
                        <a href="#">Liên hệ hỗ trợ Zalo</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; {{ date('Y') }} AI CỦA TÔI. Nền tảng phân phối dịch vụ số hàng đầu.
            </div>
        </div>
    </footer>

    <!-- Interactive script logic -->
    <script>
        // Tab switching function
        function switchTab(tabId) {
            // Remove active classes
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            // Add active class to targets
            if (tabId === 'desc') {
                document.getElementById('btn-desc').classList.add('active');
                document.getElementById('tab-desc').classList.add('active');
            } else if (tabId === 'reviews') {
                document.getElementById('btn-reviews').classList.add('active');
                document.getElementById('tab-reviews').classList.add('active');
            }
        }

        // State variables
        let cart = [];
        let selectedOption = null;
        const productIcon = "{{ $product['icon'] }}";

        // DOM elements
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
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
        }

        // Functions: Select package option
        function selectOption(el) {
            // Deselect previous
            document.querySelectorAll('.option-item').forEach(item => {
                item.classList.remove('selected');
            });
            // Select active
            el.classList.add('selected');

            // Read dataset attributes
            const id = el.getAttribute('data-id');
            const name = el.getAttribute('data-name');
            const price = parseInt(el.getAttribute('data-price'));
            const slashed = parseInt(el.getAttribute('data-slashed'));
            const desc = el.getAttribute('data-desc');

            // Save active package
            selectedOption = { id, name, price, icon: productIcon };

            // Update UI displays
            document.getElementById('display-price').innerText = formatVND(price);
            document.getElementById('display-slashed').innerText = formatVND(slashed);
            document.getElementById('display-desc').innerText = desc;
        }

        // Cart Actions
        function openCart() {
            cartSidebar.classList.add('show');
            cartOverlay.classList.add('show');
        }

        function closeCart() {
            cartSidebar.classList.remove('show');
            cartOverlay.classList.remove('show');
        }

        // Save and Load Cart from LocalStorage
        function saveCart() {
            localStorage.setItem('capcut_store_cart', JSON.stringify(cart));
        }

        function loadCart() {
            const saved = localStorage.getItem('capcut_store_cart');
            if (saved) {
                try {
                    cart = JSON.parse(saved);
                } catch(e) {
                    cart = [];
                }
            }
            renderCart();
        }

        // Render Cart elements in sidebar
        function renderCart() {
            if (cart.length === 0) {
                cartItemsWrapper.innerHTML = '<div class="empty-cart-msg">Giỏ hàng đang trống. Hãy chọn những dịch vụ số sịn nhất nhé!</div>';
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
                html += `
                    <div class="cart-item">
                        <div class="cart-item-icon">
                            <i class="fa-solid ${item.icon}"></i>
                        </div>
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
        }

        // Add package to Cart
        function addToCart(id, name, price, icon) {
            const existingIndex = cart.findIndex(item => item.id === id);
            if (existingIndex > -1) {
                cart[existingIndex].quantity += 1;
            } else {
                cart.push({ id, name, price, icon, quantity: 1 });
            }
            saveCart();
            renderCart();
            showToast(`Đã thêm "${name}" vào giỏ hàng thành công!`);
            openCart();
        }

        // Action handles from UI buttons
        function handleAddToCart() {
            if (!selectedOption) {
                showToast("Vui lòng chọn một gói cước nâng cấp!");
                return;
            }
            addToCart(selectedOption.id, selectedOption.name, selectedOption.price, selectedOption.icon);
        }

        function handleBuyNow() {
            if (!selectedOption) {
                showToast("Vui lòng chọn một gói cước nâng cấp!");
                return;
            }
            addToCart(selectedOption.id, selectedOption.name, selectedOption.price, selectedOption.icon);
            // Instant redirection to checkout mock or trigger order process
            setTimeout(() => {
                alert(`Hệ thống đang chuyển hướng bạn tới cổng thanh toán quét mã QR cho đơn hàng: ${selectedOption.name} - Giá: ${formatVND(selectedOption.price)}.`);
            }, 500);
        }

        // Global functions for cart modifications
        window.removeFromCart = function(index) {
            cart.splice(index, 1);
            saveCart();
            renderCart();
        };

        window.updateQty = function(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            saveCart();
            renderCart();
        };

        function showToast(msg) {
            toastMessage.innerText = msg;
            toastNotify.classList.add('show');
            setTimeout(() => {
                toastNotify.classList.remove('show');
            }, 3000);
        }

        // Fake Live Sales Popup Logic
        const customers = ["Nguyễn Hữu Minh", "Trần Khánh Vy", "Đặng Hoàng Giang", "Lê Gia Bảo", "Phạm Quỳnh Anh", "Vũ Huy Hoàng", "Đỗ Mai Chi"];
        const productsBought = [
            { name: "CapCut Pro 1 Năm", option: "capcut-1y" },
            { name: "ChatGPT Plus 1 Tháng", option: "chatgpt-1m" },
            { name: "Canva Pro Trọn Đời", option: "canva-life" },
            { name: "Gemini Advanced 5TB", option: "gemini-1m" },
            { name: "CapCut Pro Trọn Đời", option: "capcut-life" }
        ];

        function triggerLiveSale() {
            const randomCust = customers[Math.floor(Math.random() * customers.length)];
            const randomProd = productsBought[Math.floor(Math.random() * productsBought.length)];
            const randomSeconds = Math.floor(Math.random() * 50) + 10;
            
            document.getElementById('live-avatar').innerText = randomCust.charAt(0);
            document.getElementById('live-name').innerText = randomCust;
            document.getElementById('live-item').innerText = randomProd.name;
            document.getElementById('live-time').innerText = `${randomSeconds} giây trước`;
            
            const popup = document.getElementById('live-sale-popup');
            popup.classList.add('show');
            
            setTimeout(() => {
                popup.classList.remove('show');
            }, 5000);
        }

        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', () => {
            loadCart();

            // Setup default selected option on page load
            const defaultSelected = document.querySelector('.option-item.selected');
            if (defaultSelected) {
                selectOption(defaultSelected);
            }

            openCartBtn.addEventListener('click', openCart);
            closeCartBtn.addEventListener('click', closeCart);
            cartOverlay.addEventListener('click', closeCart);

            document.getElementById('checkout-btn').addEventListener('click', () => {
                if (cart.length === 0) {
                    showToast("Giỏ hàng của bạn đang trống!");
                    return;
                }
                window.location.href = '/checkout';
            });

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

            // Trigger live sale notification popup loop
            setTimeout(triggerLiveSale, 6000);
            setInterval(triggerLiveSale, 18000);
        });
    </script>
</body>
</html>
