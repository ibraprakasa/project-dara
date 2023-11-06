<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $search = request()->input('search');

        $query = Berita::query();

        if ($search) {
            $query->where('judul', 'LIKE', '%' . $search . '%');
        }

        $data = $query->paginate(5);

        return view('partials.berita', compact('data'));
    }

    public function insertberita(Request $request){
        $berita = Berita::create($request->all());
        if($request->hasFile('gambar')){
            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $berita->gambar = $request->file('gambar')->getClientOriginalName();
            $berita->save();
        }
        
        return redirect()->route('berita')->with('success','Berita berhasil ditambahkan.');    
    }

    public function updateberita(Request $request, $id){
        $berita = Berita::find($id);

        $berita->update($request->all());
        if($request->hasFile('gambar')){
            $request->file('gambar')->move('assets/img/', $request->file('gambar')->getClientOriginalName());
            $berita->gambar = $request->file('gambar')->getClientOriginalName();
            $berita->save();
        }

        return redirect()->route('berita')->with('success','Berita berhasil diperbarui.');        
    }

    public function deleteberita($id){
        $berita = Berita::find($id);
    
        $gambarPath = public_path('assets/img/' . $berita->gambar);
    
        // Hapus file gambar jika ada
        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }
    
        $berita->delete();
    
        return redirect()->route('berita')->with('success', 'Berita berhasil dihapus.');
    }
    
}
