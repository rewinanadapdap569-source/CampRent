@extends('layouts.app')

@section('title', 'Tambah Alat Camping - CampRent')
@section('page-title', 'Tambah Alat Baru')

@section('content')
<div class="mb-4">
    <a href="{{ route('alat.index') }}" class="text-decoration-none text-muted small fw-semibold">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Alat
    </a>
</div>

<div class="card border-0 p-4 shadow-sm mx-auto" style="border-radius: 20px; max-width: 800px; background: var(--card);">
    <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-circle-plus text-success me-2"></i>Formulir Data Alat</h5>
    
    <form action="{{ route('alat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Nama Perlengkapan</label>
                <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" value="{{ old('nama_alat') }}" placeholder="Contoh: Tenda Eiger 4P" required>
                @error('nama_alat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Kategori Komponen</label>
               <select name="kategori_id"class="form-select @error('kategori_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih Kategori...</option>
                    @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}"{{ old('kategori_id') == $kat->id ? 'selected':'' }}>{{ $kat->nama_kategori }}
                </option>
            @endforeach
            </select>
            @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}
             </div>@enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Harga Sewa per Hari (Rp)</label>
                <input type="number" name="harga_sewa" class="form-control @error('harga_sewa') is-invalid @enderror" value="{{ old('harga_sewa') }}" placeholder="Contoh: 45000" min="0" required>
                @error('harga_sewa') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Jumlah Stok Fisik</label>
                <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" placeholder="Contoh: 12" min="0" required>
                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 mb-4">
                <label class="form-label small fw-bold text-secondary">Unggah Foto Alat</label>
                <input type="file" name="gambar" id="gambarInput" class="form-control @error('gambar') is-invalid @enderror" accept="image/*" required>
                <div class="form-text small">Format file: JPG, PNG, WEBP (Maksimal 2MB).</div>
                @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                
                <div class="mt-3 text-center d-none" id="previewContainer">
                    <p class="small text-muted mb-2">Pratinjau Gambar:</p>
                    <img id="previewGambar" src="#" alt="Preview" class="img-thumbnail" style="max-height: 200px; border-radius: 12px;">
                </div>
            </div>
        </div>

        <div class="text-end border-top pt-3">
            <button type="reset" class="btn btn-light px-4 me-2" style="border-radius: 10px;">Reset</button>
            <button type="submit" class="btn btn-primary px-5" style="border-radius: 10px; background-color: var(--primary); border: none;">Simpan Data</button>
        </div>
    </form>
</div>

<script>
    gambarInput.onchange = evt => {
        const [file] = gambarInput.files;
        if (file) {
            previewGambar.src = URL.createObjectURL(file);
            previewContainer.classList.remove('d-none');
        }
    }
</script>
@endsection