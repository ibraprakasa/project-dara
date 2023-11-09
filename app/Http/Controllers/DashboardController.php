<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\GolonganDarah;
use App\Models\JadwalDonor;
use App\Models\Pendonor;
use App\Models\StokDarah;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stokDarah = StokDarah::all();
        $totalStokDarah = $stokDarah->sum('jumlah');

        $golonganDarahCounts = StokDarah::join('golongandarah', 'stokdarah.gol_darah', '=', 'golongandarah.id')
            ->select('golongandarah.nama', DB::raw('SUM(stokdarah.jumlah) as total_jumlah'))
            ->groupBy('golongandarah.nama')
            ->get();

        $totalPendonor = Pendonor::count();

        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalBerita = Berita::count();
        $thisYearBerita = Berita::whereYear('created_at', $thisYear)->count();

        $totalJadwal = JadwalDonor::count();
        $thisMonthJadwal = JadwalDonor::whereMonth('tanggal_donor', $thisMonth)->count();


        // Ambil data dari database untuk grafik jadwal donor
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']; // Gantilah ini dengan data bulan yang sesuai
        $jumlahAcaraDonor = [];

        foreach ($bulan as $bln) {
            $acaraPerBulan = JadwalDonor::whereRaw("DATE_FORMAT(tanggal_donor, '%b') = ?", [$bln])->count();
            $jumlahAcaraDonor[] = $acaraPerBulan;
            $stokPerBulan = '';
            $jumlahStokDarah[] = '';
        }


        return view('partials.dashboard', compact(
            'stokDarah',
            'totalStokDarah',
            'totalBerita',
            'totalPendonor',
            'totalJadwal',
            'thisMonthJadwal',
            'thisYearBerita',
            'golonganDarahCounts',
            'bulan',
            'jumlahAcaraDonor',
            'jumlahStokDarah'
        ));
    }   


}
