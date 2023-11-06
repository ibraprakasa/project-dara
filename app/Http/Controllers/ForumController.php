<?php

namespace App\Http\Controllers;

use App\Models\BalasComment;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function getPostingan()
    {
        $search = request()->input('search');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');

        $query = Post::query();
        
        if ($search) {
            $query->where('text', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('pendonor', function ($q) use ($search) {
                      $q->where('kode_pendonor', 'LIKE', '%' . $search . '%')
                        ->orWhere('nama', 'LIKE', '%' . $search . '%');
                  });
        }

        if ($tanggalawal && $tanggalakhir) {
            $query->whereBetween('created_at', [$tanggalawal . ' 00:00:00', $tanggalakhir . ' 23:59:59']);
        }

        $postingan = $query->paginate(10);
        return view('partials.forum-postingan', compact('postingan'));
    }

    public function getKomentar($id_post)
    {
        $post = Post::find($id_post);

        $search = request()->input('search');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');

        $query = Comment::where('id_post', $id_post);

        if ($search) {
            $query->where('text', 'LIKE', '%' . $search . '%')
                ->orWhereHas('pendonor', function ($q) use ($search) {
                    $q->where('kode_pendonor', 'LIKE', '%' . $search . '%')
                        ->orWhere('nama', 'LIKE', '%' . $search . '%');
                });
        }

        if ($tanggalawal && $tanggalakhir) {
            $query->whereBetween('created_at', [$tanggalawal . ' 00:00:00', $tanggalakhir . ' 23:59:59']);
        }
        $komentar = $query->paginate(10);
        return view('partials.forum-komentar', compact('komentar'));   
    }

    public function getBalasan($id_comment)
    {
        $comment = Comment::find($id_comment);

        $search = request()->input('search');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');

        $query = BalasComment::where('id_comment', $id_comment);

        if ($search) {
            $query->where('text', 'LIKE', '%' . $search . '%')
                ->orWhereHas('pendonor', function ($q) use ($search) {
                    $q->where('kode_pendonor', 'LIKE', '%' . $search . '%')
                        ->orWhere('nama', 'LIKE', '%' . $search . '%');
                });
        }

        if ($tanggalawal && $tanggalakhir) {
            $query->whereBetween('created_at', [$tanggalawal . ' 00:00:00', $tanggalakhir . ' 23:59:59']);
        }

        $balas = $query->paginate(10);
        $post = Post::all();
        return view('partials.forum-balasan', compact('balas','post'));
    }

    public function deletepostingan($id)
    {
        $postingan = Post::find($id);
    
        if ($postingan) {
            $komentar = Comment::where('id_post', $postingan->id)->get();
    
            if ($komentar) {
                // Hapus semua komentar yang terkait
                foreach ($komentar as $comment) {
                    BalasComment::where('id_comment', $comment->id)->delete();
                }
    
                // Hapus semua komentar yang terkait
                $komentar->each->delete();
            }
    
            $postingan->delete();
    
            return redirect()->route('forum-postingan')->with('success', 'Postingan berhasil dihapus.');
        }
    
        return redirect()->route('forum-postingan')->with('error', 'Postingan tidak ditemukan.');
    }

    public function deleteKomentar($id)
    {
        $komentar = Comment::find($id);

        if ($komentar) {
            $balasanKomentar = BalasComment::where('id_comment', $komentar->id)->get();

            if ($balasanKomentar) {
                $balasanKomentar->each->delete();
            }

            $komentar->delete();

            return redirect()->route('forum-komentar', ['id_post' => request('id_post')])->with('success', 'Komentar berhasil dihapus.');
        }

        return redirect()->route('forum-komentar', ['id_post' => request('id_post')])->with('error', 'Komentar tidak dapat ditemukan atau terjadi kesalahan.');
    }


    public function deletebalasan($id)
    {
        $balas = BalasComment::find($id);
        $balas->delete();
        return redirect()->route('forum-balasan', ['id_comment' => request('comment_id')])->with('success', 'Balasan Komentar berhasil dihapus.');
    }
}
