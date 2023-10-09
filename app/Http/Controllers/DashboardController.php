<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\JadwalDonor;
use App\Models\Pendonor;
use App\Models\StokDarah;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stokDarah = StokDarah::all();
        $totalStokDarah = $stokDarah->sum('jumlah');

        $totalBerita = Berita::count();
        $totalPendonor = Pendonor::count();

        $thisMonth = Carbon::now()->format('m');

        $totalJadwal = JadwalDonor::count();
        $thisMonthJadwal = JadwalDonor::whereMonth('tanggal_donor',$thisMonth)->count();

        return view('partials.dashboard',
        compact('stokDarah','totalStokDarah','totalBerita','totalPendonor','totalJadwal','thisMonthJadwal')
    );
    }
}
