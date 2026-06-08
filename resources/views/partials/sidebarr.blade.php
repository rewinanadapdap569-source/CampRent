<div class="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">

        <div class="logo-wrapper">

            <div class="logo-icon">
                <i class="fa-solid fa-mountain"></i>
            </div>

            <div class="logo-text">
                <h2>CampRent</h2>
                <span>Sewa Alat Camping</span>
            </div>

        </div>

    </div>

    <!-- Menu -->
    <div class="sidebar-menu">

        <a href="{{ route('dashboard') }}"
           class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">

            <i class="fa-solid fa-chart-line"></i>
            <span>Dashboard</span>

        </a>

        <a href="{{ route('alat.index') }}"
           class="menu-item {{ request()->routeIs('alat.*') ? 'active' : '' }}">

            <i class="fa-solid fa-tent"></i>
            <span>Alat Camping</span>

        </a>

        <a href="{{ route('kategori.index') }}"
           class="menu-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">

            <i class="fa-solid fa-layer-group"></i>
            <span>Kategori</span>

        </a>

        <a href="{{ route('penyewaan.index') }}"
           class="menu-item {{ request()->routeIs('penyewaan.*') ? 'active' : '' }}">

            <i class="fa-solid fa-cart-shopping"></i>
            <span>Penyewaan</span>

        </a>

        <a href="{{ route('pengembalian.index') }}"
           class="menu-item {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">

            <i class="fa-solid fa-arrow-rotate-left"></i>
            <span>Pengembalian</span>

        </a>

        <a href="{{ route('pembayaran.index') }}"
           class="menu-item {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">

            <i class="fa-solid fa-credit-card"></i>
            <span>Pembayaran</span>

        </a>

        <a href="{{ route('jaminan.index') }}"
           class="menu-item {{ request()->routeIs('jaminan.*') ? 'active' : '' }}">

            <i class="fa-solid fa-id-card"></i>
            <span>Jaminan</span>

        </a>

        <a href="{{ route('pelanggan.index') }}"
           class="menu-item {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">

            <i class="fa-solid fa-users"></i>
            <span>Pelanggan</span>

        </a>

        <a href="{{ route('laporan.index') }}"
           class="menu-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">

            <i class="fa-solid fa-file-lines"></i>
            <span>Laporan</span>

        </a>

        <a href="{{ route('pengaturan.index') }}"
           class="menu-item {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">

            <i class="fa-solid fa-gear"></i>
            <span>Pengaturan</span>

        </a>

    </div>

    <!-- Footer Sidebar -->
    <div class="sidebar-footer">

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-btn">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Logout</span>

            </button>

        </form>

    </div>

</div>