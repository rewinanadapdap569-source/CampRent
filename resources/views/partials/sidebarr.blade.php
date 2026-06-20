<style>
    /* Styling khusus komponen Sidebar CampRent */
    .sidebar {
        width: 280px;
        background: linear-gradient(180deg, var(--sidebar-start) 0%, var(--sidebar-end) 100%);
        color: #ffffff;
        position: fixed;
        top: 0; 
        left: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
        border-top-right-radius: 24px;
        border-bottom-right-radius: 24px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        z-index: 1000;
    }

    /* Bagian Logo Atas */
    .sidebar-logo {
        padding: 30px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    .logo-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .logo-icon {
        width: 42px;
        height: 42px;
        background: var(--primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 4px 15px rgba(21, 115, 71, 0.3);
    }
    .logo-text h2 {
        font-size: 20px;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        line-height: 1.2;
    }
    .logo-text span {
        font-size: 11px;
        color: #cbd5e1;
        display: block;
    }

    /* Bagian List Menu Navigasi */
    .sidebar-menu {
        padding: 25px 15px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 5px;
        overflow-y: auto;
    }
    
    /* Scrollbar halus untuk menu jika nanti menunya terlalu panjang */
    .sidebar-menu::-webkit-scrollbar {
        width: 4px;
    }
    .sidebar-menu::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 15px;
        color: #cbd5e1;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .menu-item i {
        width: 20px;
        text-align: center;
        font-size: 16px;
    }
    .menu-item:hover {
        background: rgba(255, 255, 255, 0.06);
        color: #ffffff;
        transform: translateX(5px);
    }

    /* Efek Menu Aktif Menyala Hijau */
    .menu-item.active {
        background: var(--primary) !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(21, 115, 71, 0.35);
    }

    /* Bagian Footer Tombol Keluar */
    .sidebar-footer {
        padding: 20px 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    .logout-btn {
        width: 100%;
        padding: 13px;
        background: #dc2626;
        color: #ffffff;
        border: none;
        border-radius: 14px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15);
    }
    .logout-btn:hover {
        background: #b91c1c;
        box-shadow: 0 6px 15px rgba(220, 38, 38, 0.25);
    }
</style>

<div class="sidebar">

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

    <div class="sidebar-menu">

        <a href="{{ route('pages.dashboard') }}"
           class="menu-item {{ request()->routeIs('pages.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('alat.index') }}"
           class="menu-item {{ request()->routeIs('alat.*') ? 'active' : '' }}">
            <i class="fa-solid fa-tent"></i>
            <span>Alat Camping</span>
        </a>

       <a href="{{ route('kategori.index') }}" class="menu-item {{ Request::routeIs('kategori.*') ? 'active' : '' }}">
    <i class="fa-solid fa-layer-group"></i>
    <span>Kategori</span>
</a>

        <a href="{{ route('admin.rental.index') }}" class="menu-item {{ request()->routeIs('admin.rental.*') ? 'active' : '' }}">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Penyewaan</span>
        </a>

        <a href="#" class="menu-item">
            <i class="fa-solid fa-arrow-rotate-left"></i>
            <span>Pengembalian</span>
        </a>

        <a href="#" class="menu-item">
            <i class="fa-solid fa-credit-card"></i>
            <span>Pembayaran</span>
        </a>

        <a href="#" class="menu-item">
            <i class="fa-solid fa-id-card"></i>
            <span>Jaminan</span>
        </a>

        <a href="#" class="menu-item">
            <i class="fa-solid fa-users"></i>
            <span>Pelanggan</span>
        </a>

        <a href="#" class="menu-item">
            <i class="fa-solid fa-file-lines"></i>
            <span>Laporan</span>
        </a>

        <a href="#" class="menu-item">
            <i class="fa-solid fa-gear"></i>
            <span>Pengaturan</span>
        </a>

    </div>

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