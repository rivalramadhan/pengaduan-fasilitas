@extends('layouts.admin')
@section('title', 'Dashboard Laporan')

@push('styles')
<style>
    .container { 
        padding: 30px; 
        max-width: 1200px; 
        margin: auto; 
        background-color: #f8f9fa;
    }
    .page-header { 
        margin-bottom: 30px; 
        color: #343a40; 
        font-size: 2.2em; 
        font-weight: 600; 
        border-bottom: 1px solid #e9ecef; 
        padding-bottom: 15px; 
    }

    .table-wrapper {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .table-laporan {
        width: 100%;
        border-collapse: collapse;
    }

    .table-laporan th, 
    .table-laporan td {
        padding: 18px 25px;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
    }

    .table-laporan th {
        background-color: #eef2f7;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9em;
    }

    .table-laporan tbody tr:last-child td {
        border-bottom: none;
    }

    .table-laporan tbody tr:hover {
        background-color: #f2f6fc;
    }

    .status {
        padding: 7px 14px;
        border-radius: 25px;
        font-size: 0.85em;
        font-weight: 700;
        color: white;
        text-transform: capitalize;
        display: inline-block;
        line-height: 1;
    }

    .status-dikirim { background-color: #007bff; }
    .status-diproses { background-color: #ffc107; color: #343a40; }
    .status-selesai { background-color: #28a745; }
    .status-ditolak { background-color: #6c757d; }

    .action-link {
        color: #007bff;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease-in-out;
    }
    .action-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #6c757d;
        font-style: italic;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .pagination-wrapper {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .pagination li {
        margin: 0 5px;
    }
    .pagination li a,
    .pagination li span {
        display: block;
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        color: #007bff;
        text-decoration: none;
        transition: background-color 0.2s, color 0.2s;
    }
    .pagination li.active span {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
    .pagination li a:hover:not(.active) {
        background-color: #e9ecef;
    }
    .pagination li.disabled span {
        color: #6c757d;
        cursor: not-allowed;
        background-color: #f8f9fa;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="page-header">Daftar Semua Laporan Pengaduan</h1>
    
    <div class="table-wrapper">
        <table class="table-laporan">
            <thead>
                <tr>
                    <th>Judul Laporan</th>
                    <th>Nama Pelapor</th>
                    <th>Tanggal Lapor</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftar_laporan as $laporan)
                    <tr>
                        <td>{{ $laporan->judul }}</td>
                        <td>{{ $laporan->user->nama }}</td>
                        <td>{{ $laporan->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <span class="status status-{{ $laporan->status }}">{{ $laporan->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="action-link">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">Tidak ada laporan pengaduan yang masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $daftar_laporan->links() }}
    </div>
</div>
@endsection