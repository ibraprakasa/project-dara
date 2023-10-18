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
        $tanggal = request()->input('tanggal');
        // dd($goldar,$lokasi);

        $query = RiwayatDonor::query();
        $query1 = RiwayatAmbil::query();

        if ($lokasi) {
            $query->where('lokasi_donor', $lokasi);
            $query1->where('lokasi_ambil', $lokasi);
        }
        
        if ($goldar) {
            $query->whereHas('pendonor.golongandarah', function ($q) use ($goldar) {
                $q->where('id', $goldar);
            });
        }

        if ($tanggal) {
            $query->where('tanggal_donor', $tanggal);
            $query1->where('tanggal_ambil', $tanggal);
        }
        

        $riwayat_donor =  $query->paginate(7);
        $riwayat_ambil =  $query1->paginate(7);
        
        
        return view('partials.riwayatdonor', compact('riwayat_donor','riwayat_ambil','lokasiDaftar','goldarDaftar'));
    }
    
}
