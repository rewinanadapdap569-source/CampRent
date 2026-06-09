@extends('layouts.app')

@section('title', 'Dashboard - CampRent Admin')
@section('page-title', 'Dashboard')

@section('content')
    <style>
        /* Desain Grid Statistik Atas */
        .stats-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
            gap: 24px; 
            margin-bottom: 40px; 
        }
        .stat-card { 
            background: var(--card); 
            padding: 25px; 
            border-radius: 20px; 
            border: 1px solid var(--border); 
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stat-info div {
            font-size: 14px;
            color: var(--text-light);
            font-weight: 500;
        }
        .stat-value { 
            font-size: 32px; 
            font-weight: 700; 
            color: var(--primary-dark); 
            margin-top: 5px; 
        }
        
        /* Desain Blok Tabel Penyewaan */
        .dashboard-card { 
            background: var(--card); 
            padding: 30px; 
            border-radius: 20px; 
            border: 1px solid var(--border);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.02); 
        }
        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .card-header-flex h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
        }

        /* Desain Tabel Ringkas */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }
        .custom-table th {
            text-align: left;
            padding: 12px 16px;
            color: var(--text-light);
            font-size: 13px;
            font-weight: 600;
            border-bottom: 2px solid var(--border);
        }
        .custom-table td {
            padding: 16px;
            font-size: 14px;
            color: var(--text);
            border-bottom: 1px solid #f1f5f9;
        }
        .badge-status {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        .status-proses { background: #fef3c7; color: #b45309; }
        .status-pinjam { background: #dbeafe; color: #1e40af; }
        .status-selesai { background: #dcfce7; color: #15803d; }
    </style>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('alat.create') }}" class="btn text-white" style="background: var(--primary); border-radius: 12px; padding: 10px 20px; font-weight: 600; box-shadow: 0 4px 12px rgba(21, 115, 71, 0.2);">
            <i class="fas fa-plus me-2"></i> Tambah Alat Baru
        </a>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <div>Total Jenis Alat</div>
                <div class="stat-value">{{ $totalAlat ?? 0 }}</div>
            </div>
            <i class="fas fa-box-open" style="font-size: 32px; color: #d4a373; opacity: 0.8;"></i>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <div>Unit Tersedia</div>
                <div class="stat-value">{{ $alatTersedia ?? 0 }}</div>
            </div>
            <i class="fas fa-check-circle" style="font-size: 32px; color: #10b981; opacity: 0.8;"></i>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <div>Sewa Aktif</div>
                <div class="stat-value">{{ $sewaAktif ?? 0 }}</div>
            </div>
            <i class="fas fa-retweet" style="font-size: 32px; color: #3b82f6; opacity: 0.8;"></i>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <div>Total Pelanggan</div>
                <div class="stat-value">{{ $totalPelanggan ?? 0 }}</div>
            </div>
            <i class="fas fa-users" style="font-size: 32px; color: #8b5cf6; opacity: 0.8;"></i>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="card-header-flex">
            <h3>Penyewaan Alat Camping Terbaru</h3>
            <span class="badge bg-light text-dark border p-2" style="font-size: 12px; border-radius: 8px;">Real-time Update</span>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Alat yang Disewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Status Kelayakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRentals ?? [] as $rental)
                        <tr>
                            <td style="font-weight: 600; color: var(--primary);">#TRX-{{ $rental->id }}</td>
                            <td>{{ $rental->user->name }}</td>
                            <td>{{ $rental->alat->nama_alat }}</td>
                            <td>{{ \Carbon\Carbon::parse($rental->end_date)->translatedFormat('d F Y') }}</td>
                            <td>
                                @if($rental->status == 'Diprosesk')
                                    <span class="badge-status status-proses">Diproses</span>
                                @elseif($rental->status == 'Dipinjam')
                                    <span class="badge-status status-pinjam">Sedang Dibawa</span>
                                @else
                                    <span class="badge-status status-selesai">Selesai Kembali</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 50px 0; color: var(--text-light);">
                                <i class="fas fa-mountain mb-3" style="font-size: 44px; opacity: 0.2;"></i>
                                <p class="m-0" style="font-size: 15px; font-weight: 500;">Belum ada riwayat transaksi sewa yang masuk ke sistem.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection