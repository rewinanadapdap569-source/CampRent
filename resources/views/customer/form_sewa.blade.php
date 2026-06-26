@extends('layouts.customer.app')

@section('content')
<div class="container-fluid animate__animated animate__fadeIn">
    <div class="mb-4">
        <a href="{{ route('customer.katalog') }}" class="text-decoration-none text-muted small fw-semibold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Katalog
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px; background: white;">
                <div style="height: 300px; background-color: #f1f5f9;">
                    @if($alat->gambar)
                        <img src="{{ asset('images/alat/' . $alat->gambar) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $alat->nama_alat }}">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                            <i class="bi bi-image fs-1"></i>
                        </div>
                    @endif
                </div>
                <div class="card-body p-4">
                    <span class="badge bg-purple-light text-primary mb-2 px-3 py-2 fw-bold" style="background: #f4effa; color: #7b4ca8 !important; border-radius: 10px;">
                        {{ $alat->kategori ?? 'Umum' }}
                    </span>
                    <h4 class="fw-bold text-dark mb-2">{{ $alat->nama_alat }}</h4>
                    <p class="text-muted small">Maksimal stok tersedia yang bisa Anda sewa saat ini adalah <strong class="text-dark">{{ $alat->stok }} Pcs</strong>.</p>
                    <hr class="text-muted opacity-20">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Harga Sewa:</span>
                        <h4 class="fw-bold mb-0" style="color: #7b4ca8;">Rp {{ number_format($alat->harga_sewa, 0, ',', '.') }} <small class="text-muted fs-6 fw-normal">/ hari</small></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4 text-dark" style="border-radius: 20px; background: white;">
                <h5 class="fw-bold mb-4"><i class="fa-solid fa-receipt me-2 text-primary" style="color: #7b4ca8 !important;"></i>Formulir Durasi & Jumlah Sewa</h5>
                
                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-3">
                        <ul class="mb-0 small">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customer.proses-sewa') }}" method="POST">
                    @csrf
                    <input type="hidden" name="alat_id" value="{{ $alat->id }}">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Tanggal Mulai Ambil</label>
                            <input type="date" name="start_date" class="form-control p-2.5 rounded-3" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Tanggal Pengembalian</label>
                            <input type="date" name="end_date" class="form-control p-2.5 rounded-3" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label small fw-bold text-secondary">Jumlah Alat yang Disewa</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-boxes"></i></span>
                                <input type="number" name="jumlah_sewa" class="form-control p-2.5 rounded-end-3" placeholder="Contoh: 2" min="1" max="{{ $alat->stok }}" required>
                            </div>
                            <div class="form-text text-muted small">Isian tidak boleh melebihi batas stok admin toko.</div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top text-end">
                        <button type="submit" class="btn text-white px-5 fw-bold py-2.5" style="background: linear-gradient(135deg, #7b4ca8 0%, #3b1c54 100%); border: none; border-radius: 12px;">
                            <i class="bi bi-cart-check-fill me-2"></i> Konfirmasi Sewa Alat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection