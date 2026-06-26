@extends('layouts.app')
@section('page-title', 'Tambah Alat Baru')
@section('content')
<style>
    .card-modern { border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
    .card-header-modern { background: linear-gradient(135deg, #2e7d32, #1b5e20); color: white; padding: 20px; border: none; }
    .form-control-modern { border-radius: 10px; border: 1px solid #e0e0e0; padding: 12px; transition: 0.3s; }
    .form-control-modern:focus { border-color: #2e7d32; box-shadow: 0 0 8px rgba(46, 125, 50, 0.2); }
    .btn-save { border-radius: 10px; padding: 10px 30px; font-weight: 600; background: #2e7d32; border: none; }
</style>

<div class="container-fluid px-4">
    <div class="card card-modern">
        <div class="card-header card-header-modern">
            <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Inventaris Baru</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Nama Perlengkapan</label>
                            <input type="text" name="nama_alat" class="form-control form-control-modern" placeholder="Contoh: Tenda Rei Kapasitas 4" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Kategori</label>
                            <select name="kategori" class="form-control form-control-modern" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Harga Sewa / Hari (Rp)</label>
                            <input type="number" name="harga_sewa" class="form-control form-control-modern" placeholder="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Stok Barang</label>
                            <input type="number" name="stok" class="form-control form-control-modern" placeholder="0" required>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Foto Alat</label>
                    <input type="file" name="gambar" class="form-control form-control-modern">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary btn-save shadow">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection