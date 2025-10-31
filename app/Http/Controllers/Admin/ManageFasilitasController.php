<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fasilitas;

class ManageFasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.fasilitas-index', compact('fasilitas'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_fasilitas' => 'required|string|max:255|unique:fasilitas',
        ]);

        Fasilitas::create($validatedData);

        return redirect()->route('admin.manage-fasilitas.index')->with('success', 'Fasilitas baru berhasil ditambahkan!');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();

        return redirect()->route('admin.manage-fasilitas.index')->with('success', 'Fasilitas berhasil dihapus!');
    }
}