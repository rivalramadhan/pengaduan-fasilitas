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
        padding: 34px 28px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(17, 24, 39, 0.06);
        max-width: 520px;
        width: 100%;
        border: 1px solid rgba(16,24,40,0.04);
    }
    .form-title {
        margin: 0 0 8px 0;
        font-size: 1.6em;
        color: #212529;
        text-align: center;
        font-weight: 700;
    }
    .form-instruction {
        margin: 0 0 18px 0;
        font-size: 0.95em;
        color: #6c757d;
        text-align: center;
    }
    .sr-only {
        position: absolute !important;
        height: 1px; width: 1px;
        overflow: hidden; clip: rect(1px, 1px, 1px, 1px);
        white-space: nowrap; border: 0; padding: 0; margin: -1px;
    }
    .form-group {
        margin-bottom: 15px;
        position: relative;
    }
    .form-group input {
        width: 100%;
        padding: 12px 12px;
        border: 1px solid #e6e6ef;
        border-radius: 8px;
        font-size: 16px;
        transition: box-shadow .18s ease, border-color .18s ease;
    }
    .form-group input::placeholder { color: #adb5bd; }
    .form-group input:focus {
        outline: none;
        border-color: #1d1d79;
        box-shadow: 0 6px 18px rgba(29,29,121,0.08);
    }
    .submit-btn {
        width: 100%;
        background-color: #1d1d79;
        padding: 12px 14px;
        margin-top: 12px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: #ffffff;
        font-weight: 600;
    }
    .submit-btn img {
        width: 26px;
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
        background: rgba(114,28,36,0.06);
        border-radius: 6px;
        padding: 8px 10px;
        font-size: 14px;
        margin-top: -6px;
        margin-bottom: 12px;
    }
    @media (max-width: 480px) {
        .form-container { padding: 22px; }
        .form-title { font-size: 1.3em; }
        .submit-btn img { width: 22px; }
    }
</style>
@endpush

@section('content')
<div class="login-body">
    <div class="form-container">
        <h2 class="form-title">Masuk</h2>
        <p class="form-instruction">Masukkan NIK (16 digit) dan kata sandi Anda. Jangan gunakan spasi pada password.</p>

        <form action="{{ route('login') }}" method="POST" novalidate>
            @csrf

            <label for="nik" class="sr-only">NIK</label>
            <div class="form-group">
                <input id="nik" type="text" name="nik" placeholder="NIK *" autocomplete="off" inputmode="numeric" pattern="\d*" value="{{ old('nik') }}" required>
            </div>

            @error('nik')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <label for="passwordInput" class="sr-only">Password</label>
            <div class="form-group">
                <input type="password" id="passwordInput" name="password" placeholder="Password *" required>
            </div>

            @error('password')
                <div class="alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit-btn">
                <span>Masuk</span>
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.getElementById("passwordInput");
        passwordInput.addEventListener("keydown", function(event) {
            if (event.code === "Space" || event.keyCode === 32) {
                event.preventDefault();
            }
        });
    });
</script>
@endpush