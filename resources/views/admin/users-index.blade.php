@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@push('styles')
<style>
    .action-disabled {
        color: #adb5bd;
        font-style: italic;
        font-weight: 600;
        cursor: not-allowed;
    }
    .container {
        padding: 30px;
        max-width: 1200px;
        margin: auto;
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 15px;
    }
    .page-header h1 {
        color: #343a40;
        font-size: 2.2em;
        font-weight: 600;
        margin: 0;
    }
    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .table-wrapper {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .table-laporan {
        width: 100%;
        border-collapse: collapse;
    }
    .table-laporan th,
    .table-laporan td {
        padding: 18px 25px;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
    }
    .table-laporan th {
        background-color: #eef2f7;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9em;
    }
    .table-laporan tbody tr:last-child td {
        border-bottom: none;
    }
    .table-laporan tbody tr:hover {
        background-color: #f2f6fc;
    }
    .role-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8em;
        font-weight: 700;
        color: white;
        text-transform: capitalize;
    }
    .role-admin {
        background-color: #dc3545;
    }
    .role-warga {
        background-color: #17a2b8;
    }
    .actions a {
        margin-right: 15px;
        text-decoration: none;
        font-weight: 600;
    }
    .action-edit {
        color: #007bff;
    }
    .action-delete {
        background: none;
        border: none;
        padding: 0;
        color: #dc3545;
        font-weight: 600;
        cursor: pointer;
        font-size: 1em;
        font-family: Arial, sans-serif;
    }
    .action-delete:hover {
        text-decoration: underline;
        color: #a71d2a;
    }
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #6c757d;
        font-style: italic;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Kelola Pengguna</h1>
        <a href="#" class="btn-primary">+ Tambah Warga</a>
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
                            <span class="role-badge role-{{ strtolower($user->role) }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="actions">
                            @if ($user->role == 'admin')
                                <span class="action-disabled">Disabled</span>
                            @else
                                
                                <form action="{{ route('admin.manage-users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        Delete
                                    </button>
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
@endsection