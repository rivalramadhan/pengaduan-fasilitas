<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\User;

class DashboardController extends Controller
{
   
    public function index()
    {
        // 1. Ambil Statistik Cepat (KPI)
        $totalLaporan = Pengaduan::count();
        $laporanBaru = Pengaduan::where('status', 'dikirim')->count();
        $laporanDiproses = Pengaduan::where('status', 'diproses')->count();
        $laporanSelesai = Pengaduan::where('status', 'selesai')->count();
        $totalWarga = User::where('role', 'warga')->count();

        $laporanTerbaru = Pengaduan::with('user')
                            ->where('status', 'dikirim')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('admin.dashboard', [
            'totalLaporan' => $totalLaporan,
            'laporanBaru' => $laporanBaru,
            'laporanDiproses' => $laporanDiproses,
            'laporanSelesai' => $laporanSelesai,
            'totalWarga' => $totalWarga,
            'laporanTerbaru' => $laporanTerbaru,
        ]);
    }
}
