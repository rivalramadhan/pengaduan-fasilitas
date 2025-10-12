<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Menangani upaya autentikasi.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'nik' => ['required', 'string', 'size:16'],
            'password' => ['required', 'string'],
        ]);

        // 2. Coba lakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Jika berhasil, arahkan berdasarkan role
            $user = Auth::user();
            if ($user->role === 'admin' || $user->role === 'petugas') {
                return redirect()->intended('/admin/dashboard'); // Ganti jika perlu
            }

            return redirect()->intended('/laporan-saya'); // Redirect default untuk 'warga'
        }

        // 4. Jika gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'nik' => 'NIK atau Password yang Anda masukkan salah.',
        ])->onlyInput('nik');
    }

    /**
     * Menangani proses logout.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}