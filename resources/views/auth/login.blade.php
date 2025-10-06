@extends('layouts.guest')

@section('title', 'Masuk Akun')

@push('styles')
<style>
    .login-body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh; /* Menggunakan sisa tinggi layar */
        padding: 20px;
        flex-direction: column;
    }
    img.masuk-logo {
        width: 150px;
        height: auto;
        margin-bottom: 20px;
    }
    .form-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 100%;
    }
    .form-group {
        margin-bottom: 15px;
        position: relative;
    }
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }
    .submit-btn {
        width: 100%;
        background-color: #1d1d79;
        padding: 10px;
        margin-top: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }
    .submit-btn img {
        width: 60px;
        height: auto;
    }
    .submit-btn:hover {
        background-color: #2e2e9e;
    }
    p.register-text {
        color: #1d1d79;
        margin-top: 15px;
        font-size: 15px;
        text-align: center;
    }
    .alert-danger {
        color: #721c24;
        font-size: 14px;
        margin-top: -10px;
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="login-body">
    {{-- <img src="{{ asset('img/masuk.png') }}" class="masuk-logo"> --}}

    <div class="form-container">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="nik" placeholder="NIK *" autocomplete="off" value="{{ old('nik') }}" required>
            </div>
            
            @error('nik')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <input type="password" id="passwordInput" name="password" placeholder="Password *" required>
            </div>
            <button type="submit" class="submit-btn"><img src="{{ asset('img/masuk.png') }}"></button>
        </form>
        <p class="register-text">
            Belum punya akun? 
            {{-- <a href="{{ route('register') }}">Daftar</a> --}}
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mencegah spasi pada input password
        const passwordInput = document.getElementById("passwordInput");
        passwordInput.addEventListener("keydown", function(event) {
            if (event.code === "Space" || event.keyCode === 32) {
                event.preventDefault();
            }
        });
    });
</script>
@endpush