<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Inquiries;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function getIndex()
    {
        $testi=Testimonial::all();
        $news3 = Berita::latest('created_at')->take(3)->get();
        $news2 = Berita::latest('created_at')->take(2)->get();
        $newsAll=Berita::all();

        return view('landing-page.details.index',compact('testi','news3','news2','newsAll'));
    }

    public function getAbout()
    {
        $news = Berita::latest('created_at')->take(3)->get();
        return view('landing-page.details.about-details',compact('news'));
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
