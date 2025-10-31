@extends('layouts.admin')

@section('title', 'Kelola Fasilitas')

@push('styles')
<style>
    /* Menggunakan kembali style dari halaman dashboard untuk konsistensi */
    .container { padding: 30px; max-width: 1200px; margin: auto; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; }
    .page-header h1 { color: #343a40; font-size: 2.2em; font-weight: 600; margin: 0; }
    .btn-primary { background-color: #007bff; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 600; transition: background-color 0.3s; border: none; cursor: pointer; }
    .btn-primary:hover { background-color: #0056b3; }
    .table-wrapper { background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); overflow: hidden; }
    .table-laporan { width: 100%; border-collapse: collapse; }
    .table-laporan th, .table-laporan td { padding: 18px 25px; text-align: left; border-bottom: 1px solid #e9ecef; }
    .table-laporan th { background-color: #eef2f7; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 0.9em; }
    .table-laporan tbody tr:last-child td { border-bottom: none; }
    .table-laporan tbody tr:hover { background-color: #f2f6fc; }
    .action-link-delete { color: #dc3545; text-decoration: none; font-weight: 600; }
    .action-link-delete:hover { color: #a71d2a; text-decoration: underline; }
    .empty-state { text-align: center; padding: 40px; color: #6c757d; font-style: italic; }
    .alert-danger { color: #e53e3e; font-size: 0.875em; margin-top: 5px; }

    /* Style untuk Modal */
    .modal-overlay { display: none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
    .modal-content { background-color: #fff; padding: 25px; border-radius: 10px; width: 90%; max-width: 500px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
    .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; margin-bottom: 20px; }
    .modal-header h2 { margin: 0; color: #343a40; }
    .close-button { color: #aaa; font-size: 28px; font-weight: bold; cursor: pointer; }
    .close-button:hover { color: #333; }
    .modal-body .form-group { margin-bottom: 15px; }
    .modal-body label { font-weight: 600; margin-bottom: 5px; display: block; color: #4a5568; font-size: 0.9em;}
    .modal-body input { width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box; }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Kelola Fasilitas</h1>
        <button id="addBtn" class="btn-primary">+ Tambah Fasilitas</button>
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
                @forelse ($fasilitas as $f) 
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $f->nama_fasilitas }}</td>
<td>
    <form action="{{ route('admin.manage-fasilitas.destroy', $f->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="action-link-delete" style="background:none; border:none; padding:0; cursor:pointer;" onclick="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
            Delete
        </button>
    </form>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="empty-state">Belum ada data fasilitas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="fasilitasModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Tambah Fasilitas Baru</h2>
            <span class="close-button">&times;</span>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.manage-fasilitas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Fasilitas *</label>
                    <input type="text" name="nama_fasilitas" value="{{ old('nama_fasilitas') }}" required>
                    @error('nama_fasilitas') <div class="alert-danger">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Simpan Fasilitas</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('fasilitasModal');
    const btn = document.getElementById('addBtn');
    const closeBtn = document.querySelector('.close-button');

    btn.onclick = function() { modal.style.display = "flex"; }
    closeBtn.onclick = function() { modal.style.display = "none"; }
    window.onclick = function(event) { if (event.target == modal) { modal.style.display = "none"; } }

    @if ($errors->any())
        modal.style.display = "flex";
    @endif
</script>
@endpush