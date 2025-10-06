@extends('layouts.warga')

@section('title', 'Buat Pengaduan Baru')

@section('content')

@push('styles')
<style>
    .main-content { text-align: center; padding: 50px 0; color: white; }
    .main-content h1 { margin-bottom: 0; }
    .main-content p { margin-top: 10px; }
    .form-container { background-color: white; border-radius: 10px; width: 60%; max-width: 600px; margin: 0 auto 50px auto; padding: 40px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); }
    .form-group { margin-bottom: 15px; }
    .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px 15px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px; box-sizing: border-box; margin: 0; }
    .form-group textarea { resize: vertical; min-height: 200px; }
    .upload-section { padding: 10px; border: 1px dashed #ccc; border-radius: 5px; text-align: center; color: #777; font-size: 14px; }
    .button-group { display: flex; justify-content: space-between; align-items: center; }
    .submit-btn { background-color: #3A64A3; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
    .submit-btn:hover { background-color: #080053; }
    .alert-danger ul { list-style: none; padding: 0; margin: 0; color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px;}
</style>
@endpush

<div class="main-content">
    <h1>Layanan Pengaduan Fasilitas Umum Desa Tirtomoyo</h1>
    <p>Buat pengaduan langsung secara online</p>
</div>

<div class="form-container">
    @if ($errors->any())
        <div class="form-group alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaduan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" name="judul" placeholder="Judul Laporan *" autocomplete="off" value="{{ old('judul') }}" required>
        </div>
        <div class="form-group">
            <textarea name="isi" placeholder="Isi Laporan *" autocomplete="off" required>{{ old('isi') }}</textarea>
        </div>
        <div class="form-group">
            <input type="date" id="tanggalInput" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" required>
        </div>
        <div class="form-group">
            <select name="fasilitas_id" required>
                <option value="" disabled selected>Pilih Fasilitas *</option>
                @foreach ($daftar_fasilitas as $fasilitas)
                    <option value="{{ $fasilitas->id }}" {{ old('fasilitas_id') == $fasilitas->id ? 'selected' : '' }}>
                        {{ $fasilitas->nama_fasilitas }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group upload-section">
            <label for="file-upload">UPLOAD LAMPIRAN (MAX 2MB)</label>
            <input type="file" id="file-upload" name="lampiran" accept=".jpg, .jpeg, .png" required>
            <p>Lampiran berupa foto dengan format jpg, jpeg, atau png.</p>
        </div>
        <div class="button-group">
            <a href="#">Panduan</a>
            <input type="submit" class="submit-btn" value="SUBMIT">
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const today = new Date().toISOString().split("T")[0];
        document.getElementById("tanggalInput").setAttribute("max", today);
    });
</script>
@endpush