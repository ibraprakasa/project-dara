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

        $report = $query->paginate(10);
        // dd($report);
        return view('partials.laporan', compact('report','daftarType','postingan'));
    }

    public function deleteLaporanPalsu($id)
    {
        $laporan = Laporan::find($id);
        $laporan->delete();

        return redirect()->route('laporan')->with('success', 'Laporan Palsu berhasil dihapus.');
    }

    public function deleteLaporanAsli($id, $id_post)
    {
        $laporan = Laporan::find($id);
        $postingan = Laporan::find($id_post);
        $postingan->delete();
        $laporan->delete();

        return redirect()->route('laporan')->with('success', 'Laporan Palsu berhasil dihapus.');
    }
}
