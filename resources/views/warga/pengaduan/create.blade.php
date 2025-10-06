<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan</title>
    <style>
        /* Salin semua style CSS Anda dari kode sebelumnya ke sini */
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .form-container { background-color: white; max-width: 600px; margin: auto; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .submit-btn { background-color: #3A64A3; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .alert-danger { color: red; }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Buat Laporan Pengaduan</h2>

        @if ($errors->any())
            <div class="alert-danger">
                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="judul" placeholder="Judul Laporan *" value="{{ old('judul') }}" required>
            </div>
            <div class="form-group">
                <textarea name="isi" placeholder="Isi Laporan *" required>{{ old('isi') }}</textarea>
            </div>
            <div class="form-group">
                <input type="text" name="lokasi" placeholder="Lokasi *" value="{{ old('lokasi') }}" required>
            </div>
            <div class="form-group">
                <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" required>
            </div>
            <div class="form-group">
                <select name="fasilitas_id" required>
                    <option value="" disabled selected>Pilih Fasilitas *</option>
                    @foreach ($daftar_fasilitas as $fasilitas)
                        <option value="{{ $fasilitas->id }}" {{ old('fasilitas_id') == $fasilitas->id ? 'selected' : '' }}>
                            {{ $fasilitas->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="file-upload">Upload Lampiran (Max 2MB)</label>
                <input type="file" id="file-upload" name="lampiran" accept=".jpg, .jpeg, .png" required>
            </div>
            <div class="button-group">
                <input type="submit" class="submit-btn" value="SUBMIT">
            </div>
        </form>
    </div>

</body>
</html>