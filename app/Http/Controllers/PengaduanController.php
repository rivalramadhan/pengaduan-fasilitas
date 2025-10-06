<?php


namespace App\Http\Controllers;

use App\Models\Pengaduan; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fasilitas;

class PengaduanController extends Controller
{
    public function create()
    {
        $daftar_fasilitas = Fasilitas::all();
        $daftar_pengaduan = Auth::user()->pengaduans()->latest()->get();
        return view('warga.pengaduan.create', ['daftar_fasilitas' => $daftar_fasilitas, 'daftar_pengaduan' => $daftar_pengaduan]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'lampiran' => 'required|file|image|max:2048',
        ]);

        $path = $request->file('lampiran')->store('public/lampiran');

        Pengaduan::create([
            // 'user_id' => Auth::id(),
            'user_id' => 1,
            'judul' => $validatedData['judul'],
            'isi' => $validatedData['isi'],
            'tanggal_kejadian' => $validatedData['tanggal_kejadian'],
            'fasilitas_id' => $validatedData['fasilitas_id'],
            'lampiran' => $path,
        ]);

        return redirect('/pengaduan/create')->with('success', 'Laporan Anda berhasil dikirim!');
    }
}