@extends('layouts.customer.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Katalog Alat</h2>
        <div class="input-group w-25">
            <input type="text" class="form-control" placeholder="Cari alat...">
        </div>
    </div>
    
    <div class="row g-4">
        @forelse($alat as $item)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm product-card">
                <div class="overflow-hidden rounded-top">
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top product-img" alt="{{ $item->nama_alat }}">
                </div>
                
                <div class="card-body">
                    <span class="badge bg-light text-primary mb-2 shadow-sm">{{ $item->kategori->nama_kategori ?? 'Umum' }}</span>
                    <h5 class="card-title fw-bold text-truncate">{{ $item->nama_alat }}</h5>
                    <p class="text-muted small mb-3">{{ Str::limit($item->deskripsi, 60) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fs-5 fw-bold text-primary">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</span>
                        <span class="text-muted small">/hari</span>
                    </div>
                </div>
                
                <div class="card-footer bg-white border-0 p-3">
                    <button class="btn btn-dark w-100 rounded-pill fw-bold" onclick="window.location.href='#'">
                        <i class="bi bi-cart-plus"></i> Tambah ke Sewa
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-box-seam display-1 text-muted"></i>
            <h4 class="text-muted mt-3">Ups, katalog masih kosong.</h4>
        </div>
        @endforelse
    </div>
</div>

<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .product-img {
        height: 220px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .product-card:hover .product-img {
        transform: scale(1.1);
    }
    .btn-dark {
        background-color: #0f172a;
        transition: background 0.3s;
    }
    .btn-dark:hover {
        background-color: #3b82f6;
    }
</style>
@endsection