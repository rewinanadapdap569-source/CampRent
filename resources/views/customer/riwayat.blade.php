<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penyewaan Anda - CampRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        :root { --primary: #157347; --bg: #f8fbf9; }
        body { background-color: var(--bg); font-family: 'Inter', sans-serif; }
    </style>
</head>
<body>

<div class="container py-5" style="max-width: 900px;">
    <div class="mb-4">
        <a href="{{ route('customer.katalog') }}" class="text-decoration-none text-success small fw-bold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Katalog Produk
        </a>
    </div>

    <h4 class="fw-bold text-dark mb-4"><i class="fa-solid fa-receipt text-success me-2"></i>Daftar Transaksi Sewa Anda</h4>

    @if(session('success'))
        <div class="alert alert-success border-0 mb-4" style="border-radius:12px;">
            <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
        </div>
    @endif

    @forelse($riwayat as $item)
        <div class="card border-0 p-4 mb-3 shadow-sm" style="border-radius: 16px; background: #fff;">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="badge {{ $item->status == 'Diproses' ? 'bg-warning-subtle text-warning' : ($item->status == 'Dipinjam' ? 'bg-primary-subtle text-primary' : 'bg-success-subtle text-success') }} px-3 py-2 mb-2" style="border-radius:8px;">
                        {{ $item->status }}
                    </span>
                    <h5 class="fw-bold text-dark mb-1">{{ $item->alat->nama_alat }}</h5>
                    <small class="text-muted d-block">Durasi Pinjam: <strong>{{ \Carbon\Carbon::parse($item->start_date)->format('d M') }} s/d {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}</strong></small>
                </div>
                <div class="col-md-3 text-md-end my-3 my-md-0">
                    <small class="text-muted d-block small" style="font-size:11px;">Total Bayar</small>
                    <span class="fw-bold text-success fs-5">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span>
                    <small class="text-muted d-block">({{ $item->jumlah_sewa }} Unit)</small>
                </div>
                <div class="col-md-3 text-md-end">
                    @if($item->status == 'Diproses')
                        <form action="{{ route('customer.sewa.batal', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan rental ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger px-3 py-2" style="border-radius:10px;">
                                <i class="fa-solid fa-trash-can me-1"></i> Batalkan Sewa
                            </button>
                        </form>
                    @else
                        <span class="text-muted small"><i class="fa-solid fa-lock me-1"></i> Tidak bisa diubah</span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5 bg-white shadow-sm" style="border-radius: 16px;">
            <i class="fa-solid fa-receipt fa-3x text-muted mb-3 opacity-20"></i>
            <p class="text-muted">Anda belum memiliki riwayat transaksi penyewaan apa pun.</p>
        </div>
    @endforelse
</div>

</body>
</html>