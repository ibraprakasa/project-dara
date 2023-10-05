<?php

namespace App\Http\Controllers;

use App\Mail\SendOTP;
use App\Models\PasswordResetRequest;
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

            // Simpan email dan OTP ke tabel password_reset_requests
            PasswordResetRequest::updateOrCreate(
                ['email' => $request->email],
                ['otp' => $otp]
            );

            $request->session()->put('reset_email', $request->email);

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

        $passwordResetRequest = PasswordResetRequest::where('otp', $request->otp)->first();

        // dd($passwordResetRequest);

        if ($passwordResetRequest) {

            return redirect()->route('lupapassword3');
        } else {
            return back()->with(['otp' => 'OTP yang Anda masukkan salah.']);
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
        return back()->with('error', 'Kata Sandi Baru dan Konfirmasinya tidak sama.');
    }

    $resetEmail = $request->session()->get('reset_email');

        if ($resetEmail) {
            // Temukan pengguna berdasarkan email yang disimpan dalam session
            $user = User::where('email', $resetEmail)->first();

            if ($user) {
                // Hapus entri PasswordResetRequest jika ada
                $cek2 = PasswordResetRequest::where('email', $resetEmail)->first();
                if ($cek2) {
                    $cek2->delete();
                }

                // Perbarui kata sandi pengguna
                User::where('email', $resetEmail)->update([
                    'password' => Hash::make($request->passwordbaru)
                ]);

                // Hapus email dari session
                $request->session()->forget('reset_email');
            }
        }

        return redirect()->route('login')->with('success', 'Kata Sandi Anda berhasil diperbarui. Silahkan Login kembali');
    }
}
