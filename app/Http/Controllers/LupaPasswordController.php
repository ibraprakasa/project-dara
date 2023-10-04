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

        // Temukan User berdasarkan alamat email yang diberikan oleh pengguna
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Email ditemukan, lakukan proses selanjutnya
            $otp = mt_rand(1000, 9999);

            // Kirim email OTP
            Mail::to($request->email)->send(new SendOTP($otp));

            return redirect()->route('lupapassword2');
        } else {
            // Jika email tidak ditemukan, mungkin Anda ingin memberikan pesan kesalahan kepada pengguna
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

        // Validasi OTP di sini, jika sesuai, lanjutkan ke halaman reset kata sandi
        // Anda dapat menggunakan session atau metode lain untuk membandingkan OTP yang dikirim dengan yang diinput oleh pengguna

        return redirect()->route('lupapassword3');
    }

    public function getPasswordResetForm()
    {
        return view('lupapassword3');
    }

    public function postPasswordReset(Request $request)
    {
        // Proses reset kata sandi di sini

        return redirect()->route('login')->with('success', 'Kata Sandi Anda berhasil diperbarui. Silahkan Login menggunakan Password yang baru.');
    }
}
