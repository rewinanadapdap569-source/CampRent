@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card p-4">
        <h3>Daftar Pembayaran</h3>
        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rental ID</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->rental_id }}</td>
                    <td>Rp {{ number_format($p->amount) }}</td>
                    <td>{{ $p->payment_method }}</td>
                    <td>{{ $p->payment_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection