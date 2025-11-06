<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
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
            
        
        $chartData = Pengaduan::join('fasilitas', 'pengaduans.fasilitas_id', '=', 'fasilitas.id')
                ->select('fasilitas.nama_fasilitas as nama', DB::raw('count(pengaduans.id) as total'))
                ->groupBy('fasilitas.nama_fasilitas')
                ->orderBy('total', 'desc')
                ->get();

        
        $chartLabels = $chartData->pluck('nama');
        $chartTotals = $chartData->pluck('total');
            
        
        return view('admin.dashboard-index', [
            'totalLaporan' => $totalLaporan,
            'laporanBaru' => $laporanBaru,
            'laporanDiproses' => $laporanDiproses,
            'laporanSelesai' => $laporanSelesai,
            'totalWarga' => $totalWarga,
            'laporanTerbaru' => $laporanTerbaru,
            'chartLabels' => $chartLabels, 
            'chartTotals' => $chartTotals, 
        ]);
    }
}
