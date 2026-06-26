@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-primary fw-bold">Daftar Jaminan</h4>
                <a href="{{ route('jaminan.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Tambah Jaminan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Rental ID</th>
                            <th>Jenis Jaminan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jaminans as $j)
                        <tr>
                            <td>{{ $j->id }}</td>
                            <td><span class="badge bg-secondary">#{{ $j->rental_id }}</span></td>
                            <td>{{ $j->jenis_jaminan }}</td>
                            <td>
                                <span class="badge bg-info">{{ $j->status }}</span>
                            </td>
                            <td>
                                </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data jaminan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection