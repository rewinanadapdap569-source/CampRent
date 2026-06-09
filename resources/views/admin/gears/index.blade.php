@extends('layouts.app')

@section('title', 'Manajemen Alat Camping - CampRent')
@section('page-title', 'Daftar Alat Camping')

@section('content')
<style>
    .action-btn { width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; transition: all 0.2s; }
    .badge-status { padding: 6px 12px; border-radius: 30px; font-size: 12px; font-weight: 600; }
    .status-tersedia { background: #e6f4ea; color: #137333; }
    .status-habis { background: #fce8e6; color: #c5221f; }
    .gear-img { width: 55px; height: 55px; object-fit: cover; border-radius: 12px; border: 1px solid var(--border); }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted m-0">Kelola item perlengkapan ketersediaan logistik camping.</p>
    <a href="{{ route('alat.create') }}" class="btn btn-primary px-4 py-2" style="border-radius: 12px; background-color: var(--primary); border: none;">
        <i class="fa-solid fa-plus me-2"></i> Tambah Alat Baru
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 mb-4" style="border-radius: 14px; background-color: #d1e7dd;" role="alert">
        <i class="fa-solid fa-circle-check me-2 text-success"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 p-4 shadow-sm" style="border-radius: 20px; background: var(--card);">
    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead class="table-light" style="background-color: #f8fafc;">
                <tr style="color: var(--text-light); font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">
                    <th class="ps-3 py-3">Gambar</th>
                    <th class="py-3">Nama Alat</th>
                    <th class="py-3">Kategori</th>
                    <th class="py-3">Harga Sewa / Hari</th>
                    <th class="py-3" style="text-align: center;">Stok</th>
                    <th class="py-3">Status</th>
                    <th class="py-3 text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftarAlat as $alat)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td class="ps-3 py-3">
                            @if($alat->gambar)
                                <img src="{{ asset('images/alat/' . $alat->gambar) }}" class="gear-img" alt="Foto">
                            @else
                                <div class="gear-img bg-light d-flex align-items-center justify-content-center text-muted"><i class="fa-solid fa-mountain"></i></div>
                            @endif
                        </td>
                        <td class="fw-bold text-dark">{{ $alat->nama_alat }}</td>
                        <td><span class="badge bg-light text-secondary border px-3 py-2" style="border-radius: 8px;">{{ $alat->kategori }}</span></td>
                        <td class="fw-semibold text-success">Rp {{ number_format($alat->harga_sewa, 0, ',', '.') }}</td>
                        <td style="text-align: center;" class="fw-bold">{{ $alat->stok }} Pcs</td>
                        <td>
                            <span class="badge-status {{ $alat->status == 'Tersedia' ? 'status-tersedia' : 'status-habis' }}">
                                {{ $alat->status }}
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('alat.edit', $alat->id) }}" class="action-btn bg-warning-subtle text-warning" title="Edit Data">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('alat.destroy', $alat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn bg-danger-subtle text-danger border-0" title="Hapus Data">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-boxes-stacked d-block mb-3" style="font-size: 40px; opacity: 0.3;"></i>
                            Belum ada inventaris alat camping terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection