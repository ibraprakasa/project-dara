<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\GolonganDarah;
use App\Models\JadwalDonor;
use App\Models\Pendonor;
use App\Models\RiwayatDonor;
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

        //KONDISI GRAFIK JADWAL DONOR TERLAKSANA
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']; 
        $jumlahAcaraDonor = [];

        foreach ($bulan as $blnJadwal) {
            $acaraPerBulan = JadwalDonor::whereRaw("DATE_FORMAT(tanggal_donor, '%b') = ?", [$blnJadwal])->count();
            $jumlahAcaraDonor[] = $acaraPerBulan;
        }

        // $data = RiwayatDonor::whereMonth('tanggal_donor', 10)->get()->toArray();
        // dd($data);

        // foreach ($bulan as $blnStok){
        //     $data  = new GolonganDarah();
        //     $data = $data
        //         ->whereHas('pendonor.riwayatDonor')
        //         ->with(['pendonor', 'pendonor.riwayatDonor' => function($q){
        //             return $q->whereMonth('tanggal_donor',10);
        //         }]);
        //         dd($data->get()->toArray());
        // }

        //KONDISI GRAFIK STOK DARAH MASUK
        $bulanStokDarah = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $grafikData = [
            'A' => [],
            'AB' => [],
            'B' => [],
            'O' => [],
        ];

        foreach ($bulanStokDarah as $blnStok) {
            $data = GolonganDarah::selectRaw('golongandarah.nama, COALESCE(SUM(riwayatdonor.jumlah_donor), 0) as total_kantong')
                ->leftJoin('pendonor', 'golongandarah.id', '=', 'pendonor.id_golongan_darah')
                ->leftJoin('riwayatdonor', function ($join) use ($blnStok) {
                    $join->on('pendonor.id', '=', 'riwayatdonor.pendonor_id')
                        ->whereMonth('riwayatdonor.tanggal_donor', '=', $blnStok);
                })
                ->groupBy('golongandarah.nama')
                ->get();

            foreach ($data as $item) {
                $grafikData[$item->nama][] = $item->total_kantong;
            }
        }

        $grafikSeries = [];
        foreach ($grafikData as $golonganDarah => $dataBulan) {
            $grafikSeries[] = [
                'name' => $golonganDarah,
                'data' => $dataBulan,
            ];
        }

        // Kemudian, gunakan $grafikSeries dalam script JavaScript Anda



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
            'grafikSeries'
        ));
    }
}
