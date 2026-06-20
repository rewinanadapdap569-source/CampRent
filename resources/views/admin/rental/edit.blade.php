@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h5>Edit Detail Transaksi #{{ $rental->id }}</h5>
    <a href="{{ route('admin.rental.index') }}" class="text-decoration-none small text-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="card border-0 shadow-sm p-4" style="max-width: 600px;">
    <form action="{{ route('admin.rental.update', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label fw-bold d-block">Nama Pelanggan</label>
            <input type="text" class="form-control bg-light" value="{{ $rental->user->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="gear_id" class="form-label fw-bold">Alat Camping (Gear)</label>
            <select name="gear_id" id="gear_id" class="form-select" required>
                @foreach($gears as $gear)
                    <option value="{{ $gear->id }}" {{ $rental->gear_id == $gear->id ? 'selected' : '' }}>
                        {{ $gear->nama_alat }} - Rp {{ number_format($gear->harga_sewa, 0, ',', '.') }}/hari
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tgl_sewa" class="form-label fw-bold">Tanggal Mulai Sewa</label>
                <input type="date" name="tgl_sewa" id="tgl_sewa" class="form-control" value="{{ $rental->tgl_sewa }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tgl_kembali" class="form-label fw-bold">Tanggal Pengembalian</label>
                <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" value="{{ $rental->tgl_kembali }}" required>
            </div>
        </div>

        <div class="mb-4" style="max-width: 150px;">
            <label for="jumlah_set" class="form-label fw-bold">Jumlah (Set)</label>
            <input type="number" name="jumlah_set" id="jumlah_set" class="form-control" min="1" value="{{ $rental->jumlah_set }}" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Perbarui Detail Transaksi</button>
    </form>
</div>
@endsection