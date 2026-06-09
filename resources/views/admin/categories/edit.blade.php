@extends('layouts.app')

@section('title', 'Ubah Kategori - CampRent')
@section('page-title', 'Ubah Data Kategori')

@section('content')
<div class="mb-4">
    <a href="{{ route('kategori.index') }}" class="text-decoration-none text-muted small fw-semibold">
        <i class="fa-solid fa-arrow-left me-1"></i> Batal & Kembali
    </a>
</div>

<div class="card border-0 p-4 shadow-sm mx-auto" style="border-radius: 20px; max-width: 700px; background: var(--card);">
    <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-pen-to-square text-warning me-2"></i>Perbarui Parameter Kategori</h5>
    
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-7 mb-3">
                <label class="form-label small fw-bold text-secondary">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-5 mb-3">
                <label class="form-label small fw-bold text-secondary">Ikon (FontAwesome Class)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="fa-solid {{ $kategori->ikon ?? 'fa-tags' }}" id="iconPreview"></i></span>
                    <input type="text" name="ikon" id="ikonInput" class="form-control @error('ikon') is-invalid @enderror" value="{{ old('ikon', $kategori->ikon) }}" required>
                </div>
                @error('ikon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 mb-4">
                <label class="form-label small fw-bold text-secondary">Deskripsi Singkat Kelompok</label>
                <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="text-end border-top pt-3">
            <a href="{{ route('kategori.index') }}" class="btn btn-light px-4 me-2" style="border-radius: 10px;">Batal</a>
            <button type="submit" class="btn btn-success px-5 text-white" style="border-radius: 10px; background-color: var(--primary); border: none;">Simpan Perubahan</button>
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