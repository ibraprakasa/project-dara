<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Pendonor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

                // Pastikan pendonor ditemukan sebelum mencoba mengakses propertinya
                if ($pendonor) {
                    $diff = $comment->updated_at->diffForHumans();
                    $diff = str_replace('dari sekarang', 'yang lalu', $diff);
                    $responseData[] = [
                        'id_post' => $id,
                        'comment' => [
                            "id" => $comment->id,
                            "id_pendonor" => $comment->id_pendonor,
                            "id_post" => $comment->id_post,
                            "text" => $comment->text,
                            "created_at" => $comment->created_at,
                            "updated_at" => $diff
                        ],
                        'pendonor' => $pendonor,
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
        $validasi = Validator::make($request->all(), [
            'id_pendonor' => 'required|integer',
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
            'id_pendonor' => $request->id_pendonor,
            'id_post' => $request->id_post,
            'text' => $request->text
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Success'
        ]);
    }
}
