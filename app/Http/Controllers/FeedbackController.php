<?php

namespace App\Http\Controllers;

use App\Mail\SendMessageToGuest;
use App\Models\Inquiries;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function getTestimoni(){
        $search = request()->input('search');
        $searchPesan = request()->input('searchpesan');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');
        $tanggalawalpesan = request()->input('tanggal_dari_pesan');
        $tanggalakhirpesan = request()->input('tanggal_sampai_pesan');
        $ratingdara = request()->input('star');
        $successMessage = null;
        $successMessagePesan = null;

        $query = Testimonial::query();
        $query1 = Inquiries::query();

        if ($search) {
            $query->where('text', 'LIKE', '%' . $search . '%')
                ->orwhereHas('pendonor', function ($q) use ($search) {
                    $q->where('nama', 'LIKE', '%' . $search . '%')
                        ->orWhere('kode_pendonor', 'LIKE', '%' . $search . '%');
                });
        }

        if ($searchPesan) {
            $query1->where('message', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%'  . $search . '%');
        }

        if ($tanggalawal && $tanggalakhir) {
            $query->whereBetween('created_at', [$tanggalawal, $tanggalakhir]);
        }
        
        if ($tanggalawalpesan && $tanggalakhirpesan) {
            $query1->whereBetween('created_at', [$tanggalawal, $tanggalakhir]);
        }

        if ($ratingdara){
            $query->where('star', $ratingdara);
        }

        if($search){
            $successMessage = 'Hasil Pencarian untuk "' . $search . '"';
        }if($searchPesan){
            $successMessagePesan = 'Hasil Pencarian untuk "' . $searchPesan . '"';
        }elseif ($tanggalawal && $tanggalakhir  && $ratingdara) {
            $successMessage = 'Filter Berdasarkan Rating Bintang "' . $ratingdara . '" dan Tanggal Awal "' . $tanggalawal . '" sampai dengan "' .$tanggalakhir .'"' ;
        }elseif ($tanggalawal && $tanggalakhir) {
            $successMessage = 'Filter Berdasarkan Tanggal Awal "' . $tanggalawal . '" sampai dengan "' .$tanggalakhir .'"' ;
        }elseif ($tanggalawalpesan && $tanggalakhirpesan) {
            $successMessagePesan = 'Filter Berdasarkan Tanggal Awal "' . $tanggalawalpesan . '" sampai dengan "' .$tanggalakhirpesan .'"' ;
        }elseif ($ratingdara) {
            $successMessage = 'Filter Berdasarkan Rating Bintang "' . $ratingdara .'"' ;
        }

        $query->orderByDesc('star');
        $query1->orderBy('name');

        $data  = $query->paginate(10);
        $data1 = $query1->paginate(10);

        return view('partials.feedback',compact(
            'data','data1','successMessage','successMessagePesan','search','searchPesan','tanggalawal','tanggalakhir','ratingdara','tanggalawalpesan','tanggalakhirpesan'));
    }

    public function postReply(Request $request)
    {
        $replying = $request->input('message');

        $request->validate([
            'email' => 'required|email',
        ]);

        $guest = Inquiries::where('email', $request->email)->first();

        if ($guest) {
            Inquiries::where('id', $guest->id)->update(['reply' => $replying]);

            Mail::to($request->email)->send(new SendMessageToGuest($replying));

            return redirect()->route('feedback')->with('successPesan','Balasan berhasil dikirim.');
        } else {
            return back()->with('errorPesan', 'Email tidak ditemukan.');
        }
    }


    public function deleteTestimoni($id){
        $data = Testimonial::find($id);

        $data->delete();

        return redirect()->route('feedback')->with('successTestimoni','Testimoni berhasil dihapus.');    
    }

    public function deletePesan($id){
        $data = Inquiries::find($id);

        $data->delete();

        return redirect()->route('feedback')->with('successPesan','Pesan berhasil dihapus.');    
    }
}
