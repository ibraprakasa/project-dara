<?php

namespace App\Http\Controllers;

use App\Models\BalasComment;
use App\Models\Comment;
use App\Models\Notifikasi;
use App\Models\Pendonor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BalasCommentControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function show($id){
        $balas_comment = BalasComment::where('id_comment',$id)->get();
        if (count($balas_comment) > 0) {
            $responseData = [];

            foreach ($balas_comment as $balas) {
                $pendonor = Pendonor::find($balas->id_pendonor);

                // Pastikan pendonor ditemukan sebelum mencoba mengakses propertinya
                if ($pendonor) {
                    // date_default_timezone_set('Asia/Jakarta');
                    $diff = $balas->updated_at->diffForHumans();
                    $diff = str_replace('dari sekarang', 'yang lalu', $diff);
                    $responseData[] = [
                        'id' => $balas->id,
                            "id_comment" => $balas->id,
                            "id_pendonor" => $balas->id_pendonor,
                            'nama' => $pendonor->nama,
                            "gambar" => $pendonor->gambar,
                            "text" => $balas->text,
                            "created_at" => $balas->created_at,
                            "updated_at" => $diff
                    ];
                }
            }

            return response()->json($responseData);
        } else {
            return response()->json(['message' => 'Tidak ada data balas comment'], 404);
        }
    }

    public function addBalasComment(Request $request)
    {
        $user = auth()->guard('api')->user();
        $validasi = Validator::make($request->all(), [
            'id_comment' => 'required|integer',
            'text' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()
            ]);
        }

        $pendonor = Pendonor::where('id', $request->id_pendonor);
        $comment = Comment::where('id', $request->id_comment);

        if (!$pendonor || !$comment) {
            return response()->json([
                'status' => false,
                'message' => 'Pendonor atau Comment tidak ditemukan'
            ]);
        }

        $addComment = BalasComment::create([
            'id_comment' => $request->id_comment,
            'id_pendonor' => $user->id,
            'text' => $request->text
        ]);

        $post = Comment::where('id',$request->id_comment)->first();
        $addNotif = Notifikasi::create([
            'id_post' => $post->id_post,
            'id_comment' => $request->id_comment,
            'id_balas_comment' => $addComment->id
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Success'
        ]);
    }
}
