<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
use App\Models\jadwalPendonor;
use App\Models\Pendonor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaAkunController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all(); // Mengambil semua peran dari model Role
        $goldar = GolonganDarah::all(); // Mengambil semua golongan darah
        $searchPendonor = request()->input('searchpendonor'); 
        $searchUser = request()->input('searchuser'); 
        $sort = request()->input('sortuser');
        $golonganDarah = request()->input('id_golongan_darah');
        $jenisKelamin = request()->input('jenis_kelamin');
        $successMessage = null;
        $successMessageUser = null;

        $query = Pendonor::query();
        $query1 = User::query();

        if ($searchPendonor) {
            $query  ->Where('nama', 'LIKE', '%' . $searchPendonor . '%')
                    ->orWhere('kode_pendonor', 'LIKE', '%' . $searchPendonor . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchPendonor . '%')
                    ->orWhere('kontak_pendonor', 'LIKE', '%' . $searchPendonor . '%')
                    ->orWhere('tanggal_lahir', 'LIKE', '%' . $searchPendonor . '%');

        }

        if($searchUser){
            $query1 ->where('name', 'LIKE', '%' . $searchUser . '%');
        }

        if ($sort) {
            if ($sort === 'superadmin') {
                $query1->where('role_id',1)->orderBy('name');
            } elseif ($sort === 'admin') {
                $query1->where('role_id',2)->orderBy('name');
            }
        }else{
            $query1->orderByDesc('role_id')->orderBy('created_at');
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
        }elseif($searchUser){
            $successMessageUser = 'Hasil Pencarian untuk "' . $searchUser . '"';
        }elseif($sort){
            $successMessageUser = 'Filter Berdasarkan Role "' . $sort . '"';
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
        $data1 = $query1->paginate(10);

        return view('partials.kelolaakun', compact('data', 'data1', 'roles','goldar','successMessage','searchPendonor','searchUser','sort','jenisKelamin','golonganDarah','successMessageUser'));
    }

    public function insertpendonorsuper(Request $request)
    {
        $request['kode_pendonor'] = 'dara' . rand(10000, 99999);
        $request->validate([
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
        ]);

        Pendonor::create($request->all());
        return redirect()->route('kelolaakun')->with('successPendonor','Data Pendonor berhasil ditambahkan.');    
    }

    public function insertuser(Request $request)
    {
        // User::create($request->all());
        User::create([
            'name' => $request->input('name'),
            'password' => Hash::make($request->password),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'nohp' => $request->input('nohp'),
            'role_id' => $request->input('role_id'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->route('kelolaakun')->with('successUser','User berhasil ditambahkan.');    
    }

    public function updatependonorsuper(Request $request, $id)
    {
        // Mengambil data berdasarkan $id
        $pendonor = Pendonor::find($id);

        // Memperbarui data dengan nilai dari $request->all()
        if($pendonor->update($request->all())){
            return redirect()->route('kelolaakun')->with('successPendonor','Data Pendonor berhasil diperbarui.');    
        }else{
            return redirect()->route('kelolaakun')->with('errorPendonor','Data Pendonor gagal diperbarui. Silahkan cek');    
        }
    }

    public function updateuser(Request $request, $id)
    {
        // Mengambil data berdasarkan $id
        $user = User::find($id);


        // Memperbarui data dengan nilai dari $request->all()
        $user->update($request->all());

        return redirect()->route('kelolaakun')->with('successUser','Data User berhasil diperbarui.');    
    }

    public function deletependonorsuper($id){
        $pendonor = Pendonor::find($id);
        $jadwalDonor = jadwalPendonor::where('id_pendonor',$pendonor->id);
        if($jadwalDonor){
            $jadwalDonor->delete();
        }

        $gambarPath = public_path('assets/img/' . $pendonor->gambar);

            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }

        $pendonor->delete();

        return redirect()->route('kelolaakun')->with('successPendonor','Data Pendonor berhasil dihapus.');    
    }

    public function deleteuser($id){
        $user = User::find($id);

        $user ->delete();

        return redirect()->route('kelolaakun')->with('successUser','User berhasil dihapus.');    
    }

    public function updatepassworduser(Request $request, $id) {
        // Cari pengguna berdasarkan ID yang diberikan
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('kelolaakun')->with('errorUser', 'Pengguna tidak ditemukan.');
        }
    
        $cek = Hash::check($request->passwordlama, $user->password);
        
        if (!$cek) {
            return redirect()->route('kelolaakun')->with('errorUser', 'Kata Sandi Lama Anda tidak cocok dengan yang diinputkan.');
        }
        
        $cek2 = $request->passwordbaru == $request->passwordkonfirmasi;
    
        if (!$cek2) {
            return redirect()->route('kelolaakun')->with('errorUser', 'Kata Sandi Baru dan Konfirmasinya tidak sama.');
        }
    
        // Sekarang Anda dapat memperbarui kata sandi pengguna
        $user->update([
            'password' => Hash::make($request->passwordbaru)
        ]);
    
        return redirect()->route('kelolaakun')->with('successUser', 'Kata Sandi Anda berhasil diperbarui.');
    }
    
}
