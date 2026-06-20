@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5>Manajemen Transaksi Penyewaan</h5>
    <a href="{{ route('admin.rental.create') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus me-1"></i> Tambah Transaksi Manual
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 mb-4" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger border-0 mb-4" role="alert">
        {{ session('error') }}
    </div>
@endif

<div class="card border-0 shadow-sm p-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Pelanggan</th>
                    <th>Alat Camping (Gear)</th>
                    <th>Durasi Sewa</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftarSewa as $item)
                <tr>
                    <td>
                        <div class="fw-bold">{{ $item->user->name }}</div>
                        <small class="text-muted">{{ $item->user->email }}</small>
                    </td>
                    <td>
                        {{ $item->gear->nama_alat }} 
                        <span class="badge bg-secondary-subtle text-secondary">x{{ $item->jumlah_set }}</span>
                    </td>
                    <td>
                        <small>
                            {{ \Carbon\Carbon::parse($item->tgl_sewa)->format('d M Y') }} s/d <br>
                            {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y') }}
                        </small>
                    </td>
                    <td class="fw-bold text-success">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>
                        @if($item->status == 'Pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($item->status == 'Disetujui')
                            <span class="badge bg-info text-white">Disetujui</span>
                        @elseif($item->status == 'Disewa')
                            <span class="badge bg-primary text-white">Disewa</span>
                        @elseif($item->status == 'Selesai')
                            <span class="badge bg-success text-white">Selesai</span>
                        @else
                            <span class="badge bg-danger text-white">Ditolak</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <form action="{{ route('admin.rental.status', $item->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <div class="input-group input-group-sm" style="width: 180px;">
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Disetujui" {{ $item->status == 'Disetujui' ? 'selected' : '' }}>Setujui</option>
                                        <option value="Disewa" {{ $item->status == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                                        <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Ditolak" {{ $item->status == 'Ditolak' ? 'selected' : '' }}>Tolak</option>
                                    </select>
                                    <button type="submit" class="btn btn-dark btn-sm">Update</button>
                                </div>
                            </form>

                            <a href="{{ route('admin.rental.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data transaksi penyewaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection