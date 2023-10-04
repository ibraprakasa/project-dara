<?php

namespace App\Http\Controllers;

use App\Mail\SendOTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LupaPasswordController extends Controller
{
    public function getEmail()
    {
        return view('lupapassword1');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $otp = mt_rand(1000, 9999);

            $user->otp = $otp;
            $user->save();

            Mail::to($request->email)->send(new SendOTP($otp));

            return redirect()->route('lupapassword2');
        } else {
            return back()->with('email', 'Email tidak ditemukan.');
        }
    }

    public function getOTP()
    {
        return view('lupapassword2');
    }

    public function postOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:4',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($request->otp == $user->otp) {
                return redirect()->route('lupapassword3');
                
            } else {
                return back()->with(['otp' => 'OTP yang Anda masukkan salah.']);
            }
        } else {
            return back()->with('email', 'Email tidak ditemukan.');
        }
    }

    public function getPasswordResetForm()
    {
        return view('lupapassword3');
    }

    public function postPasswordReset(Request $request)
    {
        $cek = $request->passwordbaru == $request->passwordkonfirmasi;

        if (!$cek) {
            return redirect()->route('lupapassword3')->with('error','Kata Sandi Baru dan Konfirmasinya tidak sama.');
        }

        if (auth()->user() instanceof User) {
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($request->passwordbaru)
            ]);
            return redirect()->route('login')->with('success','Kata Sandi Anda berhasil diperbarui. Silahkan Login menggunakan Password yang baru.');
        }
    }
}
