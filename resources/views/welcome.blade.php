<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampRent - Sewa Alat Camping Mudah & Praktis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fbf9;
            color: #2d3748;
        }

        /* Navbar Custom */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.02);
        }
        .brand-logo {
            background: linear-gradient(135deg, #157347, #20c997);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            margin-right: 8px;
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 0 80px 0;
            background: linear-gradient(135deg, #f4faf7 0%, #e8f5ee 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(32,201,151,0.1) 0%, rgba(255,255,255,0) 70%);
            z-index: 1;
        }

        /* Feature Cards */
        .feature-card {
            background: white;
            border: none;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(21, 115, 71, 0.03);
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(21, 115, 71, 0.06);
        }
        .feature-icon {
            width: 50px;
            height: 50px;
            background-color: #e8f5ee;
            color: #157347;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }

        .btn-success-gradient {
            background: linear-gradient(135deg, #157347, #198754);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.6rem 1.3rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .btn-success-gradient:hover {
            background: linear-gradient(135deg, #115c38, #157347);
            transform: translateY(-1px);
            color: white;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <span class="brand-logo"><i class="bi bi-tent"></i></span>
                CampRent
            </a>
            <div class="ms-auto d-flex gap-2">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-light rounded-pill px-4 fw-medium text-secondary btn-sm d-flex align-items-center">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-success-gradient rounded-pill px-4 btn-sm d-flex align-items-center">Daftar</a>
                @endguest

                @auth
                    <span class="navbar-text me-2 small text-success d-none d-sm-inline-block">
                        <i class="bi bi-person-circle"></i> Sesi Aktif ({{ Auth::user()->name }})
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-pill px-4 btn-sm fw-medium d-flex align-items-center">
                            <i class="bi bi-box-arrow-right me-1"></i> Clear Session (Logout)
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center min-vh-75 pt-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-3 fw-semibold">🏕️ Petualangan Menantimu</span>
                    <h1 class="display-4 fw-extrabold text-dark mb-3" style="line-height: 1.2; font-weight: 800;">
                        Sewa Alat Camping <br><span class="text-success">Mudah & Lengkap</span>
                    </h1>
                    <p class="lead text-muted mb-4 fs-6">
                        CampRent menyediakan berbagai kebutuhan peralatan outdoor mulai dari tenda, carier, hingga perlengkapan memasak dengan kualitas terbaik dan harga terjangkau.
                    </p>
                    <div class="d-sm-flex justify-content-center justify-content-lg-start gap-3">
                        <a href="{{ route('register') }}" class="btn btn-success-gradient btn-lg px-4 fs-6 rounded-pill mb-2 mb-sm-0 shadow-sm">
                            Mulai Sewa Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="#fitur" class="btn btn-outline-secondary btn-lg px-4 fs-6 rounded-pill">
                            Pelajari Fitur
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center position-relative">
                    <div class="p-5 bg-white shadow-sm rounded-circle d-inline-block position-relative animate-bounce" style="width: 320px; height: 320px; background: linear-gradient(135deg, #ffffff, #f0fdf4) !important;">
                        <i class="bi bi-tree text-success position-absolute" style="font-size: 5rem; top: 15%; left: 15%; opacity: 0.2;"></i>
                        <i class="bi bi-tent text-success position-absolute" style="font-size: 8rem; top: 50%; start: 50%; transform: translate(-50%, -50%);"></i>
                        <i class="bi bi-compass text-warning position-absolute" style="font-size: 3rem; bottom: 10%; right: 15%; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="fitur" class="container py-5 my-4">
        <div class="text-center mb-5">
            <h3 class="fw-bold">Kenapa Memilih CampRent?</h3>
            <p class="text-muted small">Kemudahan penjelajahan alam dalam satu genggaman tangan.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card">
                    <div class="feature-icon"><i class="bi bi-check-circle-fill"></i></div>
                    <h5 class="fw-bold">Alat Berkualitas</h5>
                    <p class="text-muted small mb-0">Semua perlengkapan dipastikan bersih, kokoh, dan siap pakai sebelum masuk ke tangan kamu.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card">
                    <div class="feature-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                    <h5 class="fw-bold">Booking Cepat</h5>
                    <p class="text-muted small mb-0">Pilih alat, tentukan tanggal, lakukan pembayaran, dan ambil barang tanpa antre berlama-lama.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card">
                    <div class="feature-icon"><i class="bi bi-shield-lock-fill"></i></div>
                    <h5 class="fw-bold">Verifikasi Aman</h5>
                    <p class="text-muted small mb-0">Sistem keamanan data terjamin untuk proses jaminan sewa yang transparan antara admin dan pelanggan.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-top py-4 mt-5 text-center text-muted small">
        <div class="container">
            &copy; 2026 CampRent. Aplikasi Web Sistem Informasi Manajemen Rental Alat Camping.
        </div>
    </footer >

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>