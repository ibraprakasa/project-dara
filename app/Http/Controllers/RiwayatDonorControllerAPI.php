<?php

namespace App\Http\Controllers;

use App\Models\RiwayatDonor;
use Illuminate\Http\Request;

class RiwayatDonorControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','home']]);
    }

    public function show(){
        $user = auth()->guard('api')->user();
        $riwayatDonor = RiwayatDonor::where('pendonor_id',$user->id)->get();
        $total_donor = 0;
        foreach ($riwayatDonor as $riwayat) {
            $total_donor += $riwayat->jumlah_donor;
        }
        return response()->json([
            'total_donor_darah' => $total_donor,
            'riwayat'=>$riwayatDonor
        ]);
    }
}
