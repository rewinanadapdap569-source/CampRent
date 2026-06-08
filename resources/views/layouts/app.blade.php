<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CampRent')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

   
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        :root {
            --primary: #16a34a;
            --primary-dark: #14532d;
            --primary-light: #22c55e;
            --sidebar-start: #0f172a;
            --sidebar-end: #14532d;
            --bg: #f8fafc;
            --card: #ffffff;
            --border: #e5e7eb;
            --text: #111827;
            --text-light: #6b7280;
        }

        body {
            background: var(--bg);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ==========================
           SIDEBAR STYLING
        ========================== */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--sidebar-start), var(--sidebar-end));
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,.15);
            z-index: 1000;
        }

        .logo {
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .logo img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .logo h2 {
            font-size: 22px;
            color: white;
            font-weight: 700;
        }

        .logo p {
            color: #cbd5e1;
            font-size: 12px;
        }

        .menu {
            padding: 20px 15px;
            flex: 1;
            overflow-y: auto;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #e2e8f0;
            padding: 14px 15px;
            border-radius: 14px;
            margin-bottom: 8px;
            transition: .3s;
        }

        .menu a i {
            width: 20px;
            text-align: center;
        }

        .menu a:hover {
            background: rgba(255,255,255,.08);
            transform: translateX(5px);
            color: white;
        }

        .menu a.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 10px 25px rgba(34,197,94,.3);
        }

        /* ==========================
           MAIN CONTENT AREA
        ========================== */
        .main {
            flex: 1;
            margin-left: 280px; /* Memberi ruang agar tidak tertutup sidebar fixed */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            height: 80px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
            border-bottom: 1px solid var(--border);
        }

        .header h1 {
            font-size: 24px;
            color: var(--text);
            font-weight: 700;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }

        .user h4 {
            font-size: 14px;
            color: var(--text);
        }

        .user p {
            color: var(--text-light);
            font-size: 12px;
        }

        .content {
            padding: 30px;
            flex: 1;
        }

        /* Responsive */
        @media(max-width: 768px) {
            .sidebar {
                display: none; /* Kamu bisa tambah burger menu nanti */
            }
            .main {
                margin-left: 0;
            }
        }
        <style>
    :root {
        --sidebar-bg: #1B4332;
        --accent: #D4A373;
        --text-light: #ffffff;
    }

    .sidebar {
        width: 260px;
        background: var(--sidebar-bg);
        height: 100vh;
        display: flex;
        flex-direction: column;
        color: white;
        padding: 20px;
    }

    .brand {
        font-size: 24px;
        font-weight: 700;
        padding: 20px 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .menu { display: flex; flex-direction: column; gap: 8px; flex: 1; }

    .menu-item {
        padding: 12px 16px;
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        border-radius: 10px;
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .menu-item:hover, .menu-item.active {
        background: var(--accent);
        color: white;
    }

    .logout-btn {
        width: 100%;
        padding: 12px;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    </style>
</head>
<body>
    <div class="wrapper" style="display: flex;">
        
        @include('partials.sidebarr') 

        <main class="main-content">
            @yield('content')
        </main>
        
    </div>
</body>
</html>