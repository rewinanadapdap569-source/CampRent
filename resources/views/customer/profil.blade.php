@extends('layouts.customer.app')

@section('content')
<div class="container-fluid" style="max-width: 800px;">
    <h2 class="fw-bold text-dark mb-4">Profil Saya</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4 bg-white" style="border-radius: 16px;">
                <div class="mx-auto mb-3 bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px;">
                    <i class="bi bi-person text-secondary display-4"></i>
                </div>
                <h5 class="fw-bold text-dark text-truncate mb-1">{{ $user->name }}</h5>
                <p class="text-muted small mb-3">{{ $user->email }}</p>
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-semibold small">
                    Customer Member
                </span>
                <hr class="text-muted my-3">
                <small class="text-muted d-block">Bergabung sejak:</small>
                <small class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y') }}</small>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 16px;">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-gear-fill text-secondary me-2"></i> Ubah Data Diri</h5>
                
                <form action="{{ route('customer.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="text-muted my-4">
                    <p class="text-muted small fw-medium mb-3"><i class="bi bi-info-circle me-1"></i> Kosongkan kolom password di bawah jika Anda tidak ingin mengubah password.</p>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-secondary">Password Baru</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-secondary">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection