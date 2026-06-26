@extends('layouts.customer.app')

@section('content')
<div class="container-fluid animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Katalog Alat Camping</h2>
            <p class="text-muted small mb-0">Pilih perlengkapan camping terbaik untuk petualangan Anda.</p>
        </div>
        <div class="input-group w-25 shadow-sm rounded-3 overflow-hidden">
            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0 ps-0 text-dark" placeholder="Cari alat camping...">
        </div>
    </div>

    <div class="row g-4">
        {{-- SINKRONISASI: Mengubah $alat menjadi $daftarAlat sesuai dengan Controller --}}
      @forelse($katalogAlat as $item)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm product-card overflow-hidden" style="border-radius: 20px; background: white;">
                <div class="position-relative overflow-hidden" style="height: 200px; background-color: #f1f5f9;">
                    @if($item->gambar)
                        <img src="{{ asset('images/alat/' . $item->gambar) }}" class="w-100 h-100 product-img" style="object-fit: cover;" alt="{{ $item->nama_alat }}">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                            <i class="bi bi-image fs-1"></i>
                        </div>
                    @endif
                    
                    <span class="position-absolute top-0 end-0 bg-dark text-white text-xs fw-bold px-3 py-1.5 m-3 small" style="border-radius: 30px; opacity: 0.85;">
                        Stok: {{ $item->stok }} Pcs
                    </span>
                </div>
                
                <div class="card-body p-4 text-dark">
                    <span class="badge bg-purple-light mb-2 px-2.5 py-1.5 fw-semibold text-xs" style="background: #f4effa; color: #7b4ca8; border-radius: 8px;">
                        {{ $item->kategori->nama_kategori ?? 'Umum' }}
                    </span>
                    <h5 class="card-title fw-bold text-truncate mb-2" title="{{ $item->nama_alat }}">{{ $item->nama_alat }}</h5>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-light">
                        <div class="text-start">
                            <small class="text-muted d-block" style="font-size: 11px;">Harga Sewa</small>
                            <span class="fs-5 fw-bold" style="color: #7b4ca8;">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</span>
                            <small class="text-muted small">/hari</small>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-white border-0 p-4 pt-0">
                    <a href="{{ route('customer.form_sewa', $item->id) }}" class="btn btn-purple-gradient w-100 fw-bold py-2.5 text-white" style="background: linear-gradient(135deg, #7b4ca8 0%, #5a3280 100%); border: none; border-radius: 12px; transition: transform 0.2s;">
                        <i class="bi bi-cart-plus-fill me-1"></i> Sewa Alat Sekarang
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="p-5 mx-auto bg-white shadow-sm" style="max-width: 500px; border-radius: 20px;">
                <i class="bi bi-box-seam display-1 text-muted opacity-30"></i>
                <h4 class="text-dark fw-bold mt-4">Katalog Perlengkapan Kosong</h4>
                <p class="text-muted small">Saat ini belum ada alat camping milik admin yang siap atau tersedia untuk disewakan.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
    .product-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .product-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(123, 76, 168, 0.15) !important; }
    .product-img { height: 220px; object-fit: cover; transition: transform 0.5s ease; }
    .product-card:hover .product-img { transform: scale(1.1); }
    .btn-purple-gradient:hover { opacity: 0.9; transform: scale(0.98); }
</style>
@endsection