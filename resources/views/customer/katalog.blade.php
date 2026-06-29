@extends('layouts.customer.app')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Katalog Alat</h2>
        <div class="input-group w-25">
            <input type="text" class="form-control" placeholder="Cari alat...">
        </div>
    </div>
    
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($alat as $item)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm product-card">
                <div style="height: 180px; overflow: hidden; background-color: #f8f9fa;">
                    @if($item->gambar)
                        <img src="{{ asset('images/alat/' . $item->gambar) }}" class="card-img-top product-img" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $item->nama_alat }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-muted">No Image</div>
                    @endif
                </div>
                
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-light text-primary mb-2 align-self-start shadow-sm">{{ $item->kategori }}</span>
                    <h5 class="card-title fw-bold text-truncate">{{ $item->nama_alat }}</h5>
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <span class="fs-5 fw-bold text-primary">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</span>
                        <span class="text-muted small">/hari</span>
                    </div>
                </div>
                
                <div class="card-footer bg-white border-0 p-3">
                    <button class="btn btn-dark w-100 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $item->id }}">
                        <i class="bi bi-cart-plus"></i> Tambah ke Sewa
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="bookingModal{{ $item->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                    <form action="{{ route('penyewaan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="alat_id" value="{{ $item->id }}">
                        
                        <div class="modal-header border-0 pb-0">
                            <div>
                                <h5 class="modal-title fw-bold text-dark">Book {{ $item->nama_alat }}</h5>
                                <small class="text-muted step-indicator-text-{{ $item->id }}">Step 1 of 3</small>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="progress mb-4" style="height: 6px;">
                                <div class="progress-bar bg-success progress-{{ $item->id }}" role="progressbar" style="width: 33.33%;"></div>
                            </div>

                            <div class="step-1-{{ $item->id }}">
                                <p class="fw-semibold text-dark mb-3"><i class="bi bi-calendar-event text-success"></i> Select rental dates</p>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="form-label small fw-bold text-secondary">Start date</label>
                                        <input type="date" name="start_date" id="start_date_{{ $item->id }}" class="form-control" required onchange="hitungHarga({{ $item->id }}, {{ $item->harga_sewa }})">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small fw-bold text-secondary">End date</label>
                                        <input type="date" name="end_date" id="end_date_{{ $item->id }}" class="form-control" required onchange="hitungHarga({{ $item->id }}, {{ $item->harga_sewa }})">
                                    </div>
                                </div>
                                <div class="mt-3 p-2 bg-light rounded text-muted small">
                                    Duration: <span id="view_duration_{{ $item->id }}" class="fw-bold text-dark">1 day(s)</span> · Estimated: <span id="view_est_{{ $item->id }}" class="fw-bold text-success">Rp 0</span>
                                </div>
                            </div>

                            <div class="step-2-{{ $item->id }} d-none">
                                <p class="fw-semibold text-dark mb-3"><i class="bi bi-shield-check text-success"></i> Choose guarantee</p>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Guarantee type</label>
                                    <select name="guarantee_type" class="form-select">
                                        <option value="KTP">KTP (National ID)</option>
                                        <option value="SIM">SIM (Driver's License)</option>
                                        <option value="KTM">KTM (Student ID)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Upload ID document (mock)</label>
                                    <input type="file" name="gambar_jaminan" class="form-control">
                                    <small class="text-muted d-block mt-1">Your document will be securely stored until equipment return.</small>
                                </div>
                            </div>

                            <div class="step-3-{{ $item->id }} d-none">
                                <p class="fw-semibold text-dark mb-3"><i class="bi bi-file-earmark-text text-success"></i> Review booking</p>
                                <div class="list-group list-group-flush small rounded border">
                                    <div class="list-group-item d-flex justify-content-between"><span>Item</span><strong class="text-dark">{{ $item->nama_alat }}</strong></div>
                                    <div class="list-group-item d-flex justify-content-between"><span>Rate</span><span>Rp {{ number_format($item->harga_sewa, 0, ',', '.') }} / day</span></div>
                                    <div class="list-group-item d-flex justify-content-between"><span>Duration</span><span id="final_duration_{{ $item->id }}">1 day(s)</span></div>
                                    <div class="list-group-item d-flex justify-content-between bg-light"><span>Subtotal</span><span id="final_subtotal_{{ $item->id }}">Rp 0</span></div>
                                    <div class="list-group-item d-flex justify-content-between bg-light"><span>Deposit (refundable)</span><span id="final_deposit_{{ $item->id }}">Rp 0</span></div>
                                    <div class="list-group-item d-flex justify-content-between fw-bold fs-6 border-top"><span>Total due</span><span class="text-success" id="final_total_{{ $item->id }}">Rp 0</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-light rounded-pill px-4 btn-back-{{ $item->id }} d-none" onclick="navigasiStep({{ $item->id }}, 'back')">Back</button>
                            <button type="button" class="btn btn-success rounded-pill px-4 btn-next-{{ $item->id }}" onclick="navigasiStep({{ $item->id }}, 'next')">Continue</button>
                            <button type="submit" class="btn btn-success rounded-pill px-4 btn-submit-{{ $item->id }} d-none">Confirm Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-box-seam display-1 text-muted"></i>
            <h4 class="text-muted mt-3">Ups, katalog masih kosong.</h4>
        </div>
        @endforelse
    </div>
</div>

<script>
    // Menyimpan posisi langkah aktif per item modal
    let currentSteps = {};

    function navigasiStep(id, arah) {
        if (!currentSteps[id]) currentSteps[id] = 1;
        
        let step = currentSteps[id];
        
        // Sembunyikan langkah yang sekarang aktif
        document.querySelector(`.step-${step}-${id}`).classList.add('d-none');
        
        if (arah === 'next') {
            step++;
        } else {
            step--;
        }
        
        currentSteps[id] = step;

        // Tampilkan langkah baru
        document.querySelector(`.step-${step}-${id}`).classList.remove('d-none');

        // Update Navigasi UI, Progress Bar, & Tombol
        let indicator = document.querySelector(`.step-indicator-text-${id}`);
        let progressBar = document.querySelector(`.progress-${id}`);
        let btnBack = document.querySelector(`.btn-back-${id}`);
        let btnNext = document.querySelector(`.btn-next-${id}`);
        let btnSubmit = document.querySelector(`.btn-submit-${id}`);

        indicator.innerText = `Step ${step} of 3`;
        progressBar.style.width = `${step * 33.33}%`;

        if(step === 1) {
            btnBack.classList.add('d-none');
            btnNext.classList.remove('d-none');
            btnSubmit.classList.add('d-none');
        } else if(step === 2) {
            btnBack.classList.remove('d-none');
            btnNext.classList.remove('d-none');
            btnSubmit.classList.add('d-none');
        } else if(step === 3) {
            btnBack.classList.remove('d-none');
            btnNext.classList.add('d-none');
            btnSubmit.classList.remove('d-none');
        }
    }

    function hitungHarga(id, hargaSewa) {
        // Ambil nilai string tanggal dari input form modal
        let startVal = document.getElementById(`start_date_${id}`).value;
        let endVal = document.getElementById(`end_date_${id}`).value;

        // Jalankan kalkulasi hanya jika kedua tanggal sudah dipilih oleh user
        if (startVal && endVal) {
            let start = new Date(startVal);
            let end = new Date(endVal);
            
            // Menghitung selisih waktu dalam milidetik
            let diffTime = end - start;
            
            // Mengubah milidetik menjadi hitungan hari
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            // Jika memilih tanggal yang sama, tetap dihitung minimal 1 hari sewa
            if (diffDays <= 0) {
                diffDays = 1; 
            }

            // Kalkulasi nominal finansial (Deposit 50%)
            let subtotal = hargaSewa * diffDays;
            let deposit = subtotal * 0.5; 
            let total = subtotal + deposit;

            // Tampilkan hasil kalkulasi ke elemen HTML pratinjau di Step 1
            document.getElementById(`view_duration_${id}`).innerText = `${diffDays} day(s)`;
            document.getElementById(`view_est_${id}`).innerText = 'Rp ' + subtotal.toLocaleString('id-ID');

            // Tampilkan hasil kalkulasi ke elemen tabel rincian final di Step 3
            document.getElementById(`final_duration_${id}`).innerText = `${diffDays} day(s)間`;
            document.getElementById(`final_subtotal_${id}`).innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById(`final_deposit_${id}`).innerText = 'Rp ' + deposit.toLocaleString('id-ID');
            document.getElementById(`final_total_${id}`).innerText = 'Rp ' + total.toLocaleString('id-ID');
        }
    }
</script>

<style>
    .product-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
    .product-img { transition: transform 0.5s ease; }
    .product-card:hover .product-img { transform: scale(1.05); }
</style>
@endsection