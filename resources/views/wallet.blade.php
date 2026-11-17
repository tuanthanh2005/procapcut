<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Nạp Tiền Vào Ví | AI CỦA TÔI</title>
    <meta name="description" content="Nạp tiền vào ví tự động 24/7 qua VietQR SePay tại AI CỦA TÔI. Nhận tiền sau 3-30 giây.">
    <meta name="robots" content="noindex, nofollow">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-body: #f8fafc;
            --primary: #0284c7;
            --primary-hover: #0369a1;
            --secondary: #0ea5e9;
            --accent: #0d9488;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --text-main: #0f172a;
            --text-dark: #334155;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --radius-md: 12px;
            --radius-lg: 18px;
            --radius-xl: 24px;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
        }

        .container {
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Top Announcement Banner */
        .top-banner {
            background: #0284c7;
            color: #ffffff;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.45rem 1rem;
            text-align: center;
        }

        /* Header Navigation */
        header {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 4px rgba(0,0,0,0.02);
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
            gap: 1.25rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--text-main);
            flex-shrink: 0;
        }

        .logo-symbol {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25);
        }

        .logo-text {
            letter-spacing: -0.02em;
        }

        /* Nav Category Links */
        .cat-nav-bar {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .cat-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.45rem 0.85rem;
            border-radius: 9999px;
            text-decoration: none;
            color: var(--text-dark);
            font-size: 0.82rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .cat-pill:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

        .cat-pill.active {
            background: #e0f2fe;
            color: #0284c7;
            font-weight: 700;
        }

        /* Search Input */
        .search-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            max-width: 280px;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 0.48rem 2.2rem 0.48rem 2.2rem;
            font-size: 0.82rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 9999px;
            outline: none;
            color: #1e293b;
            transition: var(--transition);
        }

        .search-input:focus {
            background: #ffffff;
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        }

        .search-icon-left {
            position: absolute;
            left: 0.85rem;
            color: #94a3b8;
            font-size: 0.8rem;
            pointer-events: none;
        }

        .search-shortcut-badge {
            position: absolute;
            right: 0.75rem;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 0.1rem 0.35rem;
            font-size: 0.68rem;
            color: #64748b;
            font-weight: 600;
            line-height: 1;
            pointer-events: none;
        }

        /* Nav Actions */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            flex-shrink: 0;
        }


        /* User Profile Pill */
        .user-menu-wrapper {
            position: relative;
        }

        .user-pill-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.3rem 0.85rem 0.3rem 0.35rem;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 9999px;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: var(--transition);
            outline: none;
        }

        .user-pill-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .user-pill-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
            background: #e0f2fe;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-pill-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-pill-info {
            display: flex;
            flex-direction: column;
            text-align: left;
            line-height: 1.15;
        }

        .user-pill-name {
            font-size: 0.78rem;
            font-weight: 800;
            color: #0f172a;
            max-width: 110px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-transform: uppercase;
            letter-spacing: -0.01em;
        }

        .user-pill-balance {
            font-size: 0.74rem;
            font-weight: 700;
            color: #0d9488;
        }

        .user-pill-arrow {
            font-size: 0.65rem;
            color: #64748b;
            margin-left: 0.15rem;
            transition: transform 0.2s ease;
        }

        /* User Dropdown */
        .user-dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            width: 270px;
            padding: 0.65rem 0;
            display: none;
            z-index: 200;
            animation: slideDown 0.2s ease;
        }

        .user-dropdown-menu.show {
            display: block;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .user-dropdown-header {
            padding: 0.75rem 1.1rem 0.85rem 1.1rem;
        }

        .user-dropdown-user-row {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 0.75rem;
        }

        .dropdown-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .dropdown-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dropdown-user-meta {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .user-display-name {
            font-size: 0.86rem;
            font-weight: 800;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-display-email {
            font-size: 0.72rem;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-wallet-card {
            background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 0.6rem 0.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .wallet-card-header {
            display: flex;
            flex-direction: column;
        }

        .wallet-card-label {
            font-size: 0.68rem;
            color: #166534;
            font-weight: 600;
        }

        .wallet-card-amount {
            font-size: 0.95rem;
            font-weight: 800;
            color: #059669;
        }

        .wallet-card-btn {
            background: #059669;
            color: #ffffff !important;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            font-size: 0.72rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: background 0.2s;
        }

        .wallet-card-btn:hover {
            background: #047857;
        }

        .user-dropdown-divider {
            height: 1px;
            background: #f1f5f9;
            margin: 0.35rem 0;
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 1.25rem;
            color: var(--text-dark);
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

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.82rem;
            color: var(--text-muted);
            margin: 1.5rem 0 1.25rem 0;
        }

        .breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .breadcrumb i {
            font-size: 0.68rem;
        }

        /* Top Hero Card */
        .wallet-hero {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 50%, #075985 100%);
            border-radius: var(--radius-xl);
            padding: 2rem 2.25rem;
            color: #ffffff;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.3);
            display: grid;
            grid-template-columns: 1.3fr 1fr;
            gap: 2rem;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .wallet-hero::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .wallet-hero-left {
            position: relative;
            z-index: 1;
        }

        .wallet-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(8px);
            padding: 0.3rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            margin-bottom: 0.85rem;
        }

        .wallet-pulse-dot {
            width: 8px;
            height: 8px;
            background: #4ade80;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7);
            animation: pulse-green 1.8s infinite;
        }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7); }
            70% { box-shadow: 0 0 0 8px rgba(74, 222, 128, 0); }
            100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
        }

        .wallet-hero-balance-label {
            font-size: 0.88rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .wallet-hero-balance-val {
            font-size: 2.6rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            margin: 0.25rem 0 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .wallet-hero-desc {
            font-size: 0.85rem;
            opacity: 0.85;
            max-width: 480px;
        }

        .wallet-hero-right {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .hero-stat-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-md);
            padding: 1rem 1.25rem;
        }

        .hero-stat-label {
            font-size: 0.75rem;
            opacity: 0.85;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-bottom: 0.35rem;
        }

        .hero-stat-val {
            font-size: 1.25rem;
            font-weight: 800;
        }

        /* Main Grid: Deposit Box & Transfer Details */
        .wallet-main-grid {
            display: grid;
            grid-template-columns: 1fr 1.05fr;
            gap: 2rem;
            margin-bottom: 2.5rem;
        }

        .card-box {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.75rem;
            box-shadow: var(--shadow-sm);
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.85rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-title i {
            color: var(--primary);
        }

        /* Preset Amounts */
        .amount-selector-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.65rem;
            display: block;
        }

        .preset-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.65rem;
            margin-bottom: 1.25rem;
        }

        .preset-btn {
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 10px;
            padding: 0.65rem 0.5rem;
            font-size: 0.86rem;
            font-weight: 700;
            color: var(--text-dark);
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .preset-btn:hover {
            border-color: #38bdf8;
            background: #f0f9ff;
            color: var(--primary);
        }

        .preset-btn.active {
            border-color: var(--primary);
            background: #e0f2fe;
            color: #0284c7;
            box-shadow: 0 0 0 2px rgba(2, 132, 199, 0.2);
        }

        /* Custom Input */
        .custom-input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .custom-input-group input {
            width: 100%;
            padding: 0.75rem 3rem 0.75rem 1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
            outline: none;
            transition: var(--transition);
        }

        .custom-input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
        }

        .currency-suffix {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 700;
            color: var(--text-muted);
            pointer-events: none;
        }

        /* QR Code Card Area */
        .qr-display-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 14px;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 1rem;
        }

        .qr-code-img {
            width: 220px;
            height: 220px;
            object-fit: contain;
            background: #ffffff;
            padding: 0.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            margin-bottom: 0.85rem;
        }

        .qr-instructions {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.4;
        }

        /* Right Column: Bank Transfer Details */
        .bank-info-table {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .bank-info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }

        .bank-info-row:hover {
            background: #f1f5f9;
        }

        .bank-info-label {
            font-size: 0.82rem;
            color: var(--text-muted);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .bank-info-content {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .bank-info-val {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: 0.01em;
        }

        .bank-info-val.highlight-syntax {
            color: #d97706;
            background: #fef3c7;
            padding: 0.2rem 0.55rem;
            border-radius: 6px;
            border: 1px solid #fde68a;
            font-family: monospace;
            font-size: 1.05rem;
        }

        .bank-info-val.highlight-amount {
            color: #059669;
            font-size: 1.05rem;
        }

        .btn-copy {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: var(--primary);
            padding: 0.3rem 0.65rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .btn-copy:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .btn-copy.copied {
            background: #10b981;
            color: #ffffff;
            border-color: #10b981;
        }

        /* Warning Notice */
        .warning-notice-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 12px;
            padding: 1rem 1.15rem;
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .warning-notice-box i {
            color: #d97706;
            font-size: 1.1rem;
            margin-top: 0.15rem;
            flex-shrink: 0;
        }

        .warning-notice-text {
            font-size: 0.82rem;
            color: #92400e;
            line-height: 1.45;
        }

        .warning-notice-text strong {
            color: #78350f;
        }

        /* Live Polling Status Box */
        .status-listening-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .status-spinner {
            width: 18px;
            height: 18px;
            border: 2.5px solid #86efac;
            border-top-color: #16a34a;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            flex-shrink: 0;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .status-listening-text {
            font-size: 0.8rem;
            color: #166534;
            font-weight: 600;
        }

        /* History Table Section */
        .history-section {
            margin-bottom: 3.5rem;
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.85rem;
            background: #ffffff;
        }

        .history-table th {
            background: #f8fafc;
            padding: 0.85rem 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        .history-table td {
            padding: 0.95rem 1.25rem;
            border-bottom: 1px solid #f1f5f9;
            color: var(--text-main);
            vertical-align: middle;
        }

        .history-table tr:hover td {
            background: #f8fafc;
        }

        .badge-deposit {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            background: #dcfce7;
            color: #15803d;
            font-weight: 700;
            font-size: 0.75rem;
            padding: 0.25rem 0.6rem;
            border-radius: 9999px;
        }

        .badge-purchase {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            background: #fee2e2;
            color: #b91c1c;
            font-weight: 700;
            font-size: 0.75rem;
            padding: 0.25rem 0.6rem;
            border-radius: 9999px;
        }

        .badge-completed {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            background: #e0f2fe;
            color: #0369a1;
            font-weight: 700;
            font-size: 0.75rem;
            padding: 0.25rem 0.6rem;
            border-radius: 9999px;
        }

        .empty-history-box {
            text-align: center;
            padding: 3rem 1.5rem;
            color: var(--text-muted);
        }

        .empty-history-box i {
            font-size: 2.5rem;
            color: #cbd5e1;
            margin-bottom: 0.75rem;
        }

        /* Toast notification */
        .toast-notif {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: #0f172a;
            color: #ffffff;
            padding: 0.85rem 1.25rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 0.65rem;
            z-index: 9999;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .toast-notif.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Success Deposit Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            animation: fadeIn 0.2s ease;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-box {
            background: #ffffff;
            border-radius: 20px;
            max-width: 440px;
            width: 90%;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: scaleUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes scaleUp {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-icon {
            width: 64px;
            height: 64px;
            background: #dcfce7;
            color: #16a34a;
            font-size: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem auto;
        }

        .modal-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .modal-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .btn-modal-close {
            background: var(--primary);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.75rem;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            width: 100%;
            transition: var(--transition);
        }

        .btn-modal-close:hover {
            background: var(--primary-hover);
        }

        /* Footer */
        footer {
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            padding: 2rem 0;
            margin-top: auto;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        @media (max-width: 992px) {
            .cat-nav-bar {
                display: none;
            }
            .wallet-hero {
                grid-template-columns: 1fr;
                padding: 1.5rem;
            }
            .wallet-main-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Top Announcement Banner -->
    <div class="top-banner">
        ⚡ Nạp ví tự động 24/7 qua VietQR • Nhận tiền ngay sau 3-30 giây • Cam kết bảo mật & hoàn tiền 100% nếu có lỗi
    </div>

    <!-- Header Navigation -->
    <header>
        <div class="container">
            <div class="navbar">
                <a href="/" class="logo">
                    <div class="logo-symbol">
                        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a4 4 0 0 0-4 4v1a3 3 0 0 0-3 3v2a3 3 0 0 0 2 2.82V16a4 4 0 0 0 4 4h2a4 4 0 0 0 4-4v-1.18A3 3 0 0 0 19 12v-2a3 3 0 0 0-3-3V6a4 4 0 0 0-4-4z"/>
                            <path d="M9 12h6"/>
                            <path d="M12 9v6"/>
                        </svg>
                    </div>
                    <span class="logo-text">AI CỦA TÔI</span>
                </a>

                <!-- Header Category Pills -->
                <nav class="cat-nav-bar">
                    <a href="/" class="cat-pill">
                        <i class="fa-solid fa-house"></i> Trang Chủ
                    </a>
                    <a href="/products" class="cat-pill">
                        <i class="fa-solid fa-cubes"></i> Kho Tài Nguyên AI
                    </a>
                    <a href="/products?category=api-token" class="cat-pill">
                        <i class="fa-solid fa-key"></i> API Token AI
                    </a>
                    <a href="/posts" class="cat-pill">
                        <i class="fa-solid fa-newspaper"></i> Tin Tức & HD
                    </a>
                    <a href="https://zalo.me/0569012134" target="_blank" class="cat-pill">
                        <i class="fa-solid fa-headset"></i> Kỹ Thuật Zalo
                    </a>
                </nav>

                <!-- Search Input with / badge -->
                <div class="search-wrapper">
                    <i class="fa-solid fa-magnifying-glass search-icon-left"></i>
                    <input type="text" class="search-input" id="search-input" placeholder="Tìm tài khoản, dịch vụ...">
                    <span class="search-shortcut-badge">/</span>
                </div>

                <!-- Nav Actions -->
                <div class="nav-actions">
                    @include('partials.user-nav')
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/"><i class="fa-solid fa-house"></i> Trang Chủ</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Ví Của Tôi</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span style="color: var(--text-main); font-weight: 600;">Nạp Tiền & Lịch Sử</span>
        </div>

        <!-- Hero Wallet Card -->
        <div class="wallet-hero">
            <div class="wallet-hero-left">
                <div class="wallet-hero-badge">
                    <span class="wallet-pulse-dot"></span>
                    Cổng Nạp VietQR SePay Tự Động 24/7
                </div>
                <div class="wallet-hero-balance-label">Số dư khả dụng hiện tại:</div>
                <div class="wallet-hero-balance-val">
                    <span id="hero-user-balance">{{ number_format($user->balance ?? 0, 0, ',', '.') }}</span> <span style="font-size: 1.8rem; font-weight: 700;">₫</span>
                </div>
                <div class="wallet-hero-desc">
                    Số dư ví được sử dụng để thanh toán tức thì mọi tài khoản, gói dịch vụ AI và API Token trên toàn hệ thống mà không cần quét mã lại mỗi lần mua.
                </div>
            </div>
            <div class="wallet-hero-right">
                <div class="hero-stat-card">
                    <div class="hero-stat-label"><i class="fa-solid fa-cart-shopping"></i> Đã chi tiêu</div>
                    <div class="hero-stat-val" id="hero-total-spent">{{ number_format($user->total_spent ?? 0, 0, ',', '.') }} ₫</div>
                </div>
                <div class="hero-stat-card">
                    <div class="hero-stat-label"><i class="fa-solid fa-bolt"></i> Tốc độ cộng tiền</div>
                    <div class="hero-stat-val">3 - 30 giây</div>
                </div>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="wallet-main-grid">
            <!-- Left Column: Choose Amount & QR -->
            <div class="card-box">
                <h2 class="card-title">
                    <i class="fa-solid fa-qrcode"></i>
                    1. Chọn Số Tiền Cần Nạp
                </h2>

                <label class="amount-selector-label">Chọn nhanh mệnh giá:</label>
                <div class="preset-grid">
                    @foreach($presets as $idx => $preset)
                        <button type="button" class="preset-btn {{ $idx === 1 ? 'active' : '' }}" data-amount="{{ $preset }}">
                            {{ number_format($preset, 0, ',', '.') }}đ
                        </button>
                    @endforeach
                </div>

                <label class="amount-selector-label" for="custom-amount-input">Hoặc nhập số tiền tùy chọn (tối thiểu 10.000đ):</label>
                <div class="custom-input-group">
                    <input type="number" id="custom-amount-input" value="100000" min="10000" step="10000" placeholder="100000">
                    <span class="currency-suffix">VND</span>
                </div>

                <!-- Dynamic QR Box -->
                <div class="qr-display-box">
                    <img id="qr-code-image" class="qr-code-img" src="https://img.vietqr.io/image/{{ $bankId }}-{{ $accountNo }}-compact2.png?amount=100000&addInfo={{ rawurlencode($transferContent) }}&accountName={{ rawurlencode($accountName) }}" alt="VietQR Nạp Tiền">
                    <div class="qr-instructions">
                        <i class="fa-solid fa-camera"></i> Mở ứng dụng Ngân hàng hoặc MoMo quét mã QR trên để chuyển khoản nhanh với thông tin đã điền sẵn 100%.
                    </div>
                </div>
            </div>

            <!-- Right Column: Bank Details & Syntax -->
            <div class="card-box">
                <h2 class="card-title">
                    <i class="fa-solid fa-building-columns"></i>
                    2. Thông Tin Chuyển Khoản Thủ Công
                </h2>

                <div class="bank-info-table">
                    <div class="bank-info-row">
                        <span class="bank-info-label"><i class="fa-solid fa-landmark"></i> Ngân hàng:</span>
                        <div class="bank-info-content">
                            <span class="bank-info-val">{{ $bankId }}</span>
                            <button type="button" class="btn-copy" data-copy="{{ $bankId }}"><i class="fa-regular fa-copy"></i> Sao chép</button>
                        </div>
                    </div>

                    <div class="bank-info-row">
                        <span class="bank-info-label"><i class="fa-solid fa-credit-card"></i> Số tài khoản:</span>
                        <div class="bank-info-content">
                            <span class="bank-info-val">{{ $accountNo }}</span>
                            <button type="button" class="btn-copy" data-copy="{{ $accountNo }}"><i class="fa-regular fa-copy"></i> Sao chép</button>
                        </div>
                    </div>

                    <div class="bank-info-row">
                        <span class="bank-info-label"><i class="fa-solid fa-user-check"></i> Chủ tài khoản:</span>
                        <div class="bank-info-content">
                            <span class="bank-info-val">{{ $accountName }}</span>
                            <button type="button" class="btn-copy" data-copy="{{ $accountName }}"><i class="fa-regular fa-copy"></i> Sao chép</button>
                        </div>
                    </div>

                    <div class="bank-info-row">
                        <span class="bank-info-label"><i class="fa-solid fa-money-bill-wave"></i> Số tiền nạp:</span>
                        <div class="bank-info-content">
                            <span class="bank-info-val highlight-amount" id="display-amount">100.000 đ</span>
                            <button type="button" class="btn-copy" id="copy-amount-btn" data-copy="100000"><i class="fa-regular fa-copy"></i> Sao chép</button>
                        </div>
                    </div>

                    <div class="bank-info-row" style="background: #fffbeb; border-color: #fde68a;">
                        <span class="bank-info-label" style="color: #b45309;"><i class="fa-solid fa-pen-nib"></i> Nội dung CK:</span>
                        <div class="bank-info-content">
                            <span class="bank-info-val highlight-syntax" id="display-syntax">{{ $transferContent }}</span>
                            <button type="button" class="btn-copy" data-copy="{{ $transferContent }}" style="background: #f59e0b; color: #ffffff; border-color: #f59e0b;"><i class="fa-regular fa-copy"></i> Sao chép</button>
                        </div>
                    </div>
                </div>

                <!-- Warning Notice -->
                <div class="warning-notice-box">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div class="warning-notice-text">
                        <strong>LƯU Ý RẤT QUAN TRỌNG:</strong><br>
                        Vui lòng chuyển <strong>chính xác nội dung: <u>{{ $transferContent }}</u></strong>. Hệ thống tự động nhận diện theo mã này và cộng tiền sau 3 - 30 giây. Không sửa đổi hoặc thêm bớt ký tự nào trong nội dung chuyển khoản.
                    </div>
                </div>

                <!-- Live Polling Radar -->
                <div class="status-listening-box">
                    <div class="status-spinner"></div>
                    <div class="status-listening-text">
                        Đang lắng nghe giao dịch chuyển khoản... Hệ thống sẽ tự động cập nhật số dư ngay khi ngân hàng nhận tiền.
                    </div>
                </div>
            </div>
        </div>

        <!-- History Section -->
        <div class="history-section" id="history">
            <div class="card-box">
                <h2 class="card-title">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    Lịch Sử Biến Động Số Dư
                </h2>

                <div class="table-responsive">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Thời Gian</th>
                                <th>Mã GD / Tham Chiếu</th>
                                <th>Loại Giao Dịch</th>
                                <th>Số Tiền Biến Động</th>
                                <th>Số Dư Trước</th>
                                <th>Số Dư Sau</th>
                                <th>Mô Tả / Nội Dung</th>
                                <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody id="history-table-body">
                            @forelse($transactions as $trans)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($trans->created_at)->format('H:i d/m/Y') }}</td>
                                    <td>
                                        <code style="font-size: 0.82rem; color: #64748b;">
                                            {{ $trans->sepay_transaction_id ?? ('GD#' . $trans->id) }}
                                        </code>
                                    </td>
                                    <td>
                                        @if($trans->type === 'deposit')
                                            <span class="badge-deposit"><i class="fa-solid fa-arrow-down-long"></i> Nạp tiền ví</span>
                                        @elseif($trans->type === 'purchase')
                                            <span class="badge-purchase"><i class="fa-solid fa-arrow-up-long"></i> Thanh toán</span>
                                        @else
                                            <span class="badge-completed">{{ ucfirst($trans->type) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($trans->type === 'deposit')
                                            <strong style="color: #16a34a;">+{{ number_format($trans->amount, 0, ',', '.') }}đ</strong>
                                        @else
                                            <strong style="color: #dc2626;">-{{ number_format($trans->amount, 0, ',', '.') }}đ</strong>
                                        @endif
                                    </td>
                                    <td>{{ number_format($trans->balance_before, 0, ',', '.') }}đ</td>
                                    <td><strong>{{ number_format($trans->balance_after, 0, ',', '.') }}đ</strong></td>
                                    <td style="max-width: 260px; font-size: 0.8rem; color: var(--text-dark);">
                                        {{ $trans->description }}
                                    </td>
                                    <td>
                                        <span class="badge-completed"><i class="fa-solid fa-circle-check"></i> Thành công</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-history-box">
                                            <i class="fa-solid fa-receipt"></i>
                                            <p>Chưa có giao dịch nào được ghi nhận.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($transactions->hasPages())
                    <div style="margin-top: 1.25rem;">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Success Modal -->
    <div class="modal-overlay" id="success-modal">
        <div class="modal-box">
            <div class="modal-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h3 class="modal-title">Nạp Tiền Thành Công!</h3>
            <p class="modal-desc" id="modal-success-desc">
                Hệ thống đã nhận được tiền và cộng ngay vào số dư ví của bạn.
            </p>
            <button type="button" class="btn-modal-close" id="btn-close-modal">Tuyệt Vời! Tiếp Tục Mua Sắm</button>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-notif" id="toast-notif">
        <i class="fa-solid fa-circle-check" style="color: #4ade80;"></i>
        <span id="toast-message">Đã sao chép vào bộ nhớ tạm!</span>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            &copy; {{ date('Y') }} AI CỦA TÔI. Hệ Thống Tài Nguyên AI & Dịch Vụ Số Chuẩn Quốc Tế.
        </div>
    </footer>

    <script>
        const bankId = "{{ $bankId }}";
        const accountNo = "{{ $accountNo }}";
        const accountName = "{{ rawurlencode($accountName) }}";
        const transferContent = "{{ $transferContent }}";
        let currentBalance = {{ (int) ($user->balance ?? 0) }};

        const presetBtns = document.querySelectorAll('.preset-btn');
        const customAmountInput = document.getElementById('custom-amount-input');
        const qrCodeImg = document.getElementById('qr-code-image');
        const displayAmount = document.getElementById('display-amount');
        const copyAmountBtn = document.getElementById('copy-amount-btn');
        const toast = document.getElementById('toast-notif');
        const toastMsg = document.getElementById('toast-message');

        function formatCurrency(num) {
            return new Intl.NumberFormat('vi-VN').format(num);
        }

        function updateQR(amount) {
            if (!amount || amount < 1000) amount = 10000;
            displayAmount.textContent = formatCurrency(amount) + ' đ';
            copyAmountBtn.setAttribute('data-copy', amount);

            const qrUrl = `https://img.vietqr.io/image/${bankId}-${accountNo}-compact2.png?amount=${amount}&addInfo=${encodeURIComponent(transferContent)}&accountName=${accountName}`;
            qrCodeImg.src = qrUrl;
        }

        // Preset amount clicks
        presetBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                presetBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const amt = parseInt(this.getAttribute('data-amount'));
                customAmountInput.value = amt;
                updateQR(amt);
            });
        });

        // Custom amount typing
        customAmountInput.addEventListener('input', function() {
            const amt = parseInt(this.value) || 0;
            presetBtns.forEach(b => {
                if (parseInt(b.getAttribute('data-amount')) === amt) {
                    b.classList.add('active');
                } else {
                    b.classList.remove('active');
                }
            });
            updateQR(amt);
        });

        // Copy functionality
        function showToast(message) {
            toastMsg.textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }

        document.querySelectorAll('.btn-copy').forEach(btn => {
            btn.addEventListener('click', function() {
                const text = this.getAttribute('data-copy');
                if (!text) return;
                navigator.clipboard.writeText(text).then(() => {
                    const originalHtml = this.innerHTML;
                    this.classList.add('copied');
                    this.innerHTML = '<i class="fa-solid fa-check"></i> Đã sao chép';
                    showToast(`Đã sao chép: ${text}`);
                    setTimeout(() => {
                        this.classList.remove('copied');
                        this.innerHTML = originalHtml;
                    }, 2000);
                }).catch(err => {
                    showToast('Không thể sao chép tự động, vui lòng chọn và copy thủ công.');
                });
            });
        });

        // Success Modal close
        const successModal = document.getElementById('success-modal');
        const btnCloseModal = document.getElementById('btn-close-modal');
        if (btnCloseModal && successModal) {
            btnCloseModal.addEventListener('click', () => {
                successModal.classList.remove('show');
                window.location.reload();
            });
        }

        // Real-time Balance Poller (every 3.5s)
        function pollBalance() {
            fetch('/api/wallet/balance', {
                headers: { 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.balance > currentBalance) {
                    const added = data.balance - currentBalance;
                    currentBalance = data.balance;

                    // Update UI elements
                    document.querySelectorAll('.user-pill-balance').forEach(el => el.textContent = data.balance_formatted);
                    document.querySelectorAll('.wallet-card-amount').forEach(el => el.textContent = data.balance_formatted);
                    const heroBal = document.getElementById('hero-user-balance');
                    if (heroBal) heroBal.textContent = formatCurrency(data.balance);

                    // Show Modal
                    document.getElementById('modal-success-desc').innerHTML = 
                        `Hệ thống vừa nhận được số tiền nạp <strong>+${formatCurrency(added)}đ</strong>.<br>Số dư ví hiện tại của bạn là: <strong>${data.balance_formatted}</strong>.`;
                    successModal.classList.add('show');
                }
            })
            .catch(err => console.error("Balance polling error:", err));
        }

        setInterval(pollBalance, 3500);
    </script>
</body>
</html>
