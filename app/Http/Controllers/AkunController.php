<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        return view('partials.akun');
    }

    public function updateakun(Request $request){
        User::where('id', auth()->user()->id)->update([
            'name' => $request->input('name'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'nohp' => $request->input('nohp'),
            // Dan seterusnya, sesuai dengan kolom-kolom yang ingin Anda perbarui.
        ]);
        return redirect()->route('akun')->with('success','Informasi Akun berhasil diperbarui.');
    }

    public function updatepassword(Request $request){
        $cek = Hash::check($request->passwordlama, auth()->user()->password);
        if(!$cek){
            return redirect()->route('akun')->with('error','Kata Sandi Lama Anda tidak cocok dengan yang diinputkan.');
        }
        
        $cek2 = $request->passwordbaru == $request->passwordkonfirmasi;

        if (!$cek2) {
            return redirect()->route('akun')->with('error','Kata Sandi Baru dan Konfirmasinya tidak sama.');
        }

        if (auth()->user() instanceof User) {
            // Sekarang Anda dapat memanggil metode 'update' pada model User
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($request->passwordbaru)
            ]);
            return redirect()->route('akun')->with('success','Kata Sandi Anda berhasil diperbarui.');
        }
    }

}
