@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 p-4">
        <h4 class="text-primary fw-bold mb-4">Tambah Pelanggan Baru</h4>
        
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama pelanggan">
            </div>

            <div class="mb-3">
                <label class="form-label">No. Identitas</label>
                <input type="text" name="no_identitas" class="form-control" required placeholder="Contoh: 1234567890">
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="number" name="no_hp" class="form-control" required placeholder="Contoh: 08123456789">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required placeholder="Masukkan alamat"></textarea>
            </div>

            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </form>
    </div>
</div>
@endsection