<?php

namespace App\Http\Controllers;

use App\Models\JadwalDonor;
use App\Models\JadwalPendonor;
use App\Models\Pendonor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalPendonorControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function find($id)
    {
        $currentDate = Carbon::today()->format('Y-m-d');
        $pendonor = JadwalPendonor::where('id_pendonor', $id)->first();

        if (!$pendonor) {
            return response()->json(['message' => 'Pendonor not found'],400);
        }

        $pendonors = JadwalPendonor::where('id_pendonor', $id)->get();
        $idJadwalPendonorArray = [];

        foreach ($pendonors as $jadwalDonor) {
            $idJadwalPendonorArray[] = $jadwalDonor->id_jadwal_donor_darah;
        }

        $jadwal = [];

        foreach ($idJadwalPendonorArray as $a) {
            $jadwal[] = JadwalDonor::find($a);
        }
        $jadwalTerdekat = [];
        if (!empty($jadwal)) {
            foreach ($jadwal as $x) {
                // Mengambil tanggal dari jadwal
                $tanggalJadwal = Carbon::parse($x->tanggal_donor);
        
                // Memeriksa apakah tanggal jadwal lebih besar atau sama dengan tanggal saat ini
                if ($tanggalJadwal->greaterThanOrEqualTo($currentDate)) {
                    // Menambahkan jadwal yang dekat ke dalam array $jadwalTerdekat
                    $jadwalTerdekat[] = $x;
                }
            }
        }

        if(!empty($jadwalTerdekat)){
            return response()->json($jadwalTerdekat);
        }else{
            return response()->json($jadwalTerdekat,400);
        }
    }

    public function check($id, $idl){
        $pendonor = JadwalPendonor::where('id_pendonor', $id)->first();

        if (!$pendonor) {
            return response()->json([
                'status' => false,
                'message' => 'Pendonor belum mendaftar']);
        }

        $pendonors = JadwalPendonor::where('id_pendonor', $id)->get();

        $idJadwalPendonorArray = [];

        foreach ($pendonors as $jadwalDonor) {
            $idJadwalPendonorArray[] = $jadwalDonor->id_jadwal_donor_darah;
        }

        // memeriksa apakah elemen ada dalam array
        if (collect($idJadwalPendonorArray)->contains($idl)) {
            return response()->json([
                'status' => true,
                'message' => 'sudah mendaftar']);
        }

        return response()->json([
            'status' => false,
            'message' => 'belum mendaftar']);
    }

    public function daftar(Request $request){
        $validasi = Validator::make($request->all(), [
            'id_pendonor' => 'integer',
            'id_jadwal_donor_darah' => 'integer'
        ]);
    
        if($validasi->fails()){
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()
            ]);
        }
    
        // Cari pendonor berdasarkan id_pendonor
        $pendonor = Pendonor::find($request->id_pendonor);
    
        if (!$pendonor) {
            return response()->json([
                'status' => false,
                'message' => 'Pendonor tidak ditemukan'
            ]);
        }
    
        // Cek apakah jadwal sudah ada
        $existingJadwal = JadwalPendonor::where('id_pendonor', $request->id_pendonor)
            ->where('id_jadwal_donor_darah', $request->id_jadwal_donor_darah)
            ->first();
    
        if ($existingJadwal) {
            return response()->json([
                'status' => true,
                'message' => 'Sudah mendaftar'
            ]);
        }
    
        // Tambahkan jadwal baru
        $jadwalBaru = JadwalPendonor::create([
            'id_pendonor' => $request->id_pendonor,
            'id_jadwal_donor_darah' => $request->id_jadwal_donor_darah
        ]);

        $jadwalDonor = JadwalDonor::where('id', $request->id_jadwal_donor_darah)->first();
        $jadwalDonor->jumlah_pendonor = $jadwalDonor->jumlah_pendonor + 1;
        $jadwalDonor->update();
    
        if($jadwalBaru){
            return response()->json([
                'status' => true,
                'message' => 'Menambahkan jadwal'
            ]);
        }
    
        return response()->json([
            'status' => false,
            'message' => 'Menambahkan jadwal gagal'
        ]);
    }
}
