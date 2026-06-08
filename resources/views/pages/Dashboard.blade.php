@extends('layouts.app')

@section('content')
    <style>
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-bottom: 40px; }
        .stat-card { background: white; padding: 25px; border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
        .stat-value { font-size: 32px; font-weight: 700; color: #2D6A4F; margin-top: 5px; }
        .card { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); }
    </style>

    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h1 style="font-size: 32px; color: #2D6A4F;">Dashboard</h1>
            <button style="background: #2D6A4F; color: white; border: none; padding: 10px 20px; border-radius: 10px; cursor: pointer; font-weight: 600;">
                <i class="fas fa-plus"></i> Tambah Alat
            </button>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-box-open" style="font-size: 24px; color: #D4A373;"></i>
                <div>Total Alat</div>
                <div class="stat-value">0</div>
            </div>
            </div>

        <div class="card">
            <h3>Inventaris Alat Terbaru</h3>
            <div style="text-align: center; padding: 40px; color: #999;">
                <i class="fas fa-mountain" style="font-size: 40px; opacity: 0.2; margin-bottom: 10px;"></i>
                <p>Belum ada data alat yang ditambahkan.</p>
            </div>
        </div>
    </div>
@endsection