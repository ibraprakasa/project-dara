<?php

namespace App\Http\Controllers;

use App\Models\Inquiries;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function getIndex()
    {
        return view('landing-page.details.index');
    }

    public function postInquiries()
    {
        $nama = request()->input('name');
        $email = request()->input('email');
        $kontak = request()->input('phone');
        $pesan = request()->input('message');

        Inquiries::create([
            'name' => $nama,
            'email' => $email,
            'phone' => $kontak,
            'message' => $pesan
        ]);

        return response()->json(['message' => 'Formulir berhasil terkirim.'], 200);
    }
    

}
