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
        // 1. Ambil Statistik Cepat (KPI) - Kode ini sudah ada
        $totalLaporan = Pengaduan::count();
        $laporanBaru = Pengaduan::where('status', 'dikirim')->count();
        $laporanDiproses = Pengaduan::where('status', 'diproses')->count();
        $laporanSelesai = Pengaduan::where('status', 'selesai')->count();
        $totalWarga = User::where('role', 'warga')->count();

        // 2. Ambil 5 Laporan Terbaru - Kode ini sudah ada
        $laporanTerbaru = Pengaduan::with('user')
                            ->where('status', 'dikirim')
                            ->latest()
                            ->take(5)
                            ->get();
            
        // 3. (KODE BARU) Ambil data untuk Grafik Fasilitas
        // Kita join tabel pengaduan dengan fasilitas, group by nama fasilitas,
        // dan hitung total laporannya.
        $chartData = Pengaduan::join('fasilitas', 'pengaduans.fasilitas_id', '=', 'fasilitas.id')
                        ->select('fasilitas.nama', DB::raw('count(pengaduans.id) as total'))
                        ->groupBy('fasilitas.nama')
                        ->orderBy('total', 'desc') // Urutkan dari yang paling banyak
                        ->get();

        // 4. Format data agar bisa dibaca oleh Chart.js
        $chartLabels = $chartData->pluck('nama');
        $chartTotals = $chartData->pluck('total');
            
        // 5. Kirim semua data ke view
        return view('admin.dashboard', [
            'totalLaporan' => $totalLaporan,
            'laporanBaru' => $laporanBaru,
            'laporanDiproses' => $laporanDiproses,
            'laporanSelesai' => $laporanSelesai,
            'totalWarga' => $totalWarga,
            'laporanTerbaru' => $laporanTerbaru,
            'chartLabels' => $chartLabels, // <-- Data baru untuk grafik
            'chartTotals' => $chartTotals, // <-- Data baru untuk grafik
        ]);
    }
}
