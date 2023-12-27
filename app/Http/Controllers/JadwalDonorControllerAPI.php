<?php

namespace App\Http\Controllers;

use App\Models\JadwalDonor;
use App\Models\JadwalPendonor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalDonorControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function show(Request $request)
{
    $userId = auth()->guard('api')->user();
    $pendonors = JadwalPendonor::where('id_pendonor',$userId->id)->get();

    $idJadwalPendonorArray = [];

    foreach ($pendonors as $jadwalDonor) {
        $idJadwalPendonorArray[] = $jadwalDonor->id_jadwal_donor_darah;
    }

    $currentDate = Carbon::today()->format('Y-m-d');
    $jadwal_donor_darah = JadwalDonor::all();
    $jadwalTerdekat = [];
    if (!empty($jadwal_donor_darah)) {
        foreach ($jadwal_donor_darah as $x) {
            // Mengambil tanggal dari jadwal
            $tanggalJadwal = Carbon::parse($x->tanggal_donor);

            // Memeriksa apakah tanggal jadwal lebih besar atau sama dengan tanggal saat ini
            if ($tanggalJadwal->greaterThanOrEqualTo($currentDate)) {
                // Menambahkan jadwal yang dekat ke dalam array $jadwalTerdekat
                $jadwal = $x; // Salin isi $x ke variabel $jadwal untuk menghindari perubahan langsung pada $x
                // memeriksa apakah elemen ada dalam array
                $jarak = 0;
                if($request->lat != 0 || $request->long !=0){
                    $jarak = $this->haversineDistance($request->lat,$request->long,$x->latitude,$x->longitude);
                    $jadwal->jarak = $jarak;
                }
                if (collect($idJadwalPendonorArray)->contains($x->id)) {
                    $jadwal->status = true; // Tambahkan key "status" ke objek $jadwal
                } else {
                    $jadwal->status = false; // Jika tidak ada, tetapkan "status" ke false
                }
                $jadwalTerdekat[] = $jadwal; // Tambahkan objek $jadwal ke dalam array $jadwalTerdekat
            }
        }
    }
    if (!empty($jadwalTerdekat)) {
        $jadwal_donor_darah = $jadwalTerdekat;
        return response()->json(
            $jadwal_donor_darah
        );
    } else {
        $jadwal_donor_darah = null;
        return response()->json(
            $jadwal_donor_darah,400
        );
    }
}

public function haversineDistance($lat1, $lon1, $lat2, $lon2) {
    // Konversi derajat ke radian
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Selisih latitude dan longitude
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;

    // Rumus Haversine
    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Radius bumi dalam kilometer
    $earthRadius = 6371;

    // Hitung jarak
    $distance = $earthRadius * $c;

    return $distance;
}

}
