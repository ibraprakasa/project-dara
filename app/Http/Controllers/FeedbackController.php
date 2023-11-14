<?php

namespace App\Http\Controllers;

use App\Models\Inquiries;
use App\Models\Testimonial;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class FeedbackController extends Controller
{
    public function getTestimoni(){
        $search = request()->input('search');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');
        $ratingdara = request()->input('star');
        $successMessage = null;

        $query = Testimonial::query();
        $query1 = Inquiries::query();

        if ($search) {
            $query->where('text','LIKE','%' . $search . '%')
            ->orwhereHas('pendonor', function ($q) use ($search) {
                $q->where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('kode_pendonor', 'LIKE', '%' . $search . '%');
            });

            $query1 ->where('message', 'LIKE', '%' . $search . '%')
                    ->orWhere('name','LIKE','%' . $search . '%')
                    ->orWhere('email','LIKE','%' . $search . '%')
                    ->orWhere('phone','LIKE','%'  . $search . '%');
        }

        if ($tanggalawal && $tanggalakhir) {
            $query->whereBetween('created_at', [$tanggalawal, $tanggalakhir]);
            $query1->whereBetween('created_at', [$tanggalawal, $tanggalakhir]);
        }

        if($ratingdara){
            $query->where('star', $ratingdara);
        }

        if($search){
            
        }

        $data  = $query->paginate(10);
        $data1 = $query1->paginate(10);

        return view('partials.feedback',compact('data','data1'));
    }
}
