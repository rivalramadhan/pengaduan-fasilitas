@extends('layouts.profile')
@section('title', 'Profil Pengguna')

@push('styles')
<style>
    
    .profile-header {
        background-image: url("{{ asset('img/bg.png') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        padding: 50px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #fff;
    }
    .profile-header .profile-info { display: flex; align-items: center; gap: 20px; }
    .profile-header .profile-picture { width: 80px; height: 80px; border-radius: 50%; background-color: white; display: flex; justify-content: center; align-items: center; }
    .profile-header .profile-picture .icon { width: 48px; height: 48px; color: #080053; }
    .profile-header .username { font-size: 24px; font-weight: bold; }
    .profile-header .logout-button { background-color: #fff; color: #3A64A3; padding: 8px 30px; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s, color 0.3s; }
    .profile-header .logout-button:hover { background-color: #f0f0f0; }
    
    .container { padding: 30px 40px; max-width: 1200px; margin: 0 auto; }
    .container h1 { margin-top: 0; margin-bottom: 30px; color: #2d3748; font-size: 2em; }
    
    .profile-card {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 30px; /* Jarak antar kartu */
    }
    .profile-card h2 { margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px; font-size: 1.5em; color: #2d3748; }

    .profile-form { display: grid; grid-template-columns: 2fr 1fr; gap: 40px; }
    .form-group { display: flex; flex-direction: column; }
    .form-item { margin-bottom: 20px; }
    .form-item label { display: block; font-weight: 600; margin-bottom: 8px; color: #4a5568; font-size: 0.9em; }
    .form-item input { width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 1em; box-sizing: border-box; transition: border-color 0.3s, box-shadow 0.3s; }
    .form-item input:focus { outline: none; border-color: #3A64A3; box-shadow: 0 0 0 3px rgba(58, 100, 163, 0.2); }

    .btn-group { display: flex; flex-direction: column; gap: 15px; }
    .btn { padding: 12px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 1em; transition: background-color 0.3s; width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; }
    .btn-save { background-color: #080053; color: white; }
    .btn-save:hover { background-color: #1d1d79; }
    .btn-cancel { background-color: #e2e8f0; color: #4a5568; }
    .btn-cancel:hover { background-color: #cbd5e0; }

    .alert-danger { color: #e53e3e; font-size: 0.875em; margin-top: 5px; }
    .alert-success { background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #a7f3d0; }
</style>
@endpush

@section('content')
<div class="profile-header">
    <div class="profile-info">
        <div class="profile-picture">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
        </div>
        <div class="username">{{ $user->nama }}</div>
    </div>
    {{-- <button class="logout-button" onclick="document.getElementById('logout-form').submit();">Keluar</button>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form> --}}
</div>

<div class="container">
    <div class="profile-card">
        <h1>Edit Profil</h1>
        @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif
        <form id="profile-form" class="profile-form" action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-item"><label for="nama">Nama Lengkap *</label><input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>@error('nama') <div class="alert-danger">{{ $message }}</div> @enderror</div>
                <div class="form-item"><label for="nik">NIK *</label><input type="text" id="nik" name="nik" value="{{ old('nik', $user->nik) }}" onkeydown="allowNumbersOnly(event)" required>@error('nik') <div class="alert-danger">{{ $message }}</div> @enderror</div>
                <div class="form-item"><label for="no_telp">No. Telp</label><input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" onkeydown="allowNumbersOnly(event)">@error('no_telp') <div class="alert-danger">{{ $message }}</div> @enderror</div>
                <div class="form-item"><label for="alamat">Alamat</label><input type="text" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}">@error('alamat') <div class="alert-danger">{{ $message }}</div> @enderror</div>
            </div>
            <div class="form-group">
                <div class="btn-group"><button type="submit" class="btn btn-save">Simpan Perubahan</button><button type="button" class="btn btn-cancel" onclick="resetForm()">Batal</button></div>
            </div>
        </form>
    </div>

    <div class="profile-card">
        <h2>Ubah Password</h2>
        @if (session('status-password'))
            <div class="alert-success">{{ session('status-password') }}</div>
        @endif
        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-item">
                <label for="current_password">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password" required>
                @error('current_password') <div class="alert-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-item">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password" required>
                @error('password') <div class="alert-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-item">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-save">Ubah Password</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const form = document.getElementById('profile-form');
    const initialValues = {};
    Array.from(form.elements).forEach(input => {
        if (input.name) { initialValues[input.name] = input.value; }
    });

    function resetForm() {
        Array.from(form.elements).forEach(input => {
            if (input.name && initialValues[input.name] !== undefined) {
                input.value = initialValues[input.name];
            }
        });
    }

    function allowNumbersOnly(event) {
        var charCode = event.which || event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            event.preventDefault();
        }
    }
</script>
@endpush