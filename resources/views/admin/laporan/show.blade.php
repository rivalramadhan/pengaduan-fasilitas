@extends('layouts.admin')
@section('title', 'Detail Laporan')

@push('styles')
<style>
    .container { display: flex; gap: 30px; padding: 30px; max-width: 1200px; margin: auto; }
    .report-main, .report-sidebar { background-color: white; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    .report-main { flex: 3; }
    .report-sidebar { flex: 2; }
    .report-main h1 { margin-top: 0; }
    .meta-info { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin: 20px 0; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; padding: 20px 0;}
    .meta-info dt { font-weight: bold; color: #718096; }
    .meta-info dd { margin-left: 0; color: #2d3748; }
    .report-sidebar img { width: 100%; border-radius: 8px; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
    .form-group select, .form-group textarea { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e0; }
    .form-group button { width: 100%; padding: 12px; background-color: #2d3748; color: white; font-weight: bold; cursor: pointer; border: none; border-radius: 6px; }
    .alert-success { background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
</style>
@endpush

@section('content')
<div class="container">
    <div class="report-main">
        <h1>{{ $laporan->judul }}</h1>
        <p>Laporan dari: <strong>{{ $laporan->user->nama }}</strong> (NIK: {{ $laporan->user->nik }})</p>
        
        <div class="meta-info">
            <div><dt>Tanggal Lapor</dt><dd>{{ $laporan->created_at->format('d F Y') }}</dd></div>
            <div><dt>Tanggal Kejadian</dt><dd>{{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d F Y') }}</dd></div>
            <div><dt>Fasilitas</dt><dd>{{ $laporan->fasilitas->nama_fasilitas ?? 'N/A' }}</dd></div>
            <div><dt></dt><dd>{{ $laporan->lokasi }}</dd></div>
            
        </div>

        <h3>Isi Laporan</h3>
        <p>{{ $laporan->isi }}</p>

        <hr style="margin-top: 30px;">
        <h3>Riwayat Tanggapan</h3>
        @forelse($laporan->tanggapans as $tanggapan)
            <div class="tanggapan-item">
                <p>{{ $tanggapan->isi_tanggapan }}</p>
                <small>Oleh: <strong>{{ $tanggapan->user->nama }}</strong> pada {{ $tanggapan->created_at->format('d M Y') }}</small>
            </div>
        @empty
            <p>Belum ada tanggapan.</p>
        @endforelse
    </div>

    <div class="report-sidebar">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        <h3>Lampiran</h3>
        <a href="{{ asset('storage/' . Str::after($laporan->lampiran, 'public/')) }}" target="_blank">
            <img src="{{ asset('storage/' . Str::after($laporan->lampiran, 'public/')) }}" alt="Lampiran Laporan">
        </a>
        <hr style="margin: 20px 0;">
        <h3>Update Laporan</h3>
        <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status">Ubah Status</label>
                <select name="status" id="status">
                    <option value="dikirim" @if($laporan->status == 'dikirim') selected @endif>Dikirim</option>
                    <option value="diproses" @if($laporan->status == 'diproses') selected @endif>Diproses</option>
                    <option value="selesai" @if($laporan->status == 'selesai') selected @endif>Selesai</option>
                    <option value="ditolak" @if($laporan->status == 'ditolak') selected @endif>Ditolak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="isi_tanggapan">Beri Tanggapan (Opsional)</label>
                <textarea name="isi_tanggapan" id="isi_tanggapan" rows="5" placeholder="Tulis tanggapan untuk warga..."></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Update & Kirim Tanggapan</button>
            </div>
        </form>
    </div>
</div>
@endsection