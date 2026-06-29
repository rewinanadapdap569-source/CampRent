@extends('layouts.customer.app')

@section('content')
<div class="container-fluid" style="max-width: 1000px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Riwayat Penyewaan</h2>
        <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $riwayat->count() }} Transaksi</span>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="table-responsive p-3">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-secondary small text-uppercase">
                    <tr>
                        <th class="ps-3">Alat Camping</th>
                        <th>Kode Sewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($riwayat as $item)
                    <tr>
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 50px; height: 50px; overflow: hidden; border-radius: 8px; background-color: #f8f9fa;">
                                    @if($item->alat->gambar)
                                        <img src="{{ asset('images/alat/' . $item->alat->gambar) }}" style="width:100%; height:100%; object-fit:cover;" alt="">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 text-muted" style="font-size: 10px;">No Pic</div>
                                    @endif
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block">{{ $item->alat->nama_alat }}</span>
                                    <small class="text-muted">{{ $item->duration }} Hari sewa</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-muted fw-mono">RNT-000{{ $item->id }}</td>
                        <td>
                            <span class="d-block text-dark">{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</span>
                            <small class="text-muted">s/d {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}</small>
                        </td>
                        <td class="fw-bold text-dark">Rp {{ number_format($item->total_due, 0, ',', '.') }}</td>
                        <td>
                            @if($item->status == 'Selesai')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Selesai Kembali</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">Dibatalkan</span>
                            @endif
                        </td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">Detail</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-clock-history display-3 d-block mb-3 text-light"></i>
                            Belum ada riwayat penyewaan masa lalu.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection