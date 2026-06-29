@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h3 class="fw-bold mb-4">Customers</h3>
    
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">Name</th>
                        <th class="py-3">No. Identitas</th>
                        <th class="py-3">No. HP</th>
                        <th class="py-3">Joined</th>
                        <th class="text-end pe-4 py-3">Rentals</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggans as $p)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 40px; height: 40px; font-weight: bold;">
                                    {{ strtoupper(substr($p->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $p->nama }}</div>
                                    <small class="text-muted">{{ $p->alamat }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $p->no_identitas }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td>{{ $p->created_at->format('Y-m-d') }}</td>
                       <td>
    <span class="badge">{{ $p->rentals_count }}</span>
</td>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Data belum ada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection