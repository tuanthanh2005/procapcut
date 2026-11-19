document.addEventListener('DOMContentLoaded', function () {
    const header = document.querySelector('[data-site-header]');
    if (!header) return;
    const toggle = header.querySelector('[data-site-menu-toggle]');
    function setMenuOpen(open) {
        header.classList.toggle('is-menu-open', open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Đóng menu' : 'Mở menu');
    }
    toggle.addEventListener('click', function () {
        setMenuOpen(!header.classList.contains('is-menu-open'));
    });
    document.addEventListener('click', function (event) {
        if (!header.contains(event.target)) setMenuOpen(false);
    });
    header.querySelectorAll('.site-link').forEach(function (link) {
        link.addEventListener('click', function () { setMenuOpen(false); });
    });
    header.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && header.classList.contains('is-menu-open')) {
            setMenuOpen(false);
            toggle.focus();
        }
    });

    header.querySelectorAll('.user-menu-wrapper').forEach(function (wrapper) {
        const button = wrapper.querySelector('.user-pill-btn');
        const menu = wrapper.querySelector('.user-dropdown-menu');
        if (!button || !menu) return;
        function setOpen(open) {
            menu.classList.toggle('show', open);
            button.setAttribute('aria-expanded', String(open));
        }
        button.addEventListener('click', function () { setOpen(!menu.classList.contains('show')); });
        document.addEventListener('click', function (event) {
            if (!wrapper.contains(event.target)) setOpen(false);
        });
        wrapper.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') { setOpen(false); button.focus(); }
        });
    });

    const cartButton = header.querySelector('#open-cart-btn');
    cartButton.addEventListener('click', function (event) {
        if (document.getElementById('cart-sidebar')) event.preventDefault();
    });
    // Pages without a cart drawer still show the same stored cart quantity.
    function updateCartCount() {
        try {
            const items = JSON.parse(localStorage.getItem('capcut_store_cart') || '[]');
            if (Array.isArray(items)) {
                header.querySelector('#cart-count').textContent = items.reduce(function (total, item) {
                    return total + Math.max(0, Number(item.quantity) || 1);
                }, 0);
            }
        } catch (_) { /* Keep the empty cart badge if stored data is invalid. */ }
    }
    updateCartCount();
    window.addEventListener('storage', updateCartCount);
});
