@php
    $apiCatalog = request()->is('products') && request()->query('category') === 'api-token';
    $siteLinks = [
        ['href' => '/', 'label' => 'Trang Chủ', 'icon' => 'house', 'active' => request()->is('/')],
        ['href' => '/products', 'label' => 'Kho Tài Nguyên AI', 'icon' => 'cubes', 'active' => (request()->is('products', 'product/*') && !$apiCatalog)],
        ['href' => '/products?category=api-token', 'label' => 'API Token AI', 'icon' => 'key', 'active' => $apiCatalog],
        ['href' => '/posts', 'label' => 'Hướng Dẫn & Tin Tức', 'icon' => 'newspaper', 'active' => request()->is('posts', 'post/*')],
        ['href' => 'https://zalo.me/0569012134', 'label' => 'Kỹ Thuật Zalo', 'icon' => 'headset', 'active' => false, 'external' => true],
    ];
@endphp
<div class="site-ticker">
    <div class="site-ticker-track">
        @for($copy = 0; $copy < 2; $copy++)
            <div class="site-ticker-content" @if($copy) aria-hidden="true" @endif>
                <span>Nhập mã <strong>AI2026</strong> giảm ngay 20% toàn bộ tài khoản AI</span>
                <span><i class="fa-solid fa-bolt"></i> Hệ thống kích hoạt tài nguyên AI tự động trong 30 giây</span>
                <span><i class="fa-solid fa-shield-halved"></i> Cam kết bảo hành 1 đổi 1 suốt thời gian sử dụng</span>
                <span><i class="fa-solid fa-lock"></i> Tài khoản Private chính chủ — Bảo mật dữ liệu 100%</span>
                <span><i class="fa-solid fa-headset"></i> Đội ngũ kỹ thuật hỗ trợ xuyên đêm 24/7 qua Zalo</span>
            </div>
        @endfor
    </div>
</div>
<header class="site-header" data-site-header>
    <div class="site-navbar">
        <a href="/" class="site-logo" aria-label="AI CỦA TÔI — Trang chủ">
            <span class="site-logo-symbol">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 2a4 4 0 0 0-4 4v1a3 3 0 0 0-3 3v2a3 3 0 0 0 2 2.82V16a4 4 0 0 0 4 4h2a4 4 0 0 0 4-4v-1.18A3 3 0 0 0 19 12v-2a3 3 0 0 0-3-3V6a4 4 0 0 0-4-4z"/>
                    <path d="M9 12h6M12 9v6"/>
                </svg>
            </span>
            <span>AI CỦA TÔI</span>
        </a>
        <nav class="site-links" id="site-navigation" aria-label="Điều hướng chính">
            @foreach($siteLinks as $link)
                <a href="{{ $link['href'] }}" class="site-link {{ $link['active'] ? 'is-active' : '' }}"
                    @if($link['active']) aria-current="page" @endif
                    @if($link['external'] ?? false) target="_blank" rel="noopener noreferrer" @endif>
                    <i class="fa-solid fa-{{ $link['icon'] }}" aria-hidden="true"></i> {{ $link['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="site-actions">
            <button type="button" class="site-icon-button site-menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="Mở menu" data-site-menu-toggle>
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>
            <a href="/checkout" class="site-icon-button" id="open-cart-btn" aria-label="Giỏ hàng">
                <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                <span class="site-cart-count" id="cart-count">0</span>
            </a>
            @include('partials.user-nav')
        </div>
    </div>
</header>
