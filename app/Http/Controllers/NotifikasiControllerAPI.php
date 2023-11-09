<?php

namespace App\Http\Controllers;

use App\Models\BalasComment;
use App\Models\Comment;
use App\Models\Notifikasi;
use App\Models\Pendonor;
use App\Models\Post;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class NotifikasiControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function show()
{
    $user = auth()->guard('api')->user();
    $notifikasi = Notifikasi::all();
    if (!$notifikasi) {
        return response([
            'success' => false,
            'message' => 'notifikasi belum ada'
        ], 404);
    }

    $responseData = [];
    foreach ($notifikasi as $notif) {
        $post = Post::where('id', $notif->id_post)->first(); // Dapatkan instance model Post
        if ($post) {
            $postMe = Post::where('id', $notif->id_post)->where('id_pendonor', $user->id)->first(); // Dapatkan instance model Post
            if ($postMe) {
                $comment = Comment::where('id', $notif->id_comment)->first(); // Dapatkan instance model Comment
                if ($comment && $comment->id_pendonor != $user->id) {
                    $pendonor = Pendonor::where('id', $comment->id_pendonor)->first();
                    $responseData[] = [
                        'id' => $notif->id,
                        'id_post' => $notif->id_post,
                        'id_comment' => $notif->id_comment,
                        'id_balas_comment' => $notif->id_balas_comment,
                        'status_read' => $notif->status_read,
                        'pendonor' => $pendonor
                    ];
                }
            }

            $commentMe = Comment::where('id', $notif->id_comment)->where('id_pendonor', $user->id)->first(); // Dapatkan instance model Comment
            if ($commentMe) {
                $balasComment = BalasComment::where('id', $notif->id_balas_comment)->first(); // Dapatkan instance model BalasComment
                if ($balasComment && $balasComment->id_pendonor != $user->id) {
                    $pendonor = Pendonor::where('id', $balasComment->id_pendonor)->first();
                    $responseData[] = [
                        'id' => $notif->id,
                        'id_post' => $notif->id_post,
                        'id_comment' => $notif->id_comment,
                        'id_balas_comment' => $notif->id_balas_comment,
                        'status_read' => $notif->status_read,
                        'pendonor' => $pendonor
                    ];
                }
            }
        }
    }
    return response($responseData);
}

    public function updateStatusRead($id){
        $notifikasi = Notifikasi::find($id);
        if(!$notifikasi){
            return response([
                'success'=>false,
                'message'=>'notifikasi tidak ada'
            ]);
        }
    
        $notifikasi->status_read = true;
        $notifikasi->update();
        return response([
            'success'=>true,
            'message'=>'status read == true'
        ]);
    }

}
