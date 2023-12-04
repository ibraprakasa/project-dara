<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporanControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function add(Request $request){
        $user = auth()->guard('api')->user();

        $validasi = Validator::make($request->all(), [
            'text' => 'required',
            'type' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()
            ]);
        }

        $id_post = null;
        $id_comment = null;
        $id_reply = null;
        if($request->id_post){
            $id_post = $request->id_post;
        }

        if($request->id_comment){
            $id_comment = $request->id_comment;
        }

        if($request->id_reply){
            $id_reply = $request->id_reply;
        }

        $laporan = Laporan::create([
            'id_pendonor' => $user->id,
            'id_post' => $id_post,
            'id_comment' => $id_comment,
            'id_reply' => $id_reply,
            'text' => $request->text,
            'type' => $request->type
        ]);

        if($laporan){
            return response()->json([
                'status' => false,
                'message' => 'Berhasil lapor'
            ]);
        }
    }
}
