@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card p-4">
        <h3>Form Pembayaran Baru</h3>
        <form action="{{ route('pembayaran.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Pilih Rental</label>
                <select name="rental_id" class="form-control" required>
                    @foreach($rentals as $rental)
                        <option value="{{ $rental->id }}">Rental #{{ $rental->id }} (Total: Rp {{ number_format($rental->total_harga) }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Jumlah Bayar</label>
                <input type="number" name="amount" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Metode Pembayaran</label>
                <select name="payment_method" class="form-control">
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan Pembayaran</button>
        </form>
    </div>
</div>
@endsection