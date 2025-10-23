@extends('layouts.warga')

@section('title', 'Detail Laporan')

@push('styles')
<style>
    .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .btn-back {
        display: inline-block;
        margin-bottom: 25px;
        padding: 10px 20px;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #5a6268;
        color: white;
        text-decoration: none;
    }

    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
        color: #212529;
    }

    .card-body {
        padding: 25px;
    }

    .meta-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #e9ecef;
    }

    .meta-item dt {
        font-weight: 600;
        color: #6c757d;
        font-size: 0.9em;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .meta-item dd {
        margin: 0;
        color: #212529;
        font-size: 1em;
        font-weight: 500;
    }

    .status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85em;
        font-weight: 600;
        color: white;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-dikirim { background-color: #007bff; }
    .status-diproses { background-color: #ffc107; color: #212529; }
    .status-selesai { background-color: #28a745; }
    .status-ditolak { background-color: #dc3545; }

    .report-content {
        margin-top: 30px;
    }

    .report-content h3 {
        margin-top: 0;
        margin-bottom: 15px;
        color: #495057;
        font-size: 1.2em;
        font-weight: 600;
    }

    .report-content p {
        line-height: 1.6;
        color: #212529;
        margin-bottom: 20px;
    }

    .report-attachment {
        margin-top: 15px;
    }

    .link-lampiran {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .link-lampiran:hover {
        background-color: #0056b3;
        color: white;
        text-decoration: none;
    }

    .response-card {
        background-color: #e3f2fd;
        border-left: 4px solid #2196f3;
        margin-top: 30px;
        padding: 20px;
        border-radius: 0 8px 8px 0;
    }

    .response-card h3 {
        margin-top: 0;
        margin-bottom: 20px;
        color: #1565c0;
        font-size: 1.2em;
        font-weight: 600;
    }

    .tanggapan-item {
        border-bottom: 1px solid #bbdefb;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .tanggapan-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .tanggapan-item p {
        margin-bottom: 10px;
        line-height: 1.6;
        color: #212529;
    }

    .tanggapan-item small {
        color: #666;
        font-size: 0.9em;
    }

    @media (max-width: 768px) {
        .container {
            margin: 20px auto;
            padding: 0 15px;
        }

        .meta-info {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .card-body {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <nav class="breadcrumb-nav">
        <a href="{{ route('laporan.index') }}" class="btn-back">
            &larr; Kembali ke Daftar Laporan
        </a>
    </nav>

    <main class="card">
        <header class="card-header">
            <h1>{{ $laporan->judul }}</h1>
        </header>
        
        <div class="card-body">
            <section class="meta-info">
                <div class="meta-item">
                    <dt>Status Laporan</dt>
                    <dd>
                        @switch($laporan->status)
                            @case('dikirim')
                                <span class="status status-dikirim">Dikirim</span>
                                @break
                            @case('diproses')
                                <span class="status status-diproses">Diproses</span>
                                @break
                            @case('selesai')
                                <span class="status status-selesai">Selesai</span>
                                @break
                            @case('ditolak')
                                <span class="status status-ditolak">Ditolak</span>
                                @break
                            @default
                                <span class="status">{{ ucfirst($laporan->status) }}</span>
                        @endswitch
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
                    <dt>Lokasi</dt>
                    <dd>{{ $laporan->lokasi }}</dd>
                </div>
            </section>

            <section class="report-content">
                <h3>Isi Laporan:</h3>
                <p>{{ $laporan->isi }}</p>

                @if($laporan->lampiran)
                    <h3>Lampiran:</h3>
                    <div class="report-attachment">
                        <a href="{{ asset('storage/' . Str::after($laporan->lampiran, 'public/')) }}" 
                           target="_blank" 
                           class="link-lampiran">
                            Lihat Lampiran
                        </a>
                    </div>
                @endif
            </section>

            @if($laporan->tanggapans->isNotEmpty())
                <section class="response-card">
                    <h3>Tanggapan Petugas</h3>
                    
                    @foreach($laporan->tanggapans as $tanggapan)
                        <article class="tanggapan-item">
                            <p>{{ $tanggapan->isi_tanggapan }}</p>
                            <footer>
                                <small>
                                    Ditanggapi oleh: <strong>{{ $tanggapan->user->nama }}</strong> 
                                    pada {{ $tanggapan->created_at->format('d F Y, H:i') }}
                                </small>
                            </footer>
                        </article>
                    @endforeach
                </section>
            @endif
        </div>
    </main>
</div>
@endsection