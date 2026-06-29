@extends('layouts.customer.app')

@section('content')
<div class="container-fluid" style="max-width: 900px;">
    <h2 class="fw-bold text-dark mb-4">Penyewaan Saya</h2>

    @forelse($penyewaan as $item)
    <div class="card border-0 shadow-sm p-3 mb-3 bg-white" style="border-radius: 16px;">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <div style="height: 140px; overflow: hidden; border-radius: 12px; background-color: #f8f9fa;">
                    @if($item->alat->gambar)
                        <img src="{{ asset('images/alat/' . $item->alat->gambar) }}" style="width:100%; height:100%; object-fit:cover;" alt="Alat">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-muted small">No Image</div>
                    @endif
                </div>
            </div>

            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">{{ $item->alat->nama_alat }}</h5>
                        <p class="text-muted small mb-2">RNT-000{{ $item->id }}</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-semibold">
                        {{ $item->status }}
                    </span>
                </div>

                <p class="text-dark fw-medium small mb-2">
                    <i class="bi bi-calendar3 me-2 text-secondary"></i>
                    {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') }} → {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y') }}
                </p>

                @php
                    $sisaHari = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->end_date), false);
                @endphp
                <h6 class="text-success fw-bold mb-3">
                    @if($sisaHari > 0)
                        Tersisa {{ $diff = ceil($sisaHari) }} hari
                    @elseif($sisaHari == 0)
                        Hari ini batas pengembalian!
                    @else
                        Terlambat {{ abs(floor($sisaHari)) }} hari
                    @endif
                </h6>

                <hr class="text-muted my-2">

                <div class="row text-muted small g-2">
                    <div class="col-6 col-md-3">
                        <i class="bi bi-wallet2 me-1"></i> Subtotal: <strong class="text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                    </div>
                    <div class="col-6 col-md-3">
                        <i class="bi bi-shield-lock me-1"></i> Deposit: <strong class="text-dark">Rp {{ number_format($item->deposit, 0, ',', '.') }}</strong>
                    </div>
                    <div class="col-6 col-md-3">
                        <i class="bi bi-person-badge me-1"></i> Garansi: <strong class="text-dark">{{ $item->guarantee_type }}</strong>
                    </div>
                    <div class="col-6 col-md-3 text-end">
                        <span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> Pembayaran: Dibayar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-5">
        <i class="bi bi-journal-x display-2 text-muted"></i>
        <h5 class="text-muted mt-3">Kamu belum melakukan pemesanan apa pun.</h5>
    </div>
    @endforelse
</div>
@endsection