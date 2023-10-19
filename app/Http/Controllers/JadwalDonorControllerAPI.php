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

    public function show()
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
    } else {
        $jadwal_donor_darah = null;
    }
    return response()->json(
        $jadwal_donor_darah
    );
}

}
