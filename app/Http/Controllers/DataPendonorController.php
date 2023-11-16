<?php

namespace App\Http\Controllers;

use App\Models\JadwalDonor;
use App\Models\JadwalPendonor;
use App\Models\GolonganDarah;
use App\Models\Pendonor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPendonorController extends Controller
{
    public function index()
    {
        $goldar = GolonganDarah::all(); // Mengambil semua golongan darah
        $search = request()->input('search');

        $query = Pendonor::query();

        if ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%');
        }

        $data = $query->paginate(5);

        return view('partials.datapendonor', compact('data','goldar'));
    }

    public function insertpendonor(Request $request)
    {
        $request['kode_pendonor'] = 'dara' . rand(10000, 99999);
        $request->validate([
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        Pendonor::create($request->all());
        return redirect()->route('datapendonor')->with('success','Data Pendonor berhasil ditambahkan.');    
    }

    public function updatependonor(Request $request, $id)
    {
        // Mengambil data berdasarkan $id
        $pendonor = Pendonor::find($id);

        // Memperbarui data dengan nilai dari $request->all()
        if($pendonor->update($request->all())){
            return redirect()->route('datapendonor')->with('success','Data Pendonor berhasil diperbarui.');    
        }else{
            return redirect()->route('datapendonor')->with('error','Data Pendonor gagal diperbarui. Silahkan cek');    
        }
    }

    public function deletependonor($id)
    {
        $pendonor = Pendonor::find($id);
        if ($pendonor) {
            // Mendapatkan nama file gambar pendonor
            $imageFilename = $pendonor->gambar;

            // Hapus file gambar terkait dengan pendonor jika ada
            if (!empty($imageFilename) && file_exists(public_path('images/' . $imageFilename))) {
                unlink(public_path('images/' . $imageFilename));
            }

            $jadwalDonor = JadwalPendonor::where('id_pendonor', $pendonor->id);
            if ($jadwalDonor) {
                $jadwalDonor->delete();
            }
            $pendonor->delete();
        }

        return redirect()->route('datapendonor')->with('success','Data Pendonor berhasil dihapus.');    
    }
}
