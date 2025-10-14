@extends('layouts.admin')

@section('title', 'Kelola Fasilitas')

@push('styles')
<style>
    /* Menggunakan kembali style dari halaman dashboard untuk konsistensi */
    .container { 
        padding: 30px; 
        max-width: 1200px; 
        margin: auto;
    }
    .page-header { 
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px; 
        border-bottom: 1px solid #e9ecef; 
        padding-bottom: 15px; 
    }
    .page-header h1 {
        color: #343a40; 
        font-size: 2.2em; 
        font-weight: 600;
        margin: 0;
    }

    /* Style BARU untuk tombol 'Tambah' */
    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }

    .table-wrapper {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .table-laporan {
        width: 100%;
        border-collapse: collapse;
    }
    .table-laporan th, .table-laporan td {
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
    .action-link-delete {
        color: #dc3545; /* Warna merah untuk aksi delete */
        text-decoration: none;
        font-weight: 600;
    }
    .action-link-delete:hover {
        color: #a71d2a;
        text-decoration: underline;
    }
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #6c757d;
        font-style: italic;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Kelola Fasilitas</h1>
        <a href="#" class="btn-primary">
            + Tambah Fasilitas
        </a>
    </div>
    
    <div class="table-wrapper">
        <table class="table-laporan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Fasilitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh data, ganti $fasilitas dengan variabel Anda --}}
                @forelse ($fasilitas as $f) 
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $f->nama_fasilitas }}</td> {{-- Sesuaikan nama kolom jika berbeda --}}
                        <td>
                            <a href="#" class="action-link-delete">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="empty-state">
                            Belum ada data fasilitas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection