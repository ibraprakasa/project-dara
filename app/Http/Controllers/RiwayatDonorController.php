<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
use App\Models\JadwalDonor;
use App\Models\Pendonor;
use App\Models\RiwayatAmbil;
use App\Models\RiwayatDonor;
use Illuminate\Http\Request;


class RiwayatDonorController extends Controller
{
    public function index(Request $request)
    {
        $goldarDaftar = GolonganDarah::all();
        $lokasiDaftar=JadwalDonor::all();

        $goldar = request()->input('id_golongan_darah');
        $lokasi = request()->input('lokasi');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');
        $search = request()->input('search');

        // dd($goldar,$lokasi);

        $query = RiwayatDonor::query();
        $query1 = RiwayatAmbil::query();

        if($search){
            $query->whereHas('pendonor', function ($q) use ($search) {
                $q->where('nama', 'LIKE', '%' . $search . '%');
            });
        
            $query1->whereHas('pendonor', function ($q) use ($search) {
                $q->where('nama', 'LIKE', '%' . $search . '%');
            });
        }

        if ($lokasi) {
            $query->where('lokasi_donor', $lokasi);
        }
        
        if ($goldar) {
            $query->whereHas('pendonor.golongandarah', function ($q) use ($goldar) {
                $q->where('id', $goldar);
            });
        }

        if ($tanggalawal && $tanggalakhir) {
            $query->whereBetween('tanggal_donor', [$tanggalawal, $tanggalakhir]);
            $query1->whereBetween('tanggal_ambil', [$tanggalawal, $tanggalakhir]);
        }

        $query->join('pendonor', 'riwayatdonor.pendonor_id', '=', 'pendonor.id')
        ->orderBy('pendonor.nama');
        
        $riwayat_donor =  $query->paginate(10);
        $riwayat_ambil =  $query1->paginate(10);
        
        
        return view('partials.riwayatdonor', compact('riwayat_donor','riwayat_ambil','lokasiDaftar','goldarDaftar'));
    }
    
}
