<div>
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
</div>
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h5>Input Transaksi Penyewaan Baru</h5>
    <a href="{{ route('admin.rental.index') }}" class="text-decoration-none small text-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="card border-0 shadow-sm p-4" style="max-width: 600px;">
    <form action="{{ route('admin.rental.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="user_id" class="form-label fw-bold">Pilih Pelanggan</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Akun Pelanggan --</option>
                @foreach($pelanggan as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="gear_id" class="form-label fw-bold">Alat Camping (Gear)</label>
            <select name="gear_id" id="gear_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Alat/Gear --</option>
                @foreach($gears as $gear)
                    <option value="{{ $gear->id }}">
                        {{ $gear->nama_alat }} - Rp {{ number_format($gear->harga_sewa, 0, ',', '.') }}/hari (Stok: {{ $gear->stok }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tgl_sewa" class="form-label fw-bold">Tanggal Mulai Sewa</label>
                <input type="date" name="tgl_sewa" id="tgl_sewa" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tgl_kembali" class="form-label fw-bold">Tanggal Pengembalian</label>
                <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required>
            </div>
        </div>

        <div class="mb-4" style="max-width: 150px;">
            <label for="jumlah_set" class="form-label fw-bold">Jumlah (Set)</label>
            <input type="number" name="jumlah_set" id="jumlah_set" class="form-control" min="1" value="1" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan Transaksi</button>
    </form>
</div>
@endsection