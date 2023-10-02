<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
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
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $data = Pendonor::where('nama', 'LIKE', '%' . $search . '%')->get();
            $data1 = User::where('name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $data = Pendonor::all();
            $data1 = User::all();
        }

        return view('partials.kelolaakun', compact('data', 'data1', 'roles','goldar'));
    }

    public function insertpendonorsuper(Request $request)
    {
        $request['kode_pendonor'] = 'dara' . rand(10000, 99999);
        $request->validate([
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        Pendonor::create($request->all());
        return redirect()->route('kelolaakun')->with('success','Pendonor berhasil ditambahkan.');    
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
        return redirect()->route('kelolaakun')->with('success','User berhasil ditambahkan.');    
    }

    public function updatependonorsuper(Request $request, $id)
    {
        // Mengambil data berdasarkan $id
        $pendonor = Pendonor::find($id);

        // Memperbarui data dengan nilai dari $request->all()
        if($pendonor->update($request->all())){
            return redirect()->route('kelolaakun')->with('success','Data Pendonor berhasil diperbarui.');    
        }else{
            return redirect()->route('kelolaakun')->with('error','Data Pendonor gagal diperbarui. Silahkan cek');    
        }
    }

    public function updateuser(Request $request, $id)
    {
        // Mengambil data berdasarkan $id
        $user = User::find($id);


        // Memperbarui data dengan nilai dari $request->all()
        $user->update($request->all());

        return redirect()->route('kelolaakun')->with('success','Data User berhasil diperbarui.');    
    }

    public function deletependonorsuper($id){
        $pendonor = Pendonor::find($id);

        $pendonor ->delete();

        return redirect()->route('kelolaakun')->with('success','Pendonor berhasil dihapus.');    
    }

    public function deleteuser($id){
        $user = User::find($id);

        $user ->delete();

        return redirect()->route('kelolaakun')->with('success','User berhasil dihapus.');    
    }

    public function updatepassworduser(Request $request, $id) {
        // Cari pengguna berdasarkan ID yang diberikan
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('kelolaakun')->with('error', 'Pengguna tidak ditemukan.');
        }
    
        $cek = Hash::check($request->passwordlama, $user->password);
        
        if (!$cek) {
            return redirect()->route('kelolaakun')->with('error', 'Kata Sandi Lama Anda tidak cocok dengan yang diinputkan.');
        }
        
        $cek2 = $request->passwordbaru == $request->passwordkonfirmasi;
    
        if (!$cek2) {
            return redirect()->route('kelolaakun')->with('error', 'Kata Sandi Baru dan Konfirmasinya tidak sama.');
        }
    
        // Sekarang Anda dapat memperbarui kata sandi pengguna
        $user->update([
            'password' => Hash::make($request->passwordbaru)
        ]);
    
        return redirect()->route('kelolaakun')->with('success', 'Kata Sandi Anda berhasil diperbarui.');
    }
    
}
