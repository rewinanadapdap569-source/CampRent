@extends('layouts.app')

@section('title', 'Ubah Alat Camping - CampRent')
@section('page-title', 'Ubah Data Alat')

@section('content')
<div class="mb-4">
    <a href="{{ route('alat.index') }}" class="text-decoration-none text-muted small fw-semibold">
        <i class="fa-solid fa-arrow-left me-1"></i> Batal & Kembali
    </a>
</div>

<div class="card border-0 p-4 shadow-sm mx-auto" style="border-radius: 20px; max-width: 800px; background: var(--card);">
    <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-pen-to-square text-warning me-2"></i>Perbarui Informasi Item</h5>
    
    <form action="{{ route('alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Nama Perlengkapan</label>
                <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" value="{{ old('nama_alat', $alat->nama_alat) }}" required>
                @error('nama_alat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Kategori Komponen</label>
                <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                    @foreach(['Tenda','Carrier','Sleeping Bag','Kompor','Lampu','Matras'] as $cat)
                        <option value="{{ $cat }}" {{ old('kategori', $alat->kategori) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Harga Sewa per Hari (Rp)</label>
                <input type="number" name="harga_sewa" class="form-control @error('harga_sewa') is-invalid @enderror" value="{{ old('harga_sewa', intval($alat->harga_sewa)) }}" min="0" required>
                @error('harga_sewa') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-secondary">Jumlah Stok Fisik</label>
                <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $alat->stok) }}" min="0" required>
                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 mb-4">
                <label class="form-label small fw-bold text-secondary">Ganti Foto Alat (Opsional)</label>
                <input type="file" name="gambar" id="gambarInput" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                
                <div class="row mt-3 align-items-center">
                    <div class="col-sm-6 text-center">
                        <p class="small text-muted mb-2">Gambar Saat Ini:</p>
                        @if($alat->gambar)
                            <img src="{{ asset('images/alat/' . $alat->gambar) }}" class="img-thumbnail" style="max-height: 140px; border-radius: 8px;">
                        @else
                            <span class="text-muted small">Tidak ada gambar</span>
                        @endif
                    </div>
                    <div class="col-sm-6 text-center d-none" id="previewContainer">
                        <p class="small text-muted mb-2">Pratinjau Gambar Baru:</p>
                        <img id="previewGambar" src="#" alt="Preview" class="img-thumbnail" style="max-height: 140px; border-radius: 8px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end border-top pt-3">
            <a href="{{ route('alat.index') }}" class="btn btn-light px-4 me-2" style="border-radius: 10px;">Batal</a>
            <button type="submit" class="btn btn-success px-5 text-white" style="border-radius: 10px; background-color: var(--primary); border: none;">Simpan Perubahan</button>
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