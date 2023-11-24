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
    private $resDataNotif = [];
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function show()
    {
        $user = auth()->guard('api')->user();
        $notifikasi = Notifikasi::all();
        if (!$notifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'notifikasi belum ada'
            ], 404);
        }

        // Menghapus notifikasi yang lebih tua dari 3 bulan
        $tigaBulanYangLalu = now()->subMonths(3);

        $responseData = [];
        foreach ($notifikasi as $notif) {
            // Cek apakah notifikasi dibuat lebih dari 3 bulan yang lalu
            if ($notif->created_at < $tigaBulanYangLalu) {
                // Jika ya, hapus notifikasi
                $notif->delete();
            }

            $post = Post::where('id', $notif->id_post)->first(); // Dapatkan instance model Post
            if ($post) {
                // $postMe = Post::where('id', $notif->id_post)->where('id_pendonor', $user->id)->first(); // Dapatkan instance model Post
                if ($post->id_pendonor == $user->id) {
                    $comment = Comment::find($notif->id_comment)->first(); // Dapatkan instance model Comment
                    $balasComment = BalasComment::where('id_comment', $comment->id_comment)->first();
                    if ($comment->id_pendonor != $user->id && $balasComment == null) {
                        $pendonor = Pendonor::where('id', $comment->id_pendonor)->first();
                        $diff = $notif->updated_at->diffForHumans();
                        $diff = str_replace('dari sekarang', 'yang lalu', $diff);
                        $responseData[] = [
                            'id' => $notif->id,
                            'id_post' => $notif->id_post,
                            'id_comment' => $notif->id_comment,
                            'id_balas_comment' => $notif->id_balas_comment,
                            'status_read' => $notif->status_read,
                            'pendonor' => $pendonor,
                            'update' => $diff
                        ];
                    }
                }

                $commentMe = Comment::where('id', $notif->id_comment)->where('id_pendonor', $user->id)->first(); // Dapatkan instance model Comment
                if ($commentMe) {
                    $balasComment = BalasComment::where('id', $notif->id_balas_comment)->first(); // Dapatkan instance model BalasComment
                    if ($balasComment && $balasComment->id_pendonor != $user->id) {
                        $pendonor = Pendonor::where('id', $balasComment->id_pendonor)->first();
                        $diff = $notif->updated_at->diffForHumans();
                        $diff = str_replace('dari sekarang', 'yang lalu', $diff);
                        $responseData[] = [
                            'id' => $notif->id,
                            'id_post' => $notif->id_post,
                            'id_comment' => $notif->id_comment,
                            'id_balas_comment' => $notif->id_balas_comment,
                            'status_read' => $notif->status_read,
                            'pendonor' => $pendonor,
                            'update' => $diff
                        ];
                    }
                }
            }
        }
        $this->resDataNotif = $responseData;
        $responseData = array_reverse($responseData);
        return response()->json($responseData);
    }

    public function updateStatusRead($id)
    {
        $notifikasi = Notifikasi::find($id);
        if (!$notifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'notifikasi tidak ada'
            ]);
        }

        // Matikan timestamp sementara
        $notifikasi->timestamps = false;
        $notifikasi->update(['status_read' => true]);
        // Aktifkan timestamp kembali jika diperlukan
        $notifikasi->timestamps = true;
        return response([
            'success' => true,
            'message' => 'status read == true'
        ]);
    }

    public function totalNotif()
    {
        $this->show();
        $total_notif = 0;
        foreach ($this->resDataNotif as $res) {
            if ($res['status_read'] == false) {
                $total_notif++;
            }
        }
        return response()->json(['total_notif' => $total_notif]);
    }
}
