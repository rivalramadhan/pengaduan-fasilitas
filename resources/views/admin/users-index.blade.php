@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

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
    .role-badge { padding: 6px 12px; border-radius: 20px; font-size: 0.8em; font-weight: 700; color: white; text-transform: capitalize; }
    .role-admin { background-color: #dc3545; }
    .role-warga { background-color: #17a2b8; }
    .actions a, .actions button { margin-right: 15px; text-decoration: none; font-weight: 600; font-size: 1em; font-family: Arial, sans-serif; }
    .action-edit { color: #007bff; }
    .action-delete { background: none; border: none; padding: 0; color: #dc3545; cursor: pointer; }
    .action-delete:hover { text-decoration: underline; color: #a71d2a; }
    .action-disabled { color: #adb5bd; font-style: italic; font-weight: 600; cursor: not-allowed; }
    .empty-state { text-align: center; padding: 40px; color: #6c757d; font-style: italic; }
    .alert-danger { color: #e53e3e; font-size: 0.875em; margin-top: 5px; }

    /* Style untuk Modal */
    .modal-overlay { display: none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; }
    .modal-content { background-color: #fff; padding: 25px; border-radius: 10px; width: 90%; max-width: 600px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
    .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e9ecef; padding-bottom: 15px; margin-bottom: 20px; }
    .modal-header h2 { margin: 0; color: #343a40; }
    .close-button { color: #aaa; font-size: 28px; font-weight: bold; cursor: pointer; }
    .close-button:hover { color: #333; }
    .modal-body .form-group { margin-bottom: 15px; }
    .modal-body label { font-weight: 600; margin-bottom: 5px; display: block; color: #4a5568; font-size: 0.9em;}
    .modal-body input, .modal-body select { width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box; }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Kelola Pengguna</h1>
        <button id="addUserBtn" class="btn-primary">+ Tambah User</button>
    </div>
    
    <div class="table-wrapper">
        <table class="table-laporan">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>No. Telepon</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>{{ $user->no_telp ?? '-' }}</td>
                        <td>
                            <span class="role-badge role-{{ strtolower($user->role) }}">{{ $user->role }}</span>
                        </td>
                        <td class="actions">
                            @if ($user->role == 'admin')
                                <span class="action-disabled">Disabled</span>
                            @else
                                <a href="#" class="action-edit">Edit</a>
                                <form action="{{ route('admin.manage-users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">Belum ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="userModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Tambah Pengguna Baru</h2>
            <span class="close-button">&times;</span>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.manage-users.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nama">Nama Lengkap *</label>
        <input type="text" name="nama" value="{{ old('nama') }}" required>
        @error('nama') <div class="alert-danger">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label for="nik">NIK *</label>
        <input type="text" name="nik" value="{{ old('nik') }}" required>
        @error('nik') <div class="alert-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="no_telp">No. Telepon (Opsional)</label>
        <input type="text" name="no_telp" value="{{ old('no_telp') }}">
        @error('no_telp') <div class="alert-danger">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label for="alamat">Alamat (Opsional)</label>
        <input type="text" name="alamat" value="{{ old('alamat') }}">
        @error('alamat') <div class="alert-danger">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label for="password">Password *</label>
        <input type="password" name="password" required>
        @error('password') <div class="alert-danger">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password *</label>
        <input type="password" name="password_confirmation" required>
    </div>
<input type="hidden" name="role" value="warga">
    <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Simpan Pengguna</button>
</form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('userModal');
    const btn = document.getElementById('addUserBtn');
    const closeBtn = document.querySelector('.close-button');
    btn.onclick = function() { modal.style.display = "flex"; }
    closeBtn.onclick = function() { modal.style.display = "none"; }
    window.onclick = function(event) { if (event.target == modal) { modal.style.display = "none"; } }

    @if ($errors->any())
        modal.style.display = "flex";
    @endif
</script>
@endpush