<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CampRent - Sistem Rental Alat Camping')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        :root {
            --primary: #157347; --primary-dark: #14532d; --primary-light: #20c997;
            --sidebar-start: #0f172a; --sidebar-end: #1e293b;
            --background: #f8fafc; --card: #ffffff; --text: #0f172a; --text-light: #64748b; --border: #e2e8f0;
        }
        body { background-color: var(--background); color: var(--text); min-height: 100vh; }
        .wrapper { display: block; position: relative; min-height: 100vh; }
        .main-content { margin-left: 280px; min-height: 100vh; display: flex; flex-direction: column; transition: all 0.3s ease; }
        .main-header { background: var(--card); height: 80px; padding: 0 35px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border); }
        .main-header h1 { font-size: 20px; font-weight: 700; color: var(--text); margin: 0; }
        .user-profile { display: flex; align-items: center; gap: 12px; }
        .user-profile img { width: 40px; height: 40px; border-radius: 50px; object-fit: cover; }
        .user-info h4 { font-size: 14px; font-weight: 600; color: var(--text); margin: 0; }
        .user-info p { margin: 0; color: var(--text-light); font-size: 12px; }
        .content-body { padding: 35px; flex: 1; }
        @media(max-width: 992px) { .main-content { margin-left: 0; } }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        @include('partials.sidebarr') 

        <div class="main-content">
            <header class="main-header">
                <h1>@yield('page-title', 'Dashboard')</h1>
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=157347&color=fff" alt="Avatar">
                    <div class="user-info">
                        <h4>{{ Auth::user()->name ?? 'Admin' }}</h4>
                        <p class="text-capitalize">{{ Auth::user()->role ?? 'Administrator' }}</p>
                    </div>
                </div>
            </header>
            <main class="content-body">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>