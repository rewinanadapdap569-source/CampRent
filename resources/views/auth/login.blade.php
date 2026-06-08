<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampRent - Masuk ke Akun</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f4f7f6 0%, #e9f5ee 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #ffffff;
            border: none;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(21, 115, 71, 0.06);
            max-width: 450px;
            width: 100%;
        }
        .brand-logo {
            background: linear-gradient(135deg, #157347, #20c997);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            box-shadow: 0 4px 15px rgba(21, 115, 71, 0.2);
            margin: 0 auto 1rem auto;
        }
        .form-control:focus {
            border-color: #157347;
            box-shadow: 0 0 0 0.25rem rgba(21, 115, 71, 0.15);
        }
        .btn-login {
            background: linear-gradient(135deg, #157347, #198754);
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="card login-card p-4 p-md-5">
        
        <div class="text-center mb-4">
            <div class="brand-logo"><i class="bi bi-tent"></i></div>
            <h3 class="fw-bold text-dark m-0">Selamat Datang</h3>
            <p class="text-muted small">Masuk untuk mengelola rental alat campingmu</p>
        </div>

        <!-- Form Login diarahkan ke AuthController -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Input Email -->
            <div class="mb-3">
                <label for="email" class="form-label small fw-semibold text-secondary">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                @if($errors->has('email'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <!-- Input Password -->
            <div class="mb-4">
                <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>

            <!-- Button Submit -->
            <button type="submit" class="btn btn-primary btn-login w-100 text-white mb-3">Masuk</button>

            <div class="text-center">
                <span class="small text-muted">Belum punya akun? </span>
                <a href="{{ route('register') }}" class="small fw-semibold text-success text-decoration-none">Daftar di sini</a>
            </div>
        </form>

    </div>
</div>

</body>
</html>