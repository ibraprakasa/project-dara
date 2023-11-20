<?php

namespace App\Http\Controllers;

use AccountActivated;
use App\Models\BalasComment;
use App\Models\Comment;
use App\Models\Notifikasi;
use App\Models\Pendonor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Laravel\Firebase\Facades\Firebase;

class CommentControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function show($id)
    {
        $comments = Comment::where('id_post', $id)->get();

        if (count($comments) > 0) {
            $responseData = [];

            foreach ($comments as $comment) {
                $pendonor = Pendonor::find($comment->id_pendonor);
                $balas_comment = BalasComment::where('id_comment', $comment->id)->count();

                // Pastikan pendonor ditemukan sebelum mencoba mengakses propertinya
                if ($pendonor) {
                    // date_default_timezone_set('Asia/Jakarta');
                    $diff = $comment->updated_at->diffForHumans();
                    $diff = str_replace('dari sekarang', 'yang lalu', $diff);
                    $responseData[] = [
                        'id_post' => $id,
                        "id_comment" => $comment->id,
                        "id_pendonor" => $comment->id_pendonor,
                        'nama' => $pendonor->nama,
                        "gambar" => $pendonor->gambar,
                        "id_post" => $comment->id_post,
                        "text" => $comment->text,
                        "created_at" => $comment->created_at,
                        "updated_at" => $diff,
                        "jumlah_balasan" => $balas_comment
                    ];
                }
            }

            return response()->json($responseData);
        } else {
            return response()->json(['message' => 'Tidak ada data post comment'], 404);
        }
    }


    public function addComment(Request $request)
    {
        $user = auth()->guard('api')->user();
        $validasi = Validator::make($request->all(), [
            'id_pendonor' => 'integer',
            'id_post' => 'required|integer',
            'text' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()
            ]);
        }

        $pendonor = Pendonor::where('id', $request->id_pendonor);
        $post = Post::where('id', $request->id_post);

        if (!$pendonor || !$post) {
            return response()->json([
                'status' => false,
                'message' => 'Pendonor atau Post tidak ditemukan'
            ]);
        }

        $addComment = Comment::create([
            'id_pendonor' => $user->id,
            'id_post' => $request->id_post,
            'text' => $request->text
        ]);

        $addNotif = Notifikasi::create([
            'id_post' => $request->id_post,
            'id_comment' => $addComment->id
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Success'
        ]);
    }
}
