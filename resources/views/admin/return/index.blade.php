@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h5 class="fw-bold text-dark">Manajemen Pengembalian Alat Camping</h5>
    <p class="text-muted small">Daftar alat camping yang sedang dibawa pelanggan. Klik tombol terima jika barang sudah dikembalikan ke toko.</p>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 mb-4" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm p-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Pelanggan</th>
                    <th>Alat / Gear Camping</th>
                    <th>Jumlah Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Status Barang</th>
                    <th class="text-end">Aksi Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftarDisewa as $item)
                <tr>
                    <td>
                        <div class="fw-bold">{{ $item->user->name }}</div>
                        <small class="text-muted">{{ $item->user->email }}</small>
                    </td>
                    <td>{{ $item->gear->nama_alat }}</td>
                    <td><span class="badge bg-secondary-subtle text-secondary">{{ $item->jumlah_set }} Set</span></td>
                    <td>
                        <span class="text-danger fw-bold">
                            {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-primary text-white">Sedang Disewa</span>
                    </td>
                    <td class="text-end">
                        <form action="{{ route('admin.return.process', $item->id) }}" method="POST" onsubmit="return confirm('Apakah alat ini dikembalikan dengan kondisi lengkap?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-arrow-rotate-left me-1"></i> Terima Pengembalian
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Saat ini tidak ada alat camping yang sedang dibawa atau disewa oleh pelanggan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection