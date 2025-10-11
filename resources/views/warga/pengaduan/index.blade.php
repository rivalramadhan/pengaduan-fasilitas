@extends('layouts.warga')

@section('title', 'Riwayat Laporan Saya')

@push('styles')
<style>
    .container { padding: 40px 20px; max-width: 1000px; margin: 0 auto; }
    .table-history { width: 100%; border-collapse: collapse; background-color: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }
    .table-history th, .table-history td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
    .table-history th { background-color: #f8f9fa; }
    .status { padding: 5px 10px; border-radius: 20px; font-size: 0.8em; font-weight: bold; color: white; }
    .status-dikirim { background-color: #007bff; }
    .status-diproses { background-color: #ffc107; color: #333; }
    .status-selesai { background-color: #28a745; }
    .action-link { color: #007bff; text-decoration: none; font-weight: bold; }
    .empty-history { text-align: center; padding: 50px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
</style>
@endpush

@section('content')
<div class="container">
    <h1 style="color: white; text-align: center; margin-bottom: 30px;">Riwayat Laporan Saya</h1>

    @if($daftar_pengaduan->isEmpty())
        <div class="empty-history">
            <h3>Anda belum pernah membuat laporan.</h3>
            <p>Silakan buat laporan pertama Anda melalui tombol di bawah ini.</p>
            <a href="{{ route('pengaduan.create') }}" class="action-link" style="font-size: 1.2em;">Buat Laporan Baru</a>
        </div>
    @else
        <table class="table-history">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Laporan</th>
                    <th>Tanggal Lapor</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($daftar_pengaduan as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $laporan->judul }}</td>
                        <td>{{ $laporan->created_at->format('d M Y') }}</td>
                        <td>
                            @if($laporan->status == 'dikirim')
                                <span class="status status-dikirim">Dikirim</span>
                            @elseif($laporan->status == 'diproses')
                                <span class="status status-diproses">Diproses</span>
                            @else
                                <span class="status status-selesai">Selesai</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('laporan.show', $laporan->id) }}" class="action-link">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection