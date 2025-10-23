@extends('layouts.warga')
@section('title', 'Perbaiki Laporan')

@push('styles')
    {{-- Salin semua CSS dari halaman create.blade.php Anda ke sini --}}
@endpush

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h1>Perbaiki Laporan Anda</h1></div>
        <div class="card-body">
            <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul Laporan *</label>
                    <input type="text" name="judul" value="{{ old('judul', $laporan->judul) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="isi">Isi Laporan *</label>
                    <textarea name="isi" required>{{ old('isi', $laporan->isi) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="tanggal_kejadian">Tanggal Kejadian *</label>
                    <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', $laporan->tanggal_kejadian) }}" required>
                </div>

                <div class="form-group">
                    <label for="fasilitas_id">Fasilitas *</label>
                    <select name="fasilitas_id" required>
                        @foreach ($daftar_fasilitas as $fasilitas)
                            <option value="{{ $fasilitas->id }}" {{ old('fasilitas_id', $laporan->fasilitas_id) == $fasilitas->id ? 'selected' : '' }}>
                                {{ $fasilitas->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="lampiran">Lampiran (Opsional)</label>
                    <p>Lampiran saat ini: <a href="{{ asset('storage/' . Str::after($laporan->lampiran, 'public/')) }}" target="_blank">Lihat file</a></p>
                    <input type="file" name="lampiran" accept=".jpg, .jpeg, .png">
                    <small>Unggah file baru jika ingin mengganti lampiran lama.</small>
                </div>
                
                <button type="submit" class="btn-submit">Simpan Perubahan & Kirim Ulang</button>
            </form>
        </div>
    </div>
</div>
@endsection