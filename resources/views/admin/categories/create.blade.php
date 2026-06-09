@extends('layouts.app')

@section('title', 'Tambah Kategori - CampRent')
@section('page-title', 'Tambah Kategori Baru')

@section('content')
<div class="mb-4">
    <a href="{{ route('kategori.index') }}" class="text-decoration-none text-muted small fw-semibold">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Kategori
    </a>
</div>

<div class="card border-0 p-4 shadow-sm mx-auto" style="border-radius: 20px; max-width: 700px; background: var(--card);">
    <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-folder-plus text-success me-2"></i>Formulir Data Kategori</h5>
    
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7 mb-3">
                <label class="form-label small fw-bold text-secondary">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" placeholder="Contoh: Perlengkapan Masak" required>
                @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-5 mb-3">
                <label class="form-label small fw-bold text-secondary">Ikon (FontAwesome Class)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-circle-info" id="iconPreview"></i></span>
                    <input type="text" name="ikon" id="ikonInput" class="form-control @error('ikon') is-invalid @enderror" value="{{ old('ikon', 'fa-campground') }}" placeholder="Contoh: fa-kitchen-set" required>
                </div>
                <div class="form-text text-muted" style="font-size: 11px;">Gunakan kode ikon dari FontAwesome v6 (misal: fa-tent, fa-plug).</div>
                @error('ikon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 mb-4">
                <label class="form-label small fw-bold text-secondary">Deskripsi Singkat Kelompok</label>
                <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Jelaskan jenis perlengkapan apa saja yang masuk ke dalam kelompok ini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="text-end border-top pt-3">
            <button type="reset" class="btn btn-light px-4 me-2" style="border-radius: 10px;">Reset</button>
            <button type="submit" class="btn btn-primary px-5" style="border-radius: 10px; background-color: var(--primary); border: none;">Simpan Kategori</button>
        </div>
    </form>
</div>

<script>
    const ikonInput = document.getElementById('ikonInput');
    const iconPreview = document.getElementById('iconPreview');
    ikonInput.addEventListener('input', function() {
        iconPreview.className = 'fa-solid ' + this.value;
    });
</script>
@endsection