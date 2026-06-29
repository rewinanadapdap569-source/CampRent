@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary fw-bold">Daftar Pembayaran</h4>
                <a href="{{ route('pembayaran.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Tambah Pembayaran
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3">Rental ID</th>
                            <th class="py-3">Jumlah</th>
                            <th class="py-3">Metode</th>
                            <th class="py-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td><span class="badge bg-secondary">#{{ $p->rental_id }}</span></td>
                            <td class="fw-bold text-success">Rp {{ number_format($p->amount, 0, ',', '.') }}</td>
                            <td>{{ $p->payment_method }}</td>
                            <td>{{ $p->payment_date }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data pembayaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection