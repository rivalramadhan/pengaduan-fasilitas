<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Fasilitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $daftar_pengaduan = $user->pengaduans()->latest()->get();

        return view('warga.pengaduan.index', compact('daftar_pengaduan'));
    }

    public function create()
    {
        $daftar_fasilitas = Fasilitas::all();
        
        return view('warga.pengaduan.create', compact('daftar_fasilitas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'lampiran' => 'required|file|image|max:2048',
        ]);

        $path = $request->file('lampiran')->store('lampiran', 'public');

        Pengaduan::create([
            'user_id' => Auth::id(),
            'judul' => $validatedData['judul'],
            'isi' => $validatedData['isi'],
            'tanggal_kejadian' => $validatedData['tanggal_kejadian'],
            'lokasi' => $validatedData['lokasi'],
            'fasilitas_id' => $validatedData['fasilitas_id'],
            'lampiran' => $path,
        ]);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan Anda berhasil dikirim!');
    }

    public function show($id)
    {
        $laporan = Pengaduan::with(['fasilitas', 'user', 'tanggapans.user'])->findOrFail($id);

        if ($laporan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('warga.pengaduan.show', compact('laporan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id() || $pengaduan->status !== 'ditolak') {
            abort(403, 'Anda tidak diizinkan untuk mengedit laporan ini.');
        }

        $daftar_fasilitas = Fasilitas::all();

        return view('warga.pengaduan.edit', [
            'laporan' => $pengaduan,
            'daftar_fasilitas' => $daftar_fasilitas
        ]);
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id() || $pengaduan->status !== 'ditolak') {
            abort(403, 'Anda tidak diizinkan untuk mengedit laporan ini.');
        }

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'lampiran' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            Storage::disk('public')->delete($pengaduan->lampiran);
            $path = $request->file('lampiran')->store('lampiran', 'public');
            $validatedData['lampiran'] = $path;
        }

        $pengaduan->update($validatedData);
        $pengaduan->status = 'dikirim';
        $pengaduan->save();

        return redirect()->route('laporan.show', $pengaduan->id)
            ->with('success', 'Laporan berhasil diperbarui dan dikirim kembali untuk ditinjau.');
    }
}