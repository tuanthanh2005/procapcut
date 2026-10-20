<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>AI CỦA TÔI | Nền Tảng Phân Phối Tài Nguyên & Tài Khoản AI Bản Quyền Hàng Đầu</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta name="description" content="Chuyên cung cấp tài nguyên AI cao cấp: ChatGPT Plus, Claude 3.5 Sonnet, Midjourney v6, Google Gemini Advanced, Cursor Pro, CapCut Pro bản quyền. Hệ thống kích hoạt tự động 30s, bảo hành 1 đổi 1.">
    <meta name="keywords" content="tài nguyên ai, mua chatgpt plus, mua claude pro, mua midjourney, mua capcut pro, mua canva pro, cursor pro giá rẻ, tài khoản ai uy tín">
    <link rel="canonical" href="{{ request()->url() }}">
    
    <!-- JSON-LD Structured Data Schema for SEO -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@graph": [
            {
                "@type": "WebSite",
                "@id": "{{ url('/') }}/#website",
                "url": "{{ url('/') }}",
                "name": "AI CỦA TÔI",
                "description": "Nền tảng phân phối tài nguyên AI, tài khoản trí tuệ nhân tạo và Premium Tools bản quyền số 1 Việt Nam.",
                "publisher": {
                    "@id": "{{ url('/') }}/#organization"
                }
            },
            {
                "@type": "Organization",
                "@id": "{{ url('/') }}/#organization",
                "name": "AI CỦA TÔI",
                "url": "{{ url('/') }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset('logo.png') }}",
                    "caption": "AI CỦA TÔI Logo"
                },
                "sameAs": [
                    "https://zalo.me/0569012134",
                    "https://t.me/specademy"
                ]
            },
            {
                "@type": "FAQPage",
                "@id": "{{ url('/') }}/#faq",
                "mainEntity": [
                    {
                        "@type": "Question",
                        "name": "Làm thế nào để nâng cấp tài khoản AI bản quyền chính chủ?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Bạn chỉ cần chọn gói tài nguyên AI cần nâng cấp (ChatGPT, Claude, CapCut, Canva, Gemini), nhập email của bạn và hoàn tất thanh toán SePay tự động. Hệ thống sẽ kích hoạt chỉ sau 30 giây."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "Chính sách bảo hành tài khoản AI tại shop như thế nào?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "AI CỦA TÔI bảo hành 1 đổi 1 trọn vòng đời sử dụng cho toàn bộ các tài khoản AI, hỗ trợ kỹ thuật 24/7 qua Zalo và Hotline."
                        }
                    }
                ]
            }
        ]
    }
    </script>
    
    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            /* Clean Light Tech & High-Trust Design System */
            --bg-body: #f8fafc; /* Crisp clean slate */
            --bg-surface: #ffffff;
            --bg-nav: rgba(255, 255, 255, 0.94);
            --bg-card: #ffffff;
            --bg-card-hover: #ffffff;
            --bg-glass: rgba(15, 23, 42, 0.03);
            --bg-glass-hover: rgba(15, 23, 42, 0.06);
            
            --primary: #0284c7; /* Trustworthy Deep Sky Blue */
            --primary-hover: #0369a1;
            --primary-rgb: 2, 132, 199;
            --primary-glow: rgba(2, 132, 199, 0.18);
            
            --secondary: #4f46e5; /* Tech Indigo */
            --secondary-rgb: 79, 70, 229;
            --secondary-glow: rgba(79, 70, 229, 0.18);
            
            --accent: #f43f5e; /* Hot Tag Coral */
            --accent-glow: rgba(244, 63, 94, 0.2);
            
            --success: #059669; /* Emerald Green */
            --warning: #d97706; /* Amber */
            --danger: #dc2626; /* Crimson */
            
            --text-main: #0f172a; /* Slate 900 - Ultra Sharp & Clear */
            --text-muted: #475569; /* Slate 600 */
            --text-dark: #94a3b8; /* Slate 400 */
            
            --border-color: #e2e8f0; /* Crisp soft slate border */
            --border-hover: #0284c7;
            
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-full: 9999px;
            
            --transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.2s ease, background-color 0.2s ease, color 0.2s ease;
            --shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.06), 0 1px 2px rgba(15, 23, 42, 0.04);
            --shadow-md: 0 10px 25px -5px rgba(15, 23, 42, 0.06), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
            --shadow-lg: 0 20px 35px -10px rgba(15, 23, 42, 0.1), 0 0 1px rgba(0, 0, 0, 0.08);
        }

        html {
            scroll-behavior: smooth;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-body);
            background-image: radial-gradient(circle at 50% 0%, rgba(2, 132, 199, 0.06) 0%, transparent 60%);
            background-repeat: no-repeat;
            background-size: 100% 700px;
            color: var(--text-main);
            line-height: 1.55;
            overflow-x: hidden;
            position: relative;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        /* Performance boost: hardware acceleration & offscreen section containment */
        .product-card,
        .trust-card {
            transform: translateZ(0);
            backface-visibility: hidden;
        }

        .vs-wrapper,
        .comparison-wrapper,
        .warranty-section,
        .faqs-section,
        footer {
            content-visibility: auto;
            contain-intrinsic-size: 1px 400px;
        }

        .marquee-content {
            will-change: transform;
            transform: translate3d(0, 0, 0);
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
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Top Sale Ticker */
        .top-ticker {
            background: linear-gradient(90deg, #0284c7 0%, #0369a1 50%, #0284c7 100%);
            color: white;
            padding: 0.45rem 0;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            position: relative;
            z-index: 101;
            overflow: hidden;
            display: flex;
            align-items: center;
            height: 36px;
            box-shadow: 0 2px 8px rgba(2, 132, 199, 0.15);
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
            gap: 3.5rem;
            animation: marquee 32s linear infinite;
            padding-right: 3.5rem;
        }

        .marquee-content span {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            white-space: nowrap;
            color: rgba(255, 255, 255, 0.95);
            font-size: 0.78rem;
        }

        .marquee-content span strong {
            color: #fef08a; /* Bright clear yellow */
            font-family: 'JetBrains Mono', monospace;
            background: rgba(0, 0, 0, 0.15);
            padding: 0.15rem 0.45rem;
            border-radius: 4px;
        }

        .marquee-badge {
            background: #ffffff;
            color: #0284c7;
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-100%); }
        }

        /* Header Area */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
            padding: 0.75rem 0;
            transform: translateZ(0);
            will-change: transform;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
            color: var(--text-main);
            position: relative;
        }

        .logo-symbol {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px var(--primary-glow);
            color: #ffffff;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .logo-text {
            color: #0f172a;
            font-weight: 900;
            letter-spacing: -0.5px;
        }

        .logo-tag {
            font-size: 0.6rem;
            padding: 0.1rem 0.35rem;
            border-radius: 4px;
            background: #e0f2fe;
            color: var(--primary);
            border: 1px solid #bae6fd;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            vertical-align: middle;
            margin-left: 0.3rem;
        }

        /* Nav Pills (Categories) */
        .cat-nav-bar {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .cat-pill {
            padding: 0.42rem 0.85rem;
            border-radius: var(--radius-full);
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-muted);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.45rem;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .cat-pill:hover {
            color: var(--primary);
            background: #f1f5f9;
        }

        .cat-pill.active {
            color: var(--primary);
            background: #e0f2fe;
            border-color: #bae6fd;
            font-weight: 700;
        }

        /* Search input */
        .search-wrapper {
            position: relative;
            flex: 1;
            max-width: 280px;
        }

        .search-input {
            width: 100%;
            height: 2.45rem;
            padding: 0 2.4rem 0 0.95rem;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-full);
            color: var(--text-main);
            font-size: 0.82rem;
            outline: none;
            transition: var(--transition);
            font-family: inherit;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.12);
        }

        .search-input::placeholder {
            color: var(--text-dark);
        }

        .search-btn {
            position: absolute;
            right: 0.6rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-btn:hover {
            color: var(--primary);
        }

        /* Nav actions */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .action-icon-btn {
            width: 2.45rem;
            height: 2.45rem;
            border-radius: var(--radius-full);
            background: #ffffff;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            font-size: 0.95rem;
            box-shadow: var(--shadow-sm);
        }

        .action-icon-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
        }

        .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: linear-gradient(135deg, var(--accent), #e11d48);
            color: white;
            font-size: 0.65rem;
            font-weight: 800;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'JetBrains Mono', monospace;
            box-shadow: 0 2px 6px rgba(244, 63, 94, 0.3);
        }

        /* Hero Banner Centered & Compact */
        .hero-banner {
            margin-top: 1.25rem;
            margin-bottom: 2rem;
            border-radius: var(--radius-lg);
            background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
            border: 1px solid #bae6fd;
            padding: 2.75rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px -10px rgba(2, 132, 199, 0.08), 0 0 1px rgba(0, 0, 0, 0.05);
        }

        .hero-banner-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            opacity: 0.65;
        }

        .hero-text {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.95rem;
            border-radius: var(--radius-full);
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            color: #0369a1;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 1.15rem;
            font-family: 'JetBrains Mono', monospace;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.08);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #0284c7;
            box-shadow: 0 0 8px rgba(2, 132, 199, 0.6);
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.8); }
        }

        .hero-text h1 {
            font-size: 2.45rem;
            font-weight: 850;
            line-height: 1.3;
            margin-bottom: 1rem;
            letter-spacing: -0.6px;
            color: #0f172a;
            text-align: center;
            max-width: 880px;
        }

        .hero-text h1 .highlight-ai {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 40%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-text p {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.65rem;
            max-width: 820px;
            text-align: center;
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            padding: 0.75rem 1.6rem;
            border-radius: var(--radius-full);
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.25);
            font-weight: 800;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.35);
            color: #ffffff;
        }

        .btn-outline {
            background: #ffffff;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            box-shadow: var(--shadow-sm);
        }

        .btn-outline:hover {
            background: #f8fafc;
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* Hero Right: Showcase Grid */
        .hero-showcase {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            position: relative;
            z-index: 2;
        }

        .showcase-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.1rem;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }

        .showcase-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary);
            box-shadow: 0 15px 30px -5px rgba(2, 132, 199, 0.15);
        }

        .showcase-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.65rem;
        }

        .showcase-icon-wrapper {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--primary);
        }

        .showcase-icon-wrapper svg {
            width: 20px;
            height: 20px;
        }

        .showcase-title {
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .showcase-meta {
            font-size: 0.7rem;
            color: var(--text-dark);
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.5px;
        }

        .showcase-desc {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            min-height: 2rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .showcase-price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.55rem;
            border-top: 1px solid #f1f5f9;
        }

        .showcase-price {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--primary);
        }

        .showcase-badge {
            font-size: 0.68rem;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        /* AI Brands Marquee Bar */
        .ai-ecosystem-bar {
            margin-bottom: 3.5rem;
            padding: 1.5rem 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            background: #ffffff;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
        }

        .ai-bar-title {
            text-align: center;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-dark);
            margin-bottom: 1.25rem;
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
        }

        .ai-brands-track {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .ai-brand-pill {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-full);
            background: #f8fafc;
            border: 1px solid var(--border-color);
            color: #334155;
            font-size: 0.82rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .ai-brand-pill:hover {
            background: #f0f9ff;
            border-color: #bae6fd;
            color: var(--primary);
            transform: translateY(-2px);
        }

        .ai-brand-pill svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* Trust Badges Grid */
        .trust-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 3.5rem;
        }

        .trust-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.4rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .trust-card:hover {
            transform: translateY(-3px);
            border-color: var(--primary);
            box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.12);
        }

        .trust-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .trust-info h3 {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.3rem;
        }

        .trust-info p {
            font-size: 0.78rem;
            color: var(--text-muted);
            line-height: 1.45;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 1.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title-line {
            display: inline-block;
            width: 4px;
            height: 1.3rem;
            border-radius: 2px;
            background: linear-gradient(180deg, var(--primary), var(--secondary));
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 4rem;
        }

        .product-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            position: relative;
            box-shadow: var(--shadow-sm);
        }

        .product-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 15px 35px -5px rgba(2, 132, 199, 0.15);
        }

        .product-sale-tag {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            background: linear-gradient(135deg, var(--accent), #e11d48);
            color: white;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            z-index: 5;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
            box-shadow: 0 2px 6px rgba(244, 63, 94, 0.25);
        }

        .product-media {
            width: 100%;
            height: 170px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }

        .product-media img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-media img {
            transform: scale(1.06);
        }

        .product-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .product-cat {
            font-size: 0.7rem;
            color: var(--primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 0.4rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .product-name {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            line-height: 1.4;
            min-height: 2.6rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-trust {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .stars {
            color: #f59e0b;
            font-size: 0.75rem;
            display: flex;
            gap: 1px;
        }

        .sold-count {
            font-size: 0.72rem;
            color: var(--text-dark);
            font-family: 'JetBrains Mono', monospace;
        }

        .product-specs {
            margin-bottom: 1rem;
            font-size: 0.78rem;
            color: var(--text-muted);
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .product-specs li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .product-specs li i {
            color: var(--success);
            font-size: 0.75rem;
        }

        .product-footer {
            margin-top: auto;
            padding-top: 0.85rem;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .price-group {
            display: flex;
            flex-direction: column;
        }

        .price-slashed {
            font-size: 0.72rem;
            color: var(--text-dark);
            text-decoration: line-through;
            font-family: 'JetBrains Mono', monospace;
        }

        .price-active {
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            font-family: 'JetBrains Mono', monospace;
        }

        .btn-add-cart {
            width: 2.45rem;
            height: 2.45rem;
            border-radius: var(--radius-sm);
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .btn-add-cart:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            transform: scale(1.05);
            box-shadow: 0 4px 12px var(--primary-glow);
        }

        /* VS Performance Section */
        .vs-wrapper {
            margin-bottom: 4.5rem;
        }

        .vs-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 1.25rem;
        }

        .vs-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }

        .vs-card.negative {
            border-top: 4px solid var(--danger);
            background: radial-gradient(circle at top left, rgba(220, 38, 38, 0.02), transparent 60%), #ffffff;
        }

        .vs-card.positive {
            border-top: 4px solid var(--primary);
            background: radial-gradient(circle at top left, rgba(2, 132, 199, 0.04), transparent 60%), #ffffff;
            box-shadow: 0 10px 30px -5px rgba(2, 132, 199, 0.1);
        }

        .vs-header {
            font-size: 1.15rem;
            font-weight: 800;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .vs-card.negative .vs-header { color: #dc2626; }
        .vs-card.positive .vs-header { color: var(--primary); }

        .vs-list {
            display: flex;
            flex-direction: column;
            gap: 0.95rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .vs-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            line-height: 1.5;
        }

        .vs-card.negative .vs-list li i {
            color: var(--danger);
            margin-top: 0.2rem;
        }

        .vs-card.positive .vs-list li i {
            color: var(--primary);
            margin-top: 0.2rem;
        }

        .vs-card.positive .vs-list strong {
            color: #0f172a;
        }

        /* Comparison Table */
        .comparison-wrapper {
            margin-bottom: 4.5rem;
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            background: #ffffff;
            box-shadow: var(--shadow-sm);
        }

        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.85rem;
        }

        .comparison-table th, .comparison-table td {
            padding: 1.1rem 1.4rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .comparison-table th {
            background: #f8fafc;
            color: #475569;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'JetBrains Mono', monospace;
        }

        .comp-ours {
            background: #f0f9ff !important;
            color: var(--text-main);
            font-weight: 600;
        }

        .badge-check {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--primary);
            font-weight: 700;
        }

        .badge-cross {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--danger);
            font-weight: 600;
        }

        /* Warranty Section */
        .warranty-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
            border: 1px solid #bae6fd;
            border-radius: var(--radius-lg);
            padding: 3rem 2rem;
            margin-bottom: 4.5rem;
            box-shadow: var(--shadow-sm);
        }

        .warranty-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.75rem;
        }

        .warranty-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius-md);
            padding: 1.75rem;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .warranty-card:hover {
            transform: translateY(-3px);
            border-color: var(--primary);
            box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.15);
        }

        .warranty-card .w-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
            display: inline-block;
        }

        .warranty-card h3 {
            font-size: 1.05rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.6rem;
        }

        .warranty-card p {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.55;
        }

        /* FAQ Section */
        .faqs-section {
            margin-bottom: 4.5rem;
        }

        .faq-grid {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            max-width: 860px;
            margin: 1.75rem auto 0;
        }

        .faq-item {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .faq-item.active {
            border-color: var(--primary);
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.1);
        }

        .faq-question {
            padding: 1.15rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--text-main);
            user-select: none;
        }

        .faq-question:hover {
            color: var(--primary);
        }

        .faq-icon {
            font-size: 0.85rem;
            color: var(--text-muted);
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
            color: var(--primary);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0, 1, 0, 1);
            padding: 0 1.4rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .faq-item.active .faq-answer {
            padding-bottom: 1.25rem;
        }

        /* Slide-out Cart Sidebar */
        .cart-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .cart-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -420px;
            width: 400px;
            height: 100%;
            background: #ffffff;
            border-left: 1px solid var(--border-color);
            z-index: 1001;
            display: flex;
            flex-direction: column;
            transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: -15px 0 35px rgba(0, 0, 0, 0.1);
        }

        .cart-sidebar.open {
            right: 0;
        }

        .cart-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cart-header h3 {
            font-size: 1.05rem;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .cart-close-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.25rem;
            transition: var(--transition);
        }

        .cart-close-btn:hover {
            color: var(--danger);
        }

        .cart-items-container {
            flex: 1;
            overflow-y: auto;
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.95rem;
        }

        .empty-cart-msg {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-top: 3rem;
        }

        .cart-item {
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .cart-item-img-wrapper {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            flex-shrink: 0;
        }

        .cart-item-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .cart-item-details {
            flex: 1;
            min-width: 0;
        }

        .cart-item-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.2rem;
        }

        .cart-item-price {
            font-size: 0.85rem;
            color: var(--primary);
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            margin-bottom: 0.4rem;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .qty-btn {
            width: 22px;
            height: 22px;
            border-radius: 4px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.7rem;
            transition: var(--transition);
        }

        .qty-btn:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .qty-val {
            font-size: 0.8rem;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            min-width: 18px;
            text-align: center;
        }

        .remove-item-btn {
            background: none;
            border: none;
            color: var(--text-dark);
            cursor: pointer;
            padding: 0.4rem;
            transition: var(--transition);
        }

        .remove-item-btn:hover {
            color: var(--danger);
        }

        .cart-footer {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid var(--border-color);
            background: #f8fafc;
        }

        .cart-total-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .total-label {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .total-val {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            font-family: 'JetBrains Mono', monospace;
        }

        .checkout-btn {
            width: 100%;
            padding: 0.85rem;
            border-radius: var(--radius-full);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #ffffff;
            font-weight: 800;
            font-size: 0.92rem;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            box-shadow: 0 4px 15px var(--primary-glow);
            transition: var(--transition);
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.35);
        }

        /* Toast Notify */
        .toast-notify {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: #ffffff;
            border: 1px solid var(--primary);
            padding: 0.75rem 1.25rem;
            border-radius: var(--radius-md);
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.65rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-100px);
            opacity: 0;
            transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 2000;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .toast-notify.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* User Dropdown */
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
            box-shadow: var(--shadow-lg);
            width: 230px;
            padding: 0.5rem 0;
            display: none;
            z-index: 150;
        }

        .user-dropdown-menu.show {
            display: block;
            animation: slideDown 0.2s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .user-dropdown-header {
            padding: 0.75rem 1.25rem;
            display: flex;
            flex-direction: column;
        }

        .user-display-name {
            font-size: 0.88rem;
            font-weight: 800;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-display-email {
            font-size: 0.72rem;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 0.15rem;
        }

        .user-dropdown-divider {
            height: 1px;
            background: #f1f5f9;
            margin: 0.4rem 0;
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 1.25rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.82rem;
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
            background: #f8fafc;
            color: var(--primary);
        }

        .user-dropdown-item.logout-btn-item:hover {
            background: #fef2f2;
            color: var(--danger) !important;
        }

        /* Floating Back to Top Button */
        .back-to-top-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 2.85rem;
            height: 2.85rem;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid var(--border-color);
            color: var(--primary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
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
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            transform: translateY(-4px);
            box-shadow: 0 6px 20px var(--primary-glow);
        }

        /* Footer */
        footer {
            background: #0f172a; /* Sophisticated deep slate footer */
            color: #f8fafc;
            border-top: 1px solid var(--border-color);
            padding: 4rem 0 2rem;
            margin-top: 5rem;
            position: relative;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr 1.2fr;
            gap: 2.5rem;
            margin-bottom: 3rem;
        }

        .footer-col h4 {
            font-size: 0.95rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 1.25rem;
            letter-spacing: -0.2px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .footer-links a {
            font-size: 0.82rem;
            color: #94a3b8;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: #38bdf8;
            transform: translateX(3px);
        }

        .footer-socials {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.25rem;
        }

        .social-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            transition: var(--transition);
        }

        .social-circle:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            font-size: 0.78rem;
            color: #64748b;
            font-family: 'JetBrains Mono', monospace;
        }

        /* Responsive Layout */
        @media (max-width: 1024px) {
            .hero-text h1 {
                font-size: 2.65rem;
            }
            .hero-text p {
                font-size: 1.05rem;
            }
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .trust-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 820px) {
            .hero-banner {
                padding: 3rem 1.5rem;
            }
            .hero-text h1 {
                font-size: 2.2rem;
            }
            .hero-text p {
                font-size: 0.98rem;
            }
            .vs-container {
                grid-template-columns: 1fr;
            }
            .warranty-grid {
                grid-template-columns: 1fr;
            }
            .cat-nav-bar {
                display: none !important;
            }
            .search-wrapper {
                display: none;
            }
            .mobile-menu-toggle {
                display: flex !important;
            }
        }

        @media (max-width: 580px) {
            .hero-banner {
                padding: 2.5rem 1rem;
            }
            .products-grid {
                grid-template-columns: 1fr;
            }
            .trust-grid {
                grid-template-columns: 1fr;
            }
            .hero-text h1 {
                font-size: 1.85rem;
            }
            .cart-sidebar {
                width: 100%;
                right: -100%;
            }
        }

        .mobile-menu-toggle {
            display: none;
        }

        .menu-side-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .menu-side-link:hover, .menu-side-link.active {
            background: #f0f9ff;
            color: var(--primary);
        }
    </style>
</head>
<body>

    <!-- Top Promotion Bar -->
    <div class="top-ticker">
        <div class="marquee-wrapper">
            <div class="marquee-content">
                <span><span class="marquee-badge">PROMO</span> Nhập mã <strong>AI2026</strong> giảm ngay 20% toàn bộ tài khoản AI</span>
                <span><i class="fa-solid fa-bolt"></i> Hệ thống kích hoạt tài nguyên AI tự động trong 30 giây</span>
                <span><i class="fa-solid fa-shield-halved"></i> Cam kết bảo hành 1 đổi 1 suốt thời gian sử dụng</span>
                <span><i class="fa-solid fa-lock"></i> Tài khoản Private chính chủ — Bảo mật dữ liệu 100%</span>
                <span><i class="fa-solid fa-headset"></i> Đội ngũ kỹ thuật hỗ trợ xuyên đêm 24/7 qua Zalo</span>
            </div>
            <div class="marquee-content" aria-hidden="true">
                <span><span class="marquee-badge">PROMO</span> Nhập mã <strong>AI2026</strong> giảm ngay 20% toàn bộ tài khoản AI</span>
                <span><i class="fa-solid fa-bolt"></i> Hệ thống kích hoạt tài nguyên AI tự động trong 30 giây</span>
                <span><i class="fa-solid fa-shield-halved"></i> Cam kết bảo hành 1 đổi 1 suốt thời gian sử dụng</span>
                <span><i class="fa-solid fa-lock"></i> Tài khoản Private chính chủ — Bảo mật dữ liệu 100%</span>
                <span><i class="fa-solid fa-headset"></i> Đội ngũ kỹ thuật hỗ trợ xuyên đêm 24/7 qua Zalo</span>
            </div>
        </div>
    </div>

    <!-- Header Navigation -->
    <header>
        <div class="container">
            <div class="navbar">
                <a href="/" class="logo">
                    <div class="logo-symbol">
                        <!-- AI Brain & Core Vector Icon -->
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a4 4 0 0 0-4 4v1a3 3 0 0 0-3 3v2a3 3 0 0 0 2 2.82V16a4 4 0 0 0 4 4h2a4 4 0 0 0 4-4v-1.18A3 3 0 0 0 19 12v-2a3 3 0 0 0-3-3V6a4 4 0 0 0-4-4z"/>
                            <path d="M9 12h6"/>
                            <path d="M12 9v6"/>
                        </svg>
                    </div>
                    <span class="logo-text">AI CỦA TÔI</span>
                    <span class="logo-tag">CHÍNH HÃNG</span>
                </a>

                <!-- Header Category Pills -->
                <nav class="cat-nav-bar">
                    <a href="/" class="cat-pill active">
                        <i class="fa-solid fa-house"></i> Trang Chủ
                    </a>
                    <a href="/products" class="cat-pill">
                        <i class="fa-solid fa-cubes"></i> Kho Tài Nguyên AI
                    </a>
                    <a href="/products?category=api-token" class="cat-pill">
                        <i class="fa-solid fa-key"></i> API Token AI
                    </a>
                    <a href="/posts" class="cat-pill">
                        <i class="fa-solid fa-newspaper"></i> Hướng Dẫn & Tin Tức
                    </a>
                    <a href="https://zalo.me/0569012134" target="_blank" class="cat-pill">
                        <i class="fa-solid fa-headset"></i> Kỹ Thuật Zalo
                    </a>
                </nav>

                <!-- Search Input -->
                <div class="search-wrapper">
                    <input type="text" class="search-input" id="search-input" placeholder="Tìm kiếm ChatGPT, Claude, CapCut...">
                    <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                <!-- Nav Actions -->
                <div class="nav-actions">
                    <button class="action-icon-btn mobile-menu-toggle" id="mobile-menu-toggle" title="Menu">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <button class="action-icon-btn" id="open-cart-btn" title="Giỏ hàng">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="badge" id="cart-count">0</span>
                    </button>

                    @auth
                        <div class="user-menu-wrapper">
                            <button class="action-icon-btn user-menu-btn" title="{{ auth()->user()->name }}">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="user-avatar-img">
                                @else
                                    <i class="fa-solid fa-circle-user"></i>
                                @endif
                            </button>
                            <div class="user-dropdown-menu">
                                <div class="user-dropdown-header">
                                    <span class="user-display-name">{{ auth()->user()->name }}</span>
                                    <span class="user-display-email">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="user-dropdown-divider"></div>
                                @if(auth()->user()->isAdmin())
                                    <a href="/admin/dashboard" class="user-dropdown-item" style="color: var(--danger); font-weight: 700;">
                                        <i class="fa-solid fa-shield-halved"></i> Quản Trị Hệ Thống
                                    </a>
                                    <div class="user-dropdown-divider"></div>
                                @endif
                                <a href="/orders" class="user-dropdown-item">
                                    <i class="fa-solid fa-receipt"></i> Đơn hàng đã mua
                                </a>
                                <a href="/profile" class="user-dropdown-item">
                                    <i class="fa-solid fa-user-gear"></i> Cài đặt tài khoản
                                </a>
                                <div class="user-dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST" style="margin: 0; width: 100%;">
                                    @csrf
                                    <button type="submit" class="user-dropdown-item logout-btn-item">
                                        <i class="fa-solid fa-power-off"></i> Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="action-icon-btn" title="Đăng nhập">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        
        <!-- CLEAN LIGHT HERO BANNER -->
        <section class="hero-banner">
            <canvas id="heroCanvas" class="hero-banner-canvas"></canvas>
            
            <div class="hero-text">
                <div class="hero-badge">
                    <span class="pulse-dot"></span>
                    <span>AI ECOSYSTEM HUB • KÍCH HOẠT TỰ ĐỘNG 30S</span>
                </div>
                
                <h1>
                    Siêu Thị Tài Nguyên <br>
                    <span class="highlight-ai">Trí Tuệ Nhân Tạo & Tools Pro</span>
                </h1>
                
                <p>
                    Nâng tầm công việc sáng tạo với hệ sinh thái tài khoản AI bản quyền chính chủ: ChatGPT Plus, Claude 3.5 Sonnet, Midjourney, Google Gemini, CapCut Pro và Canva VIP. Tiết kiệm tới 80% chi phí, cam kết bảo hành 1 đổi 1 tức thì.
                </p>
                
                <div class="hero-buttons">
                    <a href="/products" class="btn btn-primary">
                        <i class="fa-solid fa-bolt"></i> Khám Phá Kho AI Ngay
                    </a>
                    <a href="https://zalo.me/0569012134" target="_blank" class="btn btn-outline">
                        <i class="fa-solid fa-comments"></i> Hỗ Trợ Kỹ Thuật Zalo
                    </a>
                </div>
            </div>
        </section>

        <!-- Products Section Header -->
        <div class="section-header" id="products-list">
            <h2 class="section-title">
                <span class="section-title-line"></span>
                Tài Nguyên AI & Công Cụ Nổi Bật
            </h2>
            <a href="/products" class="btn btn-outline" style="font-size: 0.8rem; padding: 0.5rem 1.15rem;">
                Xem Tất Cả Sản Phẩm <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <!-- Products Grid (4 Highlighted Products) -->
        <section class="products-grid">
            @foreach($products as $prod)
                @php
                    $defaultOpt = $prod->options[0] ?? null;
                    $defaultStock = isset($defaultOpt['stock']) ? (int)$defaultOpt['stock'] : 0;
                    $defaultOutOfStock = !$defaultOpt || (isset($defaultOpt['in_stock']) && $defaultOpt['in_stock'] === false) || $defaultStock <= 0;
                @endphp
                <div class="product-card" data-id="{{ $prod->options[0]['id'] ?? ($prod->slug . '-default') }}" data-name="{{ $prod->name }}" data-price="{{ $prod->default_price }}" data-icon="{{ $prod->icon }}" data-image="{{ $prod->image_path }}">
                    @if($prod->tag)
                        <span class="product-sale-tag">{{ $prod->tag }}</span>
                    @else
                        <span class="product-sale-tag">CHÍNH HÃNG</span>
                    @endif
                    
                    <a href="/product/{{ $prod->slug }}" style="display: block; width: 100%; text-decoration: none; color: inherit;">
                        <div class="product-media">
                            @if($prod->image_path && file_exists(public_path($prod->image_path)))
                                <img src="{{ asset($prod->image_path) }}" alt="{{ $prod->name }}" loading="lazy" decoding="async">
                            @elseif($prod->slug === 'chatgpt')
                                <svg viewBox="0 0 24 24" width="70" height="70" fill="#0284c7">
                                    <path d="M22.28 9.37a5.99 5.99 0 0 0-.52-4.94 6.06 6.06 0 0 0-6.42-2.73A6.04 6.04 0 0 0 10.7.35a6.04 6.04 0 0 0-5.8 4.22 6.06 6.06 0 0 0-4.14 3 6.05 6.05 0 0 0 .75 6.94 6.02 6.02 0 0 0 .52 4.94 6.06 6.06 0 0 0 6.42 2.73 6.04 6.04 0 0 0 4.64 1.35 6.04 6.04 0 0 0 5.8-4.22 6.06 6.06 0 0 0 4.14-3 6.05 6.05 0 0 0-.75-6.94zm-8.87 13.06a4.54 4.54 0 0 1-2.92-1.07l.14-.08 4.85-2.8a.78.78 0 0 0 .4-.68v-6.85l2.06 1.19a.07.07 0 0 1 .04.06v5.69a4.56 4.56 0 0 1-4.57 4.54zm-8.9-4.33a4.52 4.52 0 0 1-.62-3.05l.14.09 4.85 2.8a.77.77 0 0 0 .79 0l5.93-3.43v2.38a.07.07 0 0 1-.03.06l-4.93 2.85a4.55 4.55 0 0 1-6.13-1.7zm-1.8-8.88a4.54 4.54 0 0 1 2.3-1.98v5.76a.78.78 0 0 0 .39.68l5.93 3.42-2.06 1.19a.07.07 0 0 1-.07 0l-4.93-2.85a4.56 4.56 0 0 1-1.56-6.22zm14.65 2.21l-5.93-3.42 2.06-1.19a.07.07 0 0 1 .07 0l4.93 2.85a4.56 4.56 0 0 1 1.56 6.22 4.54 4.54 0 0 1-2.3 1.98v-5.76a.78.78 0 0 0-.39-.68zm2.66 4.97l-.14-.09-4.85-2.8a.77.77 0 0 0-.79 0l-5.93 3.43v-2.38a.07.07 0 0 1 .03-.06l4.93-2.85a4.55 4.55 0 0 1 6.75 4.75zM8.07 11.58l2.94-1.7a.78.78 0 0 0 .4-.68V5.76l2.06-1.19a.07.07 0 0 1 .07 0l4.93 2.85a4.55 4.55 0 0 1 2.3 3.96l-.14-.08-4.85-2.8a.77.77 0 0 0-.79 0l-5.93 3.43v-2.35l-1-.6zm2.84 1.34l2.67-1.54 2.67 1.54v3.08l-2.67 1.54-2.67-1.54z"/>
                                </svg>
                            @elseif($prod->slug === 'capcut')
                                <svg viewBox="0 0 24 24" width="70" height="70" fill="#0f172a">
                                    <path d="M4 4h7l4 8-4 8H4l4-8-4-8zm9 0h7l-4 8 4 8h-7l4-8-4-8z"/>
                                </svg>
                            @elseif($prod->slug === 'gemini')
                                <svg viewBox="0 0 24 24" width="70" height="70" fill="#4f46e5">
                                    <path d="M12 0C12 6.627 17.373 12 24 12C17.373 12 12 17.373 12 24C12 17.373 6.627 12 0 12C6.627 12 12 6.627 12 0Z"/>
                                </svg>
                            @else
                                <div style="font-size: 3.5rem; color: var(--primary);">
                                    <i class="fa-solid fa-cube"></i>
                                </div>
                            @endif
                        </div>
                    </a>

                    <div class="product-body">
                        <span class="product-cat">{{ $prod->category_label }}</span>
                        <a href="/product/{{ $prod->slug }}">
                            <h3 class="product-name">{{ $prod->name }}</h3>
                        </a>
                        
                        <div class="product-trust">
                            <div class="stars">
                                @for ($i = 0; $i < floor($prod->real_rating); $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @if($prod->real_rating - floor($prod->real_rating) >= 0.5)
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                @endif
                            </div>
                            <span class="sold-count">| Đã kích hoạt {{ $prod->real_sold }}+</span>
                        </div>

                        <ul class="product-specs">
                            @if(is_array($prod->features))
                                @foreach(array_slice($prod->features, 0, 2) as $feat)
                                    <li><i class="fa-solid fa-check"></i> {{ $feat }}</li>
                                @endforeach
                            @endif
                        </ul>

                        <div class="product-footer">
                            <div class="price-group">
                                <span class="price-slashed">{{ number_format($prod->default_slashed, 0, ',', '.') }}₫</span>
                                <span class="price-active">{{ number_format($prod->default_price, 0, ',', '.') }}₫</span>
                            </div>
                            
                            @if($defaultOutOfStock)
                                <button class="btn-add-cart" title="Tạm hết hàng" style="opacity: 0.4; cursor: not-allowed;" disabled>
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                            @else
                                <button class="btn-add-cart" title="Thêm vào giỏ">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </section>

        <!-- AI BRAND ECOSYSTEM MARQUEE BAR -->
        <section class="ai-ecosystem-bar">
            <div class="ai-bar-title">HỆ SINH THÁI TÀI NGUYÊN AI ĐƯỢC HỖ TRỢ CHÍNH HÃNG</div>
            <div class="ai-brands-track">
                <div class="ai-brand-pill">
                    <svg viewBox="0 0 24 24" fill="#0284c7"><circle cx="12" cy="12" r="10"/></svg>
                    <span>OpenAI ChatGPT-4o</span>
                </div>
                <div class="ai-brand-pill">
                    <svg viewBox="0 0 24 24" fill="#ea580c"><path d="M12 2L2 22h20L12 2z"/></svg>
                    <span>Anthropic Claude 3.5</span>
                </div>
                <div class="ai-brand-pill">
                    <svg viewBox="0 0 24 24" fill="#4f46e5"><path d="M12 0C12 6.627 17.373 12 24 12C17.373 12 12 17.373 12 24C12 17.373 6.627 12 0 12C6.627 12 12 6.627 12 0Z"/></svg>
                    <span>Google Gemini Ultra</span>
                </div>
                <div class="ai-brand-pill">
                    <svg viewBox="0 0 24 24" fill="#0f172a"><path d="M3 3h18v18H3z"/></svg>
                    <span>Midjourney v6</span>
                </div>
                <div class="ai-brand-pill">
                    <svg viewBox="0 0 24 24" fill="#0f172a"><path d="M4 4h7l4 8-4 8H4l4-8-4-8z"/></svg>
                    <span>CapCut Pro</span>
                </div>
                <div class="ai-brand-pill">
                    <svg viewBox="0 0 24 24" fill="#0284c7"><circle cx="12" cy="12" r="9"/></svg>
                    <span>Canva Pro Magic AI</span>
                </div>
                <div class="ai-brand-pill">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#0f172a" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 12h8"/></svg>
                    <span>Cursor AI Code</span>
                </div>
            </div>
        </section>

        <!-- Trust Badges Section -->
        <section class="trust-grid">
            <div class="trust-card">
                <div class="trust-icon-box">
                    <i class="fa-solid fa-bolt-lightning"></i>
                </div>
                <div class="trust-info">
                    <h3>Kích Hoạt Tự Động 30s</h3>
                    <p>API SePay đồng bộ tự động, giao nhận tài khoản hoặc nâng cấp qua Email tức thì.</p>
                </div>
            </div>
            
            <div class="trust-card">
                <div class="trust-icon-box">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="trust-info">
                    <h3>Bảo Hành 1 Đổi 1 Toàn Trình</h3>
                    <p>Cam kết 1 đổi 1 hoặc hoàn tiền minh bạch nếu phát sinh lỗi gián đoạn từ nhà phát hành.</p>
                </div>
            </div>

            <div class="trust-card">
                <div class="trust-icon-box">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div class="trust-info">
                    <h3>Tài Khoản Private 100%</h3>
                    <p>Nâng cấp trên Email cá nhân của bạn, tuyệt đối không dùng chung, bảo mật lịch sử chat & prompt.</p>
                </div>
            </div>

            <div class="trust-card">
                <div class="trust-icon-box">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="trust-info">
                    <h3>Kỹ Thuật Hỗ Trợ 24/7</h3>
                    <p>Hỗ trợ Ultraview/AnyDesk trực tiếp, giải đáp mọi vấn đề cài đặt prompt và kết nối API.</p>
                </div>
            </div>
        </section>

        <!-- VS Performance Section -->
        <section class="vs-wrapper">
            <div class="section-header">
                <h2 class="section-title">
                    <span class="section-title-line"></span>
                    Đột Phá Năng Suất: Làm Việc Thủ Công vs Tận Dụng AI
                </h2>
            </div>
            
            <div class="vs-container">
                <!-- Traditional Workflow -->
                <div class="vs-card negative">
                    <div class="vs-header">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Phương Pháp Truyền Thống (Không Dùng AI)</span>
                    </div>
                    <ul class="vs-list">
                        <li>
                            <i class="fa-solid fa-xmark"></i>
                            <span><strong>Mất 4-6 tiếng</strong> để lên ý tưởng, viết kịch bản và biên tập video cơ bản.</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-xmark"></i>
                            <span><strong>Bí ý tưởng thiết kế & nội dung</strong>, tài nguyên đồ họa bản miễn phí bị watermark và giới hạn tính năng.</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-xmark"></i>
                            <span><strong>Chi phí lẻ cắt cổ</strong> nếu mua gói trực tiếp từng công cụ (tốn hơn 2.500.000₫/tháng).</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-xmark"></i>
                            <span>Hiệu suất ì ạch, dễ bị đối thủ áp dụng AI vượt mặt về tốc độ xuất bản nội dung.</span>
                        </li>
                    </ul>
                </div>

                <!-- AI Accelerated Workflow -->
                <div class="vs-card positive">
                    <div class="vs-header">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <span>Ứng Dụng Toàn Diện Hệ Sinh Thái AI CỦA TÔI</span>
                    </div>
                    <ul class="vs-list">
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <span><strong>Hoàn thành video trong 10 phút</strong> với trọn bộ hiệu ứng Pro và phụ đề tự động trên CapCut Pro.</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <span><strong>Sáng tạo kịch bản & code siêu tốc</strong> nhờ sức mạnh vô hạn của ChatGPT-4o & Claude 3.5 Sonnet.</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <span><strong>Tiết kiệm 80% ngân sách</strong> khi sở hữu tài nguyên bản quyền chính chủ qua AI CỦA TÔI.</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i>
                            <span>Tăng gấp 5 lần sản lượng content, tự động hóa quy trình làm việc và gia tăng doanh số.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Comparison Table -->
        <section class="comparison-wrapper">
            <div class="section-header">
                <h2 class="section-title">
                    <span class="section-title-line"></span>
                    Tiêu Chuẩn Chất Lượng Tại AI CỦA TÔI
                </h2>
            </div>
            
            <div class="table-responsive">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Tiêu Chí Dịch Vụ</th>
                            <th class="comp-ours">Hệ Thống AI CỦA TÔI</th>
                            <th>Tài Khoản Trôi Nổi / Lậu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight: 700; color: #0f172a;">Chính Chủ & Riêng Tư</td>
                            <td class="comp-ours">
                                <span class="badge-check"><i class="fa-solid fa-circle-check"></i> 100% Private</span> - Nâng cấp trên Email cá nhân, giữ kín lịch sử dữ liệu.
                            </td>
                            <td>
                                <span class="badge-cross"><i class="fa-solid fa-circle-xmark"></i> Dùng Chung</span> - Bị người khác xem trộm prompt và thiết kế.
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700; color: #0f172a;">Độ Ổn Định</td>
                            <td class="comp-ours">
                                <span class="badge-check"><i class="fa-solid fa-circle-check"></i> Ổn định tuyệt đối</span> - Bản quyền gia hạn hợp pháp, không bị out giữa chừng.
                            </td>
                            <td>
                                <span class="badge-cross"><i class="fa-solid fa-circle-xmark"></i> Dễ bị quét</span> - Dùng thẻ ảo lậu, tài khoản dễ bay màu sau vài ngày.
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700; color: #0f172a;">Tốc Độ Kích Hoạt</td>
                            <td class="comp-ours">
                                <span class="badge-check"><i class="fa-solid fa-circle-check"></i> Tự động 30s</span> - Quét mã QR SePay, nhận quyền sử dụng tức thời.
                            </td>
                            <td>
                                <span class="badge-cross"><i class="fa-solid fa-circle-xmark"></i> Thủ công</span> - Phải chờ admin duyệt bằng tay hàng giờ, thậm chí hàng ngày.
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700; color: #0f172a;">Cam Kết Bảo Hành</td>
                            <td class="comp-ours">
                                <span class="badge-check"><i class="fa-solid fa-circle-check"></i> 1 Đổi 1 Uy Tín</span> - Hỗ trợ suốt toàn bộ chu kỳ gói đăng ký.
                            </td>
                            <td>
                                <span class="badge-cross"><i class="fa-solid fa-circle-xmark"></i> Đem con bỏ chợ</span> - Chặn tin nhắn, thoái thác trách nhiệm khi phát sinh lỗi.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Warranty Section -->
        <section class="warranty-section">
            <div style="text-align: center; margin-bottom: 2.5rem;">
                <h2 style="font-size: 1.5rem; font-weight: 900; color: #0f172a; letter-spacing: -0.5px;">Cam Kết An Toàn & Bảo Hành Vàng</h2>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-top: 0.5rem;">Bảo vệ tối đa quyền lợi khách hàng trong từng giao dịch tại AI CỦA TÔI</p>
            </div>
            
            <div class="warranty-grid">
                <div class="warranty-card">
                    <div class="w-icon"><i class="fa-solid fa-award"></i></div>
                    <h3>Bản Quyền Hợp Pháp</h3>
                    <p>Mọi tài nguyên AI đều được thanh toán và đăng ký hợp pháp với nhà cung cấp chính thức, không can thiệp thẻ lậu hoặc crack.</p>
                </div>

                <div class="warranty-card">
                    <div class="w-icon"><i class="fa-solid fa-rotate-left"></i></div>
                    <h3>Bảo Hành Toàn Chu Kỳ</h3>
                    <p>Cam kết xử lý đổi mới hoặc hoàn tiền theo tỷ lệ thời gian nếu tài khoản gặp sự cố không thể khắc phục trong thời hạn gói.</p>
                </div>

                <div class="warranty-card">
                    <div class="w-icon"><i class="fa-solid fa-laptop-code"></i></div>
                    <h3>Hỗ Trợ Kỹ Thuật Chuyên Sâu</h3>
                    <p>Kỹ thuật viên sẵn sàng Ultraview/AnyDesk hỗ trợ cấu hình API, kết nối tool và hướng dẫn bạn sử dụng hiệu quả 24/7.</p>
                </div>
            </div>
        </section>

        <!-- FAQs Section -->
        <section class="faqs-section">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.5rem; font-weight: 900; color: #0f172a;">Câu Hỏi Thường Gặp Về Tài Nguyên AI</h2>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.4rem;">Giải đáp các băn khoăn phổ biến của người dùng khi nâng cấp</p>
            </div>
            
            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Sau khi thanh toán tôi sẽ nhận tài khoản AI bằng cách nào?</span>
                        <i class="fa-solid fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        Hệ thống của AI CỦA TÔI vận hành tự động 100%. Sau khi bạn quét mã QR chuyển khoản đúng cú pháp, thông tin kích hoạt hoặc tài khoản sẽ được gửi tự động trực tiếp qua Email và hiển thị ngay trên màn hình trong vòng 30 giây.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Tôi có thể nâng cấp trên chính Email cá nhân của tôi không?</span>
                        <i class="fa-solid fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        Chắc chắn có. Các gói CapCut Pro, Canva Pro, Google Gemini Advanced và một số gói ChatGPT/Claude hỗ trợ kích hoạt trực tiếp trên Email cá nhân của bạn để đảm bảo tính riêng tư tuyệt đối cho dữ liệu.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Nếu tài khoản bị lỗi thì được bảo hành ra sao?</span>
                        <i class="fa-solid fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        Chúng tôi cam kết bảo hành 1 đổi 1 trong suốt chu kỳ gói bạn mua. Nếu gặp bất kỳ vấn đề gì, bạn chỉ cần bấm chat Zalo hoặc gọi Hotline hỗ trợ, kỹ thuật viên sẽ kiểm tra và cấp lại tài khoản mới ngay lập tức.
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Slide-out Cart Sidebar -->
    <div class="cart-overlay" id="cart-overlay"></div>
    <div class="cart-sidebar" id="cart-sidebar">
        <div class="cart-header">
            <h3>
                <i class="fa-solid fa-cart-shopping" style="color: var(--primary);"></i>
                Giỏ Hàng Của Bạn
            </h3>
            <button class="cart-close-btn" id="close-cart-btn"><i class="fa-solid fa-xmark"></i></button>
        </div>
        
        <div class="cart-items-container" id="cart-items-wrapper">
            <div class="empty-cart-msg">Giỏ hàng đang trống. Hãy chọn những tài nguyên AI tốt nhất nhé!</div>
        </div>
        
        <div class="cart-footer">
            <div class="cart-total-row">
                <span class="total-label">Tổng tiền thanh toán:</span>
                <span class="total-val" id="cart-total-price">0₫</span>
            </div>
            <button class="checkout-btn" id="checkout-btn">
                <i class="fa-solid fa-credit-card"></i> Tiến Hành Thanh Toán Ngay
            </button>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-notify" id="toast-notify">
        <i class="fa-solid fa-circle-check" style="color: var(--success); font-size: 1.15rem;"></i>
        <span id="toast-message">Đã thêm vào giỏ hàng thành công!</span>
    </div>

    <!-- Slide-out Mobile Menu Sidebar -->
    <div class="menu-overlay" id="menu-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(4px); z-index: 9999; opacity: 0; transition: opacity 0.3s ease;"></div>
    <div class="menu-sidebar" id="menu-sidebar" style="position: fixed; top: 0; left: -290px; width: 280px; height: 100%; background: #ffffff; border-right: 1px solid var(--border-color); z-index: 10000; display: flex; flex-direction: column; transition: left 0.35s cubic-bezier(0.16, 1, 0.3, 1); overflow-y: auto; padding: 1.5rem 1.25rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);">
            <div style="display: flex; align-items: center; gap: 0.5rem; font-weight: 800; font-size: 1rem; color: #0f172a;">
                <i class="fa-solid fa-cubes" style="color: var(--primary);"></i> DANH MỤC
            </div>
            <button id="menu-close-btn" style="background: none; border: none; font-size: 1.2rem; color: var(--text-muted); cursor: pointer;"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <nav style="display: flex; flex-direction: column; gap: 0.5rem;">
            <a href="/" class="menu-side-link"><i class="fa-solid fa-house"></i> Trang Chủ</a>
            <a href="/products" class="menu-side-link"><i class="fa-solid fa-cubes"></i> Kho Tài Nguyên AI</a>
            <a href="/products?category=api-token" class="menu-side-link"><i class="fa-solid fa-key"></i> API Token AI</a>
            <a href="/posts" class="menu-side-link"><i class="fa-solid fa-newspaper"></i> Hướng Dẫn & Tin Tức</a>
            <a href="https://zalo.me/0569012134" target="_blank" class="menu-side-link"><i class="fa-solid fa-headset"></i> Kỹ Thuật Zalo</a>
            <a href="https://zalo.me/g/ifaku0ggmtg4xhxi7k0u" target="_blank" class="menu-side-link" style="color: var(--primary); font-weight: 700;"><i class="fa-solid fa-users"></i> Cộng Đồng AI Zalo</a>
        </nav>
    </div>

    <!-- Footer Area -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="/" class="logo" style="margin-bottom: 1.25rem;">
                        <div class="logo-symbol">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2">
                                <path d="M12 2a4 4 0 0 0-4 4v1a3 3 0 0 0-3 3v2a3 3 0 0 0 2 2.82V16a4 4 0 0 0 4 4h2a4 4 0 0 0 4-4v-1.18A3 3 0 0 0 19 12v-2a3 3 0 0 0-3-3V6a4 4 0 0 0-4-4z"/>
                            </svg>
                        </div>
                        <span class="logo-text" style="color: #ffffff;">AI CỦA TÔI</span>
                    </a>
                    <p style="font-size: 0.82rem; color: #94a3b8; line-height: 1.6; max-width: 320px;">
                        Hệ thống phân phối tài nguyên trí tuệ nhân tạo, phần mềm bản quyền và tài khoản số hàng đầu Việt Nam. Tự động - Uy tín - Giá rẻ.
                    </p>
                    <div class="footer-socials">
                        <a href="{{ App\Models\Setting::getValue('social_facebook', 'https://facebook.com') }}" class="social-circle" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="{{ App\Models\Setting::getValue('social_telegram', 'https://t.me') }}" class="social-circle" target="_blank"><i class="fa-brands fa-telegram"></i></a>
                        <a href="{{ App\Models\Setting::getValue('social_zalo', 'https://zalo.me') }}" class="social-circle" target="_blank" style="font-weight: 800; font-size: 0.82rem;">Zalo</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Tài Nguyên AI</h4>
                    <div class="footer-links">
                        <a href="/product/chatgpt">Tài khoản ChatGPT Plus</a>
                        <a href="/product/claude">Tài khoản Claude 3.5 Pro</a>
                        <a href="/product/gemini">Google Gemini Advanced</a>
                        <a href="/product/capcut">Tài khoản CapCut Pro</a>
                        <a href="/product/canva">Tài khoản Canva Pro</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Hỗ Trợ & Chính Sách</h4>
                    <div class="footer-links">
                        <a href="/posts">Tin Tức Công Nghệ</a>
                        <a href="#">Chính Sách Bảo Hành 1-1</a>
                        <a href="#">Điều Khoản Dịch Vụ</a>
                        <a href="#">Hướng Dẫn Thanh Toán QR</a>
                        <a href="https://zalo.me/0569012134" target="_blank">Zalo Support 24/7</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Liên Hệ Trực Tiếp</h4>
                    <div class="footer-links" style="gap: 0.95rem;">
                        <a href="https://zalo.me/0569012134" target="_blank" style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-phone" style="color: #38bdf8;"></i> Zalo: 0569012134
                        </a>
                        <a href="https://t.me/specademy" target="_blank" style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-brands fa-telegram" style="color: #38bdf8;"></i> Telegram: @specademy
                        </a>
                        <span style="font-size: 0.82rem; color: #94a3b8; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-clock" style="color: #38bdf8;"></i> Vận hành tự động: 24/7/365
                        </span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; {{ date('Y') }} AI CỦA TÔI. All Rights Reserved. Hệ Thống Tài Nguyên AI Chuẩn Quốc Tế.
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

        function formatVND(amount) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount).replace('₫', '₫');
        }

        function openCart() {
            cartSidebar.classList.add('open');
            cartOverlay.classList.add('open');
        }

        function closeCart() {
            cartSidebar.classList.remove('open');
            cartOverlay.classList.remove('open');
        }

        function renderCart() {
            if (cart.length === 0) {
                cartItemsWrapper.innerHTML = `<div class="empty-cart-msg">Giỏ hàng đang trống. Hãy chọn những tài nguyên AI tốt nhất nhé!</div>`;
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
                        <div class="cart-item-img-wrapper" style="color: var(--primary);">
                            <i class="fa-solid fa-cube"></i>
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

            localStorage.setItem('capcut_store_cart', JSON.stringify(cart));
        }

        function addToCart(id, name, price, icon, image) {
            const existingIndex = cart.findIndex(item => item.id === id);
            if (existingIndex > -1) {
                cart[existingIndex].quantity += 1;
            } else {
                cart.push({ id, name, price, icon, image, quantity: 1 });
            }
            renderCart();
            showToast(`Đã thêm "${name}" vào giỏ hàng!`);
            openCart();
        }

        window.removeFromCart = function(index) {
            cart.splice(index, 1);
            renderCart();
        };

        window.updateQty = function(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            renderCart();
        };

        function showToast(msg) {
            toastMessage.innerText = msg;
            toastNotify.classList.add('show');
            setTimeout(() => {
                toastNotify.classList.remove('show');
            }, 3000);
        }

        if (openCartBtn) openCartBtn.addEventListener('click', openCart);
        if (closeCartBtn) closeCartBtn.addEventListener('click', closeCart);
        if (cartOverlay) cartOverlay.addEventListener('click', closeCart);

        // User Dropdown
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

        // Add to Cart Buttons
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

        // Checkout Button
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

        // Search Input Enter
        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    window.location.href = `/products?search=${encodeURIComponent(this.value)}`;
                }
            });
        }

        // FAQ Accordion
        document.querySelectorAll('.faq-question').forEach(q => {
            q.addEventListener('click', function() {
                const item = this.closest('.faq-item');
                const answer = item.querySelector('.faq-answer');
                const isActive = item.classList.contains('active');
                
                document.querySelectorAll('.faq-item').forEach(i => {
                    i.classList.remove('active');
                    i.querySelector('.faq-answer').style.maxHeight = null;
                });

                if (!isActive) {
                    item.classList.add('active');
                    answer.style.maxHeight = answer.scrollHeight + "px";
                }
            });
        });

        // Initial render cart
        renderCart();

        // Back to top (throttled with RAF)
        const backToTopBtn = document.getElementById('back-to-top-btn');
        if (backToTopBtn) {
            let scrollTicking = false;
            window.addEventListener('scroll', () => {
                if (!scrollTicking) {
                    window.requestAnimationFrame(() => {
                        if (window.scrollY > 300) {
                            backToTopBtn.classList.add('show');
                        } else {
                            backToTopBtn.classList.remove('show');
                        }
                        scrollTicking = false;
                    });
                    scrollTicking = true;
                }
            }, { passive: true });

            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Mobile Menu
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
                menuSidebar.style.left = '-290px';
                setTimeout(() => {
                    menuOverlay.style.display = 'none';
                }, 300);
            };

            menuClose.addEventListener('click', closeMenu);
            menuOverlay.addEventListener('click', closeMenu);
        }

        // ULTRA-LIGHT TECH PARTICLE CANVAS (High FPS, 0% Scroll Jank)
        (function() {
            const canvas = document.getElementById('heroCanvas');
            if (!canvas) return;

            // Completely skip canvas calculations on mobile for buttery smooth touch scrolling
            if (window.innerWidth < 768) {
                canvas.style.display = 'none';
                return;
            }

            const ctx = canvas.getContext('2d', { alpha: true });
            const container = canvas.parentElement;
            if (!container) return;

            let particles = [];
            let animationFrameId = null;
            let width = 0;
            let height = 0;
            let isVisible = false;
            let isScrolling = false;
            let scrollTimer = null;

            const mouse = { x: null, y: null, radius: 120 };
            const particleCount = 18; // Optimal count: minimal CPU, maximum elegance
            const connectionDistance = 110;
            const maxDistSq = connectionDistance * connectionDistance;
            const mouseRadiusSq = mouse.radius * mouse.radius;

            class Particle {
                constructor() {
                    this.reset();
                }

                reset() {
                    this.x = Math.random() * width;
                    this.y = Math.random() * height;
                    this.radius = Math.random() * 1.6 + 1.2;
                    this.vx = (Math.random() - 0.5) * 0.45;
                    this.vy = (Math.random() - 0.5) * 0.45;
                    this.color = Math.random() > 0.5 ? 'rgba(2, 132, 199, 0.45)' : 'rgba(79, 70, 229, 0.4)';
                }

                update() {
                    this.x += this.vx;
                    this.y += this.vy;

                    if (this.x < 0) this.x = width;
                    if (this.x > width) this.x = 0;
                    if (this.y < 0) this.y = height;
                    if (this.y > height) this.y = 0;
                }

                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                    ctx.fillStyle = this.color;
                    ctx.fill();
                }
            }

            function resizeCanvas() {
                if (!container) return;
                width = container.offsetWidth;
                height = container.offsetHeight;
                
                const dpr = Math.min(window.devicePixelRatio || 1, 1.25);
                canvas.width = width * dpr;
                canvas.height = height * dpr;
                ctx.scale(dpr, dpr);

                initParticles();
                updateContainerRect();
            }

            function initParticles() {
                particles = [];
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
            }

            function drawConnections() {
                ctx.lineWidth = 0.8;
                for (let i = 0; i < particles.length; i++) {
                    const p1 = particles[i];
                    for (let j = i + 1; j < particles.length; j++) {
                        const p2 = particles[j];
                        const dx = p1.x - p2.x;
                        const dy = p1.y - p2.y;
                        const distSq = dx * dx + dy * dy;

                        if (distSq < maxDistSq) {
                            const alpha = (1 - Math.sqrt(distSq) / connectionDistance) * 0.2;
                            ctx.beginPath();
                            ctx.moveTo(p1.x, p1.y);
                            ctx.lineTo(p2.x, p2.y);
                            ctx.strokeStyle = `rgba(2, 132, 199, ${alpha})`;
                            ctx.stroke();
                        }
                    }

                    if (mouse.x !== null && mouse.y !== null) {
                        const dx = p1.x - mouse.x;
                        const dy = p1.y - mouse.y;
                        const distSq = dx * dx + dy * dy;

                        if (distSq < mouseRadiusSq) {
                            const alpha = (1 - Math.sqrt(distSq) / mouse.radius) * 0.3;
                            ctx.beginPath();
                            ctx.moveTo(p1.x, p1.y);
                            ctx.lineTo(mouse.x, mouse.y);
                            ctx.strokeStyle = `rgba(2, 132, 199, ${alpha})`;
                            ctx.stroke();
                        }
                    }
                }
            }

            let lastTime = 0;
            const fpsInterval = 1000 / 30; // Solid 30fps particle motion is perfectly fluid while saving 50% CPU

            function animate(timestamp = 0) {
                if (!isVisible) return;
                animationFrameId = requestAnimationFrame(animate);

                // Yield 100% GPU / thread to scrolling while user moves the page
                if (isScrolling) return;

                if (timestamp - lastTime < fpsInterval) return;
                lastTime = timestamp;

                ctx.clearRect(0, 0, width, height);
                for (let i = 0; i < particles.length; i++) {
                    particles[i].update();
                    particles[i].draw();
                }
                drawConnections();
            }

            // Cache rect to avoid synchronous reflows on mousemove
            let cachedRect = null;
            function updateContainerRect() {
                if (container) cachedRect = container.getBoundingClientRect();
            }

            window.addEventListener('scroll', () => {
                isScrolling = true;
                clearTimeout(scrollTimer);
                scrollTimer = setTimeout(() => {
                    isScrolling = false;
                    updateContainerRect();
                }, 100);
            }, { passive: true });

            container.addEventListener('mouseenter', updateContainerRect, { passive: true });
            container.addEventListener('mousemove', (e) => {
                if (!cachedRect) updateContainerRect();
                mouse.x = e.clientX - cachedRect.left;
                mouse.y = e.clientY - cachedRect.top;
            }, { passive: true });

            container.addEventListener('mouseleave', () => {
                mouse.x = null;
                mouse.y = null;
            }, { passive: true });

            let resizeTimer = null;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(resizeCanvas, 200);
            }, { passive: true });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    isVisible = entry.isIntersecting;
                    if (isVisible) {
                        cancelAnimationFrame(animationFrameId);
                        animate();
                    } else {
                        cancelAnimationFrame(animationFrameId);
                    }
                });
            }, { threshold: 0.05 });

            resizeCanvas();
            observer.observe(container);
        })();
    </script>
    
    <!-- Floating Back to Top Button -->
    <button id="back-to-top-btn" class="back-to-top-btn" title="Lên đầu trang">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    @include('partials.chat-bubble')
</body>
</html>
