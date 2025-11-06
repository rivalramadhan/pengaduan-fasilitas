@extends('layouts.admin')
@section('title', 'Rekap Laporan')

@push('styles')
<style>
    .container { padding: 30px; max-width: 1200px; margin: auto; }
    
    /* Style untuk Kartu Statistik (KPI) */
    .kpi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
    .kpi-card { background-color: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
    .kpi-card .kpi-title { font-size: 0.9em; font-weight: 600; color: #6c757d; text-transform: uppercase; margin-bottom: 10px; }
    .kpi-card .kpi-value { font-size: 2.5em; font-weight: 700; color: #343a40; }
    .kpi-card.new { background-color: #e6f7ff; border-color: #b3e0ff; }
    .kpi-card.new .kpi-value { color: #007bff; }

    /* (BARU) Grid untuk tabel dan grafik */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr; /* Kolom tabel 1.5x lebih besar dari grafik */
        gap: 30px;
    }
    .grid-card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .section-header { 
        margin-bottom: 0; 
        font-size: 1.5em; 
        font-weight: 600; 
        color: #343a40; 
        padding: 20px 25px;
        border-bottom: 1px solid #e9ecef;
    }
    
    /* (BARU) Container untuk chart agar responsif */
    .chart-container {
        padding: 25px;
        height: 400px; /* Tentukan tinggi agar chart tidak terlalu besar */
        position: relative;
    }

    /* Style untuk tabel */
    .table-laporan { width: 100%; border-collapse: collapse; }
    .table-laporan th, .table-laporan td { padding: 18px 25px; text-align: left; border-bottom: 1px solid #e9ecef; }
    .table-laporan th { background-color: #eef2f7; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 0.9em; }
    .table-laporan tbody tr:last-child td { border-bottom: none; }
    .table-laporan tbody tr:hover { background-color: #f2f6fc; }
    .action-link { color: #007bff; text-decoration: none; font-weight: 600; }
</style>
@endpush

@section('content')
<div class="container">
    <div class="kpi-grid">
        <div class="kpi-card new">
            <div class="kpi-title">Laporan Baru (Perlu Ditinjau)</div>
            <div class="kpi-value">{{ $laporanBaru }}</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-title">Laporan Diproses</div>
            <div class="kpi-value">{{ $laporanDiproses }}</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-title">Laporan Selesai</div>
            <div class="kpi-value">{{ $laporanSelesai }}</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-title">Total Warga</div>
            <div class="kpi-value">{{ $totalWarga }}</div>
        </div>
    </div>

    <div class="dashboard-grid">
        
        <div class="grid-card">
            <h2 class="section-header">Laporan Terbaru (Perlu Ditinjau)</h2>
            <div class="table-wrapper">
                <table class="table-laporan">
                    <thead>
                        <tr>
                            <th>Judul Laporan</th>
                            <th>Pelapor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporanTerbaru as $laporan)
                            <tr>
                                <td>{{ $laporan->judul }}</td>
                                <td>{{ $laporan->user->nama }}</td>
                                <td><a href="{{ route('admin.laporan.show', $laporan->id) }}" class="action-link">Lihat Detail</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="3" style="text-align: center; padding: 20px;">Tidak ada laporan baru.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid-card">
            <h2 class="section-header">Laporan per Fasilitas</h2>
            <div class="chart-container">
                <canvas id="fasilitasChart"></canvas>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Ambil data dari Controller yang sudah diformat
    const chartLabels = @json($chartLabels);
    const chartDataTotals = @json($chartTotals);

    const ctx = document.getElementById('fasilitasChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Jumlah Laporan',
                data: chartDataTotals,
                backgroundColor: 'rgba(58, 100, 163, 0.7)', // Warna primer kita
                borderColor: 'rgba(58, 100, 163, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false // Sembunyikan legenda, karena judul sudah jelas
                }
            }
        }
    });
</script>
@endpush