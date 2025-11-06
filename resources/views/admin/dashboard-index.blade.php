@extends('layouts.admin')
@section('title', 'Rekap Laporan')

@push('styles')
<style>
    .container { padding: 30px; max-width: 1200px; margin: auto; }
    
    /* Style untuk Kartu Statistik (KPI) */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .kpi-card {
        background-color: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }
    .kpi-card .kpi-title {
        font-size: 0.9em;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .kpi-card .kpi-value {
        font-size: 2.5em;
        font-weight: 700;
        color: #343a40;
    }
    /* Warna khusus untuk kartu Laporan Baru */
    .kpi-card.new {
        background-color: #e6f7ff;
        border-color: #b3e0ff;
    }
    .kpi-card.new .kpi-value {
        color: #007bff;
    }

    /* Style untuk tabel (re-use) */
    .section-header { margin-bottom: 20px; font-size: 1.8em; font-weight: 600; color: #343a40; }
    .table-wrapper { background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); overflow: hidden; }
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
            <div class="kpi-title">Total Laporan</div>
            <div class="kpi-value">{{ $totalLaporan }}</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-title">Total Warga</div>
            <div class="kpi-value">{{ $totalWarga }}</div>
        </div>
    </div>

    <h2 class="section-header">Laporan Terbaru (Perlu Ditinjau)</h2>
    <div class="table-wrapper">
        <table class="table-laporan">
            <thead>
                <tr>
                    <th>Judul Laporan</th>
                    <th>Nama Pelapor</th>
                    <th>Tanggal Lapor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporanTerbaru as $laporan)
                    <tr>
                        <td>{{ $laporan->judul }}</td>
                        <td>{{ $laporan->user->nama }}</td>
                        <td>{{ $laporan->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="action-link">Lihat Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 20px;">Tidak ada laporan baru. Kerja bagus!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection