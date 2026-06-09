<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Alat Camping - CampRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        :root { --primary: #157347; --bg: #f8fbf9; }
        body { background-color: var(--bg); font-family: 'Inter', sans-serif; }
        .navbar-brand { font-weight: 700; color: var(--primary); }
        .gear-card { border: none; border-radius: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.02); transition: transform 0.2s; overflow: hidden; background: #fff; }
        .gear-card:hover { transform: translateY(-5px); }
        .btn-rent { background-color: var(--primary); color: white; border-radius: 12px; border: none; font-weight: 600; }
        .btn-rent:hover { background-color: #115c38; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom py-3">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-mountain-sun me-2"></i>CampRent Customer</a>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('customer.riwayat') }}" class="btn btn-outline-success border-0 small fw-bold"><i class="fa-solid fa-clock-history me-1"></i> Riwayat Sewa</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger px-3 py-2" style="border-radius:10px;"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Pilih Perlengkapan Petualanganmu</h2>
        <p class="text-muted">Alat camping premium, bersih, dan siap pakai untuk menemani liburan alammu.</p>
    </div>

    <div class="row g-4">
        @forelse($daftarAlat as $alat)
            <div class="col-md-4">
                <div class="card gear-card p-3">
                    @if($alat->gambar)
                        <img src="{{ asset('images/alat/' . $alat->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover; border-radius: 14px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px; border-radius: 14px; color: #ccc;">
                            <i class="fa-solid fa-campground fa-3x"></i>
                        </div>
                    @endif
                    <div class="card-body px-1 pt-3 pb-0">
                        <span class="badge bg-success-subtle text-success mb-2 px-3 py-2" style="border-radius:8px;">{{ $alat->kategori }}</span>
                        <h5 class="card-title fw-bold text-dark mb-1">{{ $alat->nama_alat }}</h5>
                        <p class="text-muted small mb-3">Sisa Stok: <span class="fw-bold text-dark">{{ $alat->stok }} unit</span></p>
                        <div class="d-flex justify-content-between align-items-center border-top pt-3">
                            <div>
                                <small class="text-muted d-block" style="font-size:11px;">Harga Sewa / Hari</small>
                                <span class="fw-bold text-success fs-5">Rp {{ number_format($alat->harga_sewa, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('customer.sewa.form', $alat->id) }}" class="btn btn-rent px-4 py-2">Sewa <i class="fa-solid fa-arrow-right small ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="fa-solid fa-tents fa-3x mb-3 opacity-20"></i>
                <p>Maaf, saat ini seluruh logistik perlengkapan sedang disewa habis.</p>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>