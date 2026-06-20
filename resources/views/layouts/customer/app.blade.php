<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampRent - Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        body { background-color: #f8fafc; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: #94a3b8;
            width: 260px;
            transition: 0.3s;
            flex-shrink: 0; /* Mencegah sidebar mengecil */
        }
        .nav-link {
            color: #94a3b8;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: 0.3s;
            text-decoration: none;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-left: 4px solid #3b82f6;
        }
        .sidebar-brand {
            font-weight: bold;
            color: white;
            padding: 25px 20px;
            text-align: center;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

    <div class="d-flex">
        
        <aside class="sidebar">
            <div class="sidebar-brand">CampRent</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('customer.dashboard') }}" class="nav-link {{ request()->is('customer/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-box-seam"></i> Katalog Alat</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-cart3"></i> Keranjang</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-clock-history"></i> Riwayat</a>
                </li>
                <li class="nav-item mt-5">
                    <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </aside>

        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>