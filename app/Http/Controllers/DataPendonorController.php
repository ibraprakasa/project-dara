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
    public function index(Request $request)
    {
        $goldar = GolonganDarah::orderBy('nama')->get(); 
        $searchPendonor = request()->input('searchpendonor'); 
        $golonganDarah = request()->input('id_golongan_darah');
        $jenisKelamin = request()->input('jenis_kelamin');
        $successMessage = null;
        $successMessageUser = null;

        $query = Pendonor::query();

        if ($searchPendonor) {
            $query  ->Where('nama', 'LIKE', '%' . $searchPendonor . '%')
                    ->orWhere('kode_pendonor', 'LIKE', '%' . $searchPendonor . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchPendonor . '%')
                    ->orWhere('kontak_pendonor', 'LIKE', '%' . $searchPendonor . '%')
                    ->orWhere('tanggal_lahir', 'LIKE', '%' . $searchPendonor . '%');

        }
        

        if ($golonganDarah) {
            $query->whereHas('golongandarah', function ($q) use ($golonganDarah) {
                $q->where('id', $golonganDarah);
            });
        }

        if ($jenisKelamin) {
            $query->where('jenis_kelamin', $jenisKelamin);
        }

        if($searchPendonor){
            $successMessage = 'Hasil Pencarian untuk "' . $searchPendonor . '"';
        }elseif($jenisKelamin && $golonganDarah){
            $goldarah = GolonganDarah::find($golonganDarah);
            if ($goldarah && $jenisKelamin) {
                $successMessage = 'Filter Berdasarkan Jenis Kelamin "' . $jenisKelamin . '"' . ' dan Golongan Darah "' .$goldarah->nama . '"';
            }
        }elseif($jenisKelamin){
            $successMessage = 'Filter Berdasarkan Jenis Kelamin "' . $jenisKelamin . '"';
        }elseif($golonganDarah){
            $goldarah = GolonganDarah::find($golonganDarah);
            if ($goldarah) {
                $successMessage = 'Filter Berdasarkan Golongan Darah "' . $goldarah->nama . '"';
            }
        }

        $query->orderBy('kode_pendonor');

        $data = $query->paginate(10);

        return view('partials.datapendonor', compact('data', 'goldar','successMessage','searchPendonor','jenisKelamin','golonganDarah'));
    }

    public function insertpendonor(Request $request)
    {
        $request['kode_pendonor'] = 'dara' . rand(10000, 99999);
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan'
        ]);

        Pendonor::create($request->all());
        return redirect()->route('datapendonor')->with('successPendonor','Data Pendonor berhasil ditambahkan.');        
    }

    public function updatependonor(Request $request, $id)
    {
        // Mengambil data berdasarkan $id
        $pendonor = Pendonor::find($id);

        // Memperbarui data dengan nilai dari $request->all()
        if($pendonor->update($request->all())){
            return redirect()->route('datapendonor')->with('successPendonor','Data Pendonor berhasil diperbarui.');    
        }else{
            return redirect()->route('datapendonor')->with('errorPendonor','Data Pendonor gagal diperbarui. Silahkan cek');    
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

        $gambarPath = public_path('assets/img/' . $pendonor->gambar);

        if ($pendonor->gambar && file_exists($gambarPath)) {
            unlink($gambarPath);
        }

        $pendonor->delete();

        return redirect()->route('datapendonor')->with('successPendonor','Data Pendonor berhasil dihapus.');       
    }

    public function updatepasswordpendonor(Request $request, $id) {
        $pendonor = Pendonor::find($id);
    
        if (!$pendonor) {
            return redirect()->route('datapendonor')->with('errorPendonor', 'Pengguna tidak ditemukan.');
        }
    
        $cek = Hash::check($request->passwordlama, $pendonor->password);
        
        if (!$cek) {
            return redirect()->route('datapendonor')->with('errorPendonor', 'Kata Sandi Lama Anda tidak cocok dengan yang diinputkan.');
        }
        
        $cek2 = $request->passwordbaru == $request->passwordkonfirmasi;
    
        if (!$cek2) {
            return redirect()->route('datapendonor')->with('errorPendonor', 'Kata Sandi Baru dan Konfirmasinya tidak sama.');
        }
    
        $pendonor->update([
            'password' => Hash::make($request->passwordbaru)
        ]);
    
        return redirect()->route('datapendonor')->with('successPendonor', 'Kata Sandi Anda berhasil diperbarui.');
    }
}
