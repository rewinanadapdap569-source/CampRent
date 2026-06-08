<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampRent - Daftar Akun Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f4f7f6 0%, #e9f5ee 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .register-card {
            background: #ffffff;
            border: none;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(21, 115, 71, 0.06);
            overflow: hidden;
            max-width: 550px;
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

        /* Desain Custom Radio Box untuk Pilih Role */
        .role-option {
            display: none;
        }

        .role-label {
            border: 2px solid #e9ecef;
            border-radius: 16px;
            padding: 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: all 0.25s ease;
            background-color: #fff;
            height: 100%;
        }

        .role-label:hover {
            border-color: #157347;
            background-color: rgba(21, 115, 71, 0.02);
        }

        .role-option:checked + .role-label {
            border-color: #157347;
            background-color: rgba(21, 115, 71, 0.06);
            position: relative;
        }

        .role-option:checked + .role-label::after {
            content: '✓';
            position: absolute;
            top: 10px;
            right: 14px;
            color: #157347;
            font-weight: bold;
            font-size: 1rem;
        }

        .btn-register {
            background: linear-gradient(135deg, #157347, #198754);
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #115c38, #157347);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="card register-card p-4 p-md-5">
        
        <div class="text-center mb-4">
            <div class="brand-logo">
                <i class="bi bi-tent"></i>
            </div>
            <h3 class="fw-bold text-dark m-0">Gabung CampRent</h3>
            <p class="text-muted small">Daftar akun baru untuk mulai perjalanan campingmu</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label small fw-semibold text-secondary">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-person"></i></span>
                    <input type="text" id="name" name="name" class="form-control border-start-0" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap">
                </div>
                @if($errors->get('name'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label small fw-semibold text-secondary">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control border-start-0" value="{{ old('email') }}" required placeholder="nama@email.com">
                </div>
                @if($errors->get('email'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="nohp" class="form-label small fw-semibold text-secondary">Nomor HP / WhatsApp</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-phone"></i></span>
                    <input type="text" id="nohp" name="nohp" class="form-control border-start-0" value="{{ old('nohp') }}" required placeholder="Contoh: 0812345678">
                </div>
                @if($errors->get('nohp'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('nohp') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control border-start-0" required placeholder="Minimal 8 karakter">
                </div>
                @if($errors->get('password'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label small fw-semibold text-secondary">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-shield-lock"></i></span>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control border-start-0" required placeholder="Ulangi password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-register w-100 text-white mb-3">
                Daftar Sekarang <i class="bi bi-arrow-right-short ms-1"></i>
            </button>

            <div class="text-center">
                <span class="small text-muted">Sudah punya akun? </span>
                <a href="{{ route('login') }}" class="small fw-semibold text-success text-decoration-none">Masuk di sini</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>