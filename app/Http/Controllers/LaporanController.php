<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Laporan;
use App\Models\Post;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function getLaporan(){
        $daftarType=Laporan::all();
        $postingan=Post::with('comments','comments.reply')->get();
        $search = request()->input('search');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');
        $type = request()->input('type');
        $successMessage = null;

        $query = Laporan::query();
        
        if ($search) {
            $query->where('text', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('pendonor', function ($q) use ($search) {
                      $q->where('kode_pendonor', 'LIKE', '%' . $search . '%')
                        ->orWhere('nama', 'LIKE', '%' . $search . '%');
                  });
        }

        if ($type) {
            $query->where('type', $type);
        }

        if ($tanggalawal && $tanggalakhir) {
            $query->whereBetween('created_at', [$tanggalawal . ' 00:00:00', $tanggalakhir . ' 23:59:59']);
        }

        if($search){
            $successMessage = 'Hasil Pencarian untuk "' . $search . '"';
        }elseif($type && ($tanggalawal && $tanggalakhir)){
            $successMessage = 'Filter Berdasarkan "'. $type .'" saja' . ' dan Tanggal Awal "' . $tanggalawal . '" sampai dengan "' .$tanggalakhir .'"';
        }elseif($type){
            $successMessage = 'Filter Berdasarkan Laporan dengan Tipe "'. $type . '"';
        }elseif($tanggalawal && $tanggalakhir){
            $successMessage = 'Filter Berdasarkan Tanggal Awal "' . $tanggalawal . '" sampai dengan "' .$tanggalakhir .'"' ;
        }

        $report = $query->paginate(10);
        return view('partials.laporan', compact('report','daftarType','postingan','successMessage','search'));
    }

    public function deleteLaporanPalsu($id)
    {
        $laporan = Laporan::find($id);
        $laporan->delete();

        return redirect()->route('laporan')->with('success', 'Laporan Palsu berhasil dihapus.');
    }

    public function deleteLaporanAsli($id)
    {
        $laporan = Laporan::find($id);

        if ($laporan) {
            if ($laporan->type == 'Postingan' && $laporan->posts) {
                $laporan->posts->delete();
            } elseif ($laporan->type == 'Komentar' && $laporan->comments) {
                $laporan->comments->delete();
            } elseif ($laporan->type == 'Balasan' && $laporan->reply) {
                $laporan->reply->delete();
            }

            $laporan->delete();

            return redirect()->route('laporan')->with('success', 'Laporan Asli berhasil dihapus.');
        } else {
            return redirect()->route('laporan')->with('error', 'Laporan tidak ditemukan.');
        }
    }

}
