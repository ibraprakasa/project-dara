<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
use App\Models\JadwalDonor;
use App\Models\jadwalPendonor;
use App\Models\Pendonor;
use Illuminate\Http\Request;

class JadwalDonorController extends Controller
{
    public function index()
{
    $data = [];
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $data = JadwalDonor::where('lokasi', 'LIKE', '%' . $search . '%')->get();
    } else {
        $data = JadwalDonor::all();
    }
    return view('partials.jadwaldonor', compact('data'));
}

    public function infojadwaldonor($id){
        // Mengambil data pendaftar untuk semua jadwal donor
    $pendaftar = [];
        $jadwalPendonor = JadwalPendonor::where('id_jadwal_donor_darah', $id)->get();

        foreach ($jadwalPendonor as $pendonor) {
            $dataPendonor = Pendonor::find($pendonor->id_pendonor);
            $dataPendonor = [
                'kode_pendonor' => $dataPendonor->kode_pendonor,
                'nama' => $dataPendonor->nama,
                'goldar' => GolonganDarah::where('id', $dataPendonor->id_golongan_darah)->first()->nama,
                'kontak' => $dataPendonor->kontak_pendonor,
                // tambahkan kolom lain yang Anda perlukan di sini
            ];

            // Menambahkan data pendonor ke dalam array pendaftar
            $pendaftar[] = $dataPendonor;
    }
    // dd($pendaftar);

    return view('partials.jadwaldonor', compact('pendaftar'));
    }

    public function insertjadwaldonor(Request $request)
    {
        JadwalDonor::create($request->all());
        return redirect()->route('jadwaldonor')->with('success','Jadwal berhasil ditambahkan.');    
    }

    public function updatejadwaldonor(Request $request, $id)
    {
        // Mengambil data berdasarkan $id
        $jadwalDonor = JadwalDonor::find($id);

        // Memperbarui data dengan nilai dari $request->all()
        $jadwalDonor->update($request->all());

        return redirect()->route('jadwaldonor')->with('success','Jadwal berhasil diperbarui.');    
    }

    public function deletejadwaldonor($id){
        $jadwalDonor = JadwalDonor::find($id);

        $jadwalDonor ->delete();

        return redirect()->route('jadwaldonor')->with('success','Jadwal berhasil dihapus.');    
    }

}
