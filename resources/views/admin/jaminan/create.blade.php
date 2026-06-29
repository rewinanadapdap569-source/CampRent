@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="text-primary fw-bold mb-4">Tambah Jaminan Baru</h4>
            
            <form action="{{ route('jaminan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pilih Rental</label>
                    <select name="rental_id" class="form-control" required>
                        <option value="">-- Pilih Transaksi Rental --</option>
                        </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Jenis Jaminan</label>
                    <input type="text" name="jenis_jaminan" class="form-control" placeholder="Contoh: KTP /Kartu Pelajar DLL" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="Ditahan">Ditahan</option>
                        <option value="Dikembalikan">Dikembalikan</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary px-4">Simpan Jaminan</button>
                <a href="{{ route('jaminan.index') }}" class="btn btn-secondary px-4">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection