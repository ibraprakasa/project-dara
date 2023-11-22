<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['show']]);
    }

    public function show(){
        $berita = Berita::orderBy("id","desc")->paginate(7);

        if ($berita->isNotEmpty()) {
            return response()->json($berita->items());
        } else {
            return response()->json(['message' => 'Tidak ada berita yang ditemukan'], 403);
        }
    }
}
