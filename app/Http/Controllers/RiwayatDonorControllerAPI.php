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
        return response()->json($riwayatDonor);
    }
}
