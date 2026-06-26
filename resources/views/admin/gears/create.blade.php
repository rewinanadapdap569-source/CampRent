@extends('layouts.app') @section('content')
<div class="container">
    <h3>Tambah Alat Baru</h3>
    <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label>Nama Perlengkapan</label>
            <input type="text" name="nama_alat" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Kategori Komponen</label>
            <select name="kategori" class="form-control" required>
                <option value="">Pilih Kategori...</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->nama_kategori }}">
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Harga Sewa per Hari (Rp)</label>
            <input type="number" name="harga_sewa" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Unggah Foto Alat</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan Data</button>
    </form>
</div>
@endsection