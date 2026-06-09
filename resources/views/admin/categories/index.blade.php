@extends('layouts.app')

@section('title', 'Manajemen Kategori - CampRent')
@section('page-title', 'Kategori Perlengkapan')

@section('content')
<style>
    .action-btn { width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; transition: all 0.2s; }
    .icon-box { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 12px; background-color: #e6f4ea; color: var(--primary); font-size: 18px; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted m-0">Kelompokkan jenis logistik penyewaan alat camping agar manajemen inventaris lebih rapi.</p>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary px-4 py-2" style="border-radius: 12px; background-color: var(--primary); border: none;">
        <i class="fa-solid fa-plus me-2"></i> Tambah Kategori
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
                    <th class="ps-3 py-3" style="width: 80px;">Ikon</th>
                    <th class="py-3">Nama Kategori</th>
                    <th class="py-3">Deskripsi Kelompok</th>
                    <th class="py-3 text-end pe-3" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
          <tbody>
    {{-- Membaca array $daftarKategori yang dikirim oleh Controller --}}
    @forelse($daftarKategori as $kat)
        <tr style="border-bottom: 1px solid #f1f5f9;">
            <td class="ps-3 py-3">
                <div class="icon-box">
                    {{-- Mengambil kolom ikon dari database --}}
                    <i class="fa-solid {{ $kat->ikon ?? 'fa-tags' }}"></i>
                </div>
            </td>
            {{-- Mengambil kolom nama_kategori dari database --}}
            <td class="fw-bold text-dark">{{ $kat->nama_kategori }}</td>
            {{-- Mengambil kolom deskripsi dari database --}}
            <td class="text-muted small">{{ $kat->deskripsi ?? 'Tidak ada deskripsi.' }}</td>
            <td class="text-end pe-3">
                <div class="d-inline-flex gap-2">
                    <a href="{{ route('kategori.edit', $kat->id) }}" class="action-btn bg-warning-subtle text-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('kategori.destroy', $kat->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn bg-danger-subtle text-danger border-0">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center py-5 text-muted">
                <i class="fa-solid fa-tags d-block mb-2" style="font-size: 24px; opacity: 0.3;"></i>
                Belum ada kategori terdaftar pada basis data.
            </td>
        </tr>
    @endforelse
</tbody>
        </table>
    </div>
</div>
@endsection