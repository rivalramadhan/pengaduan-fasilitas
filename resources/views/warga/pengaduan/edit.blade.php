@extends('layouts.warga')
@section('title', 'Perbaiki Laporan')

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
        padding: 30px; 
    }
    .form-group { 
        margin-bottom: 20px; 
    }
    .form-group label { 
        display: block; 
        font-weight: 600; 
        margin-bottom: 8px; 
        color: #4a5568; 
    }
    .form-group input, .form-group textarea, .form-group select { 
        width: 100%; 
        padding: 12px; 
        border: 1px solid #cbd5e0; 
        border-radius: 6px; 
        font-size: 1em; 
        box-sizing: border-box; 
        transition: border-color 0.3s, box-shadow 0.3s; 
    }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
        outline: none;
        border-color: #3A64A3;
        box-shadow: 0 0 0 3px rgba(58, 100, 163, 0.2);
    }
    .form-group textarea {
        min-height: 150px;
        resize: vertical;
    }
    .form-group small {
        margin-top: 5px;
        font-size: 0.85em;
        color: #6c757d;
    }
    .attachment-info {
        font-size: 0.9em;
        color: #333;
        margin-bottom: 5px;
    }
    .attachment-info a {
        color: #007bff;
        font-weight: bold;
    }
    .btn-submit { 
        background-color: #080053; 
        color: white; 
        padding: 12px 25px; 
        border: none; 
        border-radius: 6px; 
        font-weight: bold; 
        cursor: pointer; 
        font-size: 1em;
        transition: background-color 0.3s;
    }
    .btn-submit:hover { 
        background-color: #1d1d79; 
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Perbaiki Laporan Anda</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul Laporan *</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $laporan->judul) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="isi">Isi Laporan *</label>
                    <textarea id="isi" name="isi" required>{{ old('isi', $laporan->isi) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="tanggal_kejadian">Tanggal Kejadian *</label>
                    <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', $laporan->tanggal_kejadian) }}" required>
                </div>

                <div class="form-group">
                    <label for="fasilitas_id">Fasilitas *</label>
                    <select id="fasilitas_id" name="fasilitas_id" required>
                        @foreach ($daftar_fasilitas as $fasilitas)
                            <option value="{{ $fasilitas->id }}" {{ old('fasilitas_id', $laporan->fasilitas_id) == $fasilitas->id ? 'selected' : '' }}>
                                {{ $fasilitas->nama_fasilitas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="lampiran">Lampiran (Opsional)</label>
                    <div class="attachment-info">
                        Lampiran saat ini: 
                        <a href="{{ asset('storage/' . Str::after($laporan->lampiran, 'public/')) }}" target="_blank">Lihat File</a>
                    </div>
                    <input type="file" id="lampiran" name="lampiran" accept=".jpg, .jpeg, .png">
                    <small>Unggah file baru jika ingin mengganti lampiran yang sudah ada.</small>
                </div>
                
                <button type="submit" class="btn-submit">Simpan Perubahan & Kirim Ulang</button>
            </form>
        </div>
    </div>
</div>
@endsection