<?php

namespace App\Http\Controllers;

use App\Models\JadwalDonor;
use Illuminate\Http\Request;

class JadwalDonorController extends Controller
{
    public function index()
    {

        $data = JadwalDonor::all();
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $data = JadwalDonor::where('lokasi', 'LIKE', '%' . $search . '%')->get();
        } else {
            $data = JadwalDonor::all();
        }

        return view('partials.jadwaldonor', compact('data'));
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
