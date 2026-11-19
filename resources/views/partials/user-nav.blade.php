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
