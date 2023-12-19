<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Inquiries;
use App\Models\JadwalDonor;
use App\Models\Pendonor;
use App\Models\RiwayatAmbil;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function getIndex()
    {
        $thisYear = Carbon::now()->format('Y');
        $thisMonth = Carbon::now()->format('m');

        $testi=Testimonial::all();

        $news3 = Berita::latest('created_at')->take(3)->get();
        $news2 = Berita::latest('created_at')->take(2)->get();
        $newsAll=Berita::all();
        $totalBerita = Berita::count();
        $thisMonthBerita = Berita::whereMonth('created_at', $thisMonth)->count();

        $totalJadwal = JadwalDonor::count();
        $thisYearJadwal = JadwalDonor::whereYear('created_at', $thisYear)->count();

        $totalRiwayatAmbil = RiwayatAmbil::sum('jumlah_ambil');

        $pendonor=Pendonor::count();

        return view('landing-page.details.index',compact('testi','news3','news2','newsAll','pendonor','thisMonthBerita','thisYearJadwal','totalRiwayatAmbil'));
    }

    public function getNewsDetail($id)
    {
        $newsDetail = Berita::find($id);
        $news2 = Berita::latest('created_at')->take(2)->get();
        $news3 = Berita::inRandomOrder()->take(3)->get();

        $newsDetail->increment('views');

        $news4 = Berita::orderByDesc('views')->take(4)->get();


        return view('landing-page.details.news-detail',compact('newsDetail','news2','news3','news4'));
    }

    public function getNewsList()
    {
        $news = Berita::orderBy('created_at')->paginate(12);
        $news2 = Berita::latest('created_at')->take(2)->get();

        return view('landing-page.details.news-grid-detail',compact('news','news2'));
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
