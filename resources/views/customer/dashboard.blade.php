@extends('layouts.customer.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Halo, {{ auth()->user()->name }}!</h2>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card card-stat p-4 bg-primary text-white" style="background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Sedang Disewa</h6>
                        <h3>{{ $sewaBerjalan }} Unit</h3>
                    </div>
                    <i class="bi bi-backpack4 fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat p-4 bg-success text-white" style="background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Menunggu Pembayaran</h6>
                        <h3>{{ $menungguBayar }} Transaksi</h3>
                    </div>
                    <i class="bi bi-wallet2 fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stat p-4 bg-warning" style="background: linear-gradient(135deg, #f59e0b 0%, #a16207 100%); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Jatuh Tempo Kembali</h6>
                        <h3>{{ $sisaHari !== null ? $sisaHari . ' Hari Lagi' : '-' }}</h3>
                    </div>
                    <i class="bi bi-calendar2-week fs-1"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card p-4 card-table-container">
                <h5>Aktivitas Terakhir</h5>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Alat</th>
                            <th>Tanggal Sewa</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiTerbaru as $item)
                        <tr>
                            <td>{{ $item->alat->nama_alat ?? 'Alat Dihapus' }}</td>
                            <td>{{ $item->start_date }}</td>
                            <td>
                                <span class="badge bg-{{ $item->status == 'disewa' ? 'info' : 'secondary' }}" style="padding: 10px; border-radius: 20px;">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center p-5">
                                <i class="bi bi-cart-x fs-1 text-muted"></i>
                                <p class="text-muted mt-3">Belum ada transaksi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Tambahkan ke CSS global atau section style */
    .card-stat {
        border: none;
        border-radius: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
    }
    .card-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
    }
    .card-table-container {
        border-radius: 20px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.03);
    }
</style>
@endsection