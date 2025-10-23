@extends('layouts.warga')

@section('title', 'Detail Laporan')

@push('styles')
<style>
    .container {
        max-width: 900px;
        margin: 40px auto;
    }
    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .card-header {
        padding: 20px 25px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    .card-header h1 {
        margin: 0;
        font-size: 1.8em;
    }
    .card-body {
        padding: 25px;
    }
    .meta-info {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #e9ecef;
    }
    .meta-item {
        flex: 1 1 200px;
    }
    .meta-item dt {
        font-weight: bold;
        color: #6c757d;
        font-size: 0.9em;
        margin-bottom: 5px;
    }
    .meta-item dd {
        margin-left: 0;
        color: #212529;
        font-size: 1em;
    }
    .report-content h3 {
        margin-top: 0;
    }
    .report-attachment img {
        max-width: 100%;
        border-radius: 8px;
        margin-top: 10px;
    }
    .response-card {
        background-color: #e9f7ff;
        border-left: 5px solid #007bff;
        margin-top: 30px;
        padding: 20px;
        border-radius: 0 8px 8px 0;
    }
    .response-card h3 {
        margin-top: 0;
        color: #004085;
    }
    .status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: bold;
        color: white;
        display: inline-block;
    }
    .status-dikirim {
        background-color: #007bff;
    }
    .status-diproses {
        background-color: #ffc107;
        color: #333;
    }
    .status-selesai {
        background-color: #28a745;
    }
    .btn-back {
        display: inline-block;
        margin-bottom: 25px;
        font-weight: bold;
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border: 1px solid #ced4da;
        border-radius: 20px;
        transition: all 0.3s;
    }
    .btn-back:hover {
        background-color: #f8f9fa;
        color: #212529;
    }
</style>
@endpush

@section('content')
<div class="container">
    <a href="{{ route('laporan.index') }}" class="btn-back">&larr; Kembali ke Daftar Laporan</a>

    <div class="card">
        <div class="card-header">
            <h1>{{ $laporan->judul }}</h1>
        </div>
        <div class="card-body">
            <div class="meta-info">
                <div class="meta-item">
                    <dt>Status Laporan</dt>
                    <dd>
    @if($laporan->status == 'dikirim')
        <span class="status status-dikirim">Dikirim</span>
    @elseif($laporan->status == 'diproses')
        <span class="status status-diproses">Diproses</span>
    @elseif($laporan->status == 'selesai')
        <span class="status status-selesai">Selesai</span>
    @elseif($laporan->status == 'ditolak')
        <span class="status status-ditolak">Ditolak</span> @endif
</dd>
                </div>
                <div class="meta-item">
                    <dt>Tanggal Dilaporkan</dt>
                    <dd>{{ $laporan->created_at->format('d F Y') }}</dd>
                </div>
                <div class="meta-item">
                    <dt>Tanggal Kejadian</dt>
                    <dd>{{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d F Y') }}</dd>
                </div>
                <div class="meta-item">
                    <dt>Nama Pelapor</dt>
                    <dd>{{ $laporan->user->nama }}</dd>
                </div>
                <div class="meta-item">
                    <dt>Fasilitas</dt>
                    <dd>{{ $laporan->fasilitas->nama_fasilitas }}</dd>
                </div>
                <div class="meta-item">
                    <dt></dt>
                    <dd>{{ $laporan->lokasi }}</dd>
                </div>
            </div>

            <div class="report-content">
                <h3>Isi Laporan Anda:</h3>
                <p>{{ $laporan->isi }}</p>

                <h3>Lampiran:</h3>
                <div class="report-attachment">
                    <a href="{{ asset('storage/' . Str::after($laporan->lampiran, 'public/')) }}" target="_blank" class="link-lampiran">
                        Klik untuk melihat gambar lampiran
                    </a>
                </div>
            </div>

            @if($laporan->tanggapans->isNotEmpty())
                <div class="response-card">
                    <h3>Tanggapan Petugas</h3>
                    
                    @foreach($laporan->tanggapans as $tanggapan)
                        <div class="tanggapan-item" style="border-bottom: 1px solid #bce8f1; padding-bottom: 15px; margin-bottom: 15px;">
                            <p>{{ $tanggapan->isi_tanggapan }}</p>
                            <small>
                                Ditanggapi oleh: <strong>{{ $tanggapan->user->nama }}</strong> 
                                pada {{ $tanggapan->created_at->format('d F Y, H:i') }}
                            </small>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection