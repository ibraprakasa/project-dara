<?php

namespace App\Http\Controllers;

use App\Models\BalasComment;
use App\Models\Comment;
use App\Models\Notifikasi;
use App\Models\Pendonor;
use App\Models\Post;
use Carbon\Carbon;
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

    if (!$notifikasi->count()) {
        return response()->json([
            'success' => false,
            'message' => 'notifikasi belum ada'
        ], 404);
    }

    $responseData = [];

    foreach ($notifikasi as $notif) {
        $this->handleNotification($notif, $user, $responseData);
    }

    $this->resDataNotif = array_reverse($responseData);
    return response()->json($this->resDataNotif);
}

private function handleNotification($notif, $user, &$responseData)
{
    $expiredDate = Carbon::parse($notif->updated_at)->addMonths(2);

    if (Carbon::now()->gt($expiredDate)) {
        $notif->delete();
        return; // Lewati notifikasi yang sudah dihapus
    }

    $post = Post::find($notif->id_post);

    if ($post) {
        $this->handlePostNotification($notif, $user, $responseData, $post);
    } else {
        $this->handleCommentNotification($notif, $user, $responseData);
    }
}

private function handlePostNotification($notif, $user, &$responseData, $post)
{
    if ($post->id_pendonor == $user->id) {
        $this->handleCommentNotification($notif, $user, $responseData);
    }
}

private function handleCommentNotification($notif, $user, &$responseData)
{
    $comment = Comment::find($notif->id_comment);

    if ($comment && $comment->id_pendonor != $user->id) {
        $balasComment = BalasComment::where('id_comment', $comment->id)->first();

        if (!$balasComment || ($balasComment && $balasComment->id_pendonor != $user->id)) {
            $pendonor = Pendonor::find($comment->id_pendonor);

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
