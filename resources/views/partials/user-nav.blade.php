<style>
    /* User Profile Pill */
    .user-menu-wrapper {
        position: relative;
        z-index: 1000;
    }
    .user-pill-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        padding: 0.28rem 0.85rem 0.28rem 0.35rem;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 9999px;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
        outline: none;
        user-select: none;
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
        top: calc(100% + 0.65rem);
        right: 0;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        width: 270px;
        padding: 0.65rem 0;
        display: none;
        z-index: 500;
        animation: slideDownNav 0.2s ease;
        display: none !important;
        z-index: 99999;
    }
    .user-dropdown-menu.show {
        display: block;
        display: block !important;
        animation: slideDownNav 0.15s ease-out;
    }
    @keyframes slideDownNav {
        from { opacity: 0; transform: translateY(-8px); }
        from { opacity: 0; transform: translateY(-6px); }
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
        text-align: left;
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
        text-align: left;
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
        color: #334155;
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 600;
        transition: all 0.2s;
        cursor: pointer;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        font-family: inherit;
    }
    .user-dropdown-item:hover {
        background: #f8fafc;
        color: #0284c7;
    }
    .user-dropdown-item.logout-btn-item:hover {
        background: #fef2f2;
        color: #ef4444 !important;
    }
    .btn-login-header {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.45rem 1rem;
        background: #0284c7;
        color: #ffffff !important;
        font-size: 0.82rem;
        font-weight: 700;
        border-radius: 9999px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-login-header:hover {
        background: #0369a1;
        box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25);
    }
</style>

@auth
    <!-- User Profile Pill Button -->
    <div class="user-menu-wrapper">
        <button class="user-pill-btn user-menu-btn" type="button" aria-expanded="false" title="Tài khoản: {{ auth()->user()->name }}">
            <div class="user-pill-avatar">
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0284c7&color=fff&bold=true" alt="{{ auth()->user()->name }}">
                @endif
            </div>
            <div class="user-pill-info">
                <span class="user-pill-name">{{ Str::limit(auth()->user()->name, 11) }}</span>
                <span class="user-pill-balance">{{ number_format(auth()->user()->balance ?? 0, 0, ',', '.') }}đ</span>
            </div>
            <i class="fa-solid fa-chevron-down user-pill-arrow"></i>
        </button>

        <!-- Dropdown Menu -->
        <div class="user-dropdown-menu">
            <div class="user-dropdown-header">
                <div class="user-dropdown-user-row">
                    <div class="dropdown-avatar">
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0284c7&color=fff&bold=true" alt="{{ auth()->user()->name }}">
                        @endif
                    </div>
                    <div class="dropdown-user-meta">
                        <span class="user-display-name">{{ auth()->user()->name }}</span>
                        <span class="user-display-email">{{ auth()->user()->email }}</span>
                    </div>
                </div>
                <div class="user-wallet-card">
                    <div class="wallet-card-header">
                        <span class="wallet-card-label"><i class="fa-solid fa-wallet"></i> Số dư ví web</span>
                        <span class="wallet-card-amount">{{ number_format(auth()->user()->balance ?? 0, 0, ',', '.') }}đ</span>
                    </div>
                    <a href="/wallet" class="wallet-card-btn"><i class="fa-solid fa-plus-circle"></i> Nạp tiền</a>
                </div>
            </div>
            <div class="user-dropdown-divider"></div>
            @if(auth()->user()->isAdmin())
                <a href="/admin/dashboard" class="user-dropdown-item" style="color: #ef4444; font-weight: 700;">
                    <i class="fa-solid fa-shield-halved"></i> Quản Trị Hệ Thống
                </a>
                <div class="user-dropdown-divider"></div>
            @endif
            <a href="/wallet" class="user-dropdown-item" style="color: #0284c7;">
                <i class="fa-solid fa-wallet"></i> Nạp tiền vào ví
            </a>
            <a href="/wallet#history" class="user-dropdown-item">
                <i class="fa-solid fa-clock-rotate-left"></i> Lịch sử giao dịch ví
            </a>
            <a href="/orders" class="user-dropdown-item">
                <i class="fa-solid fa-receipt"></i> Đơn hàng đã mua
            </a>
            <a href="/profile" class="user-dropdown-item">
                <i class="fa-solid fa-user-gear"></i> Thiết lập tài khoản
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
    <a href="{{ route('login') }}" class="btn-login-header">
        <i class="fa-solid fa-user"></i> Đăng Nhập
    </a>
@endauth

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.user-menu-wrapper').forEach(function (wrapper) {
            const button = wrapper.querySelector('.user-pill-btn');
            const menu = wrapper.querySelector('.user-dropdown-menu');
            if (!button || !menu) return;

            function setOpen(open) {
                menu.classList.toggle('show', open);
                button.setAttribute('aria-expanded', String(open));
            }

            button.addEventListener('click', function () {
                setOpen(!menu.classList.contains('show'));
            });
            document.addEventListener('click', function (event) {
                if (!wrapper.contains(event.target)) setOpen(false);
            });
            wrapper.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    setOpen(false);
                    button.focus();
                }
            });
        });
    });
</script>
