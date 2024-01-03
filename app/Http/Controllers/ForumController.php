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
        $search = Request()->input('search');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');
        $successMessage = null;

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

        if ($search) {
            $successMessage = 'Hasil Pencarian untuk "' . $search . '"';
        } elseif ($tanggalawal && $tanggalakhir) {
            $successMessage = 'Filter Berdasarkan Tanggal Awal "' . $tanggalawal . '" sampai dengan "' . $tanggalakhir . '"';
        }

        $postingan = $query->paginate(10);
        return view('partials.forum-postingan', compact('postingan', 'search', 'successMessage'));
    }

    public function getKomentar($id_post)
    {
        $post = Post::find($id_post);

        $search = request()->input('search');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');
        $successMessage = null;

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

        if ($search) {
            $successMessage = 'Hasil Pencarian untuk "' . $search . '"';
        } elseif ($tanggalawal && $tanggalakhir) {
            $successMessage = 'Filter Berdasarkan Tanggal Awal "' . $tanggalawal . '" sampai dengan "' . $tanggalakhir . '"';
        }

        $komentar = $query->paginate(10);
        return view('partials.forum-komentar', compact('komentar', 'search', 'successMessage'));
    }

    public function getBalasan($id_comment)
    {
        $comment = Comment::find($id_comment);
        $postingan = Post::all();

        $search = request()->input('search');
        $tanggalawal = request()->input('tanggal_dari');
        $tanggalakhir = request()->input('tanggal_sampai');
        $successMessage = null;

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

        if ($search) {
            $successMessage = 'Hasil Pencarian untuk "' . $search . '"';
        } elseif ($tanggalawal && $tanggalakhir) {
            $successMessage = 'Filter Berdasarkan Tanggal Awal "' . $tanggalawal . '" sampai dengan "' . $tanggalakhir . '"';
        }

        $balas = $query->paginate(10);
        $post = Post::all();
        return view('partials.forum-balasan', compact('balas', 'post', 'search', 'successMessage', 'postingan'));
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

            $gambarPath = public_path('assets/post/' . $postingan->gambar);

            if (is_file($gambarPath)) {
                // Hapus gambar jika itu adalah file
                unlink($gambarPath);
            }

            $postingan->delete();

            return redirect()->route('forum-postingan')->with('success', 'Postingan berhasil dihapus.');
        }

        return redirect()->route('forum-postingan')->with('error', 'Postingan tidak ditemukan.');
    }

    public function deleteKomentar($id)
    {
        $postId = request('post_id');

        $komentar = Comment::find($id);

        if ($komentar) {
            $balasanKomentar = BalasComment::where('id_comment', $komentar->id)->get();

            if ($balasanKomentar) {
                $balasanKomentar->each->delete();
            }

            $komentar->delete();

            $queryParams = ['id_post' => $postId];
            $url = route('forum-komentar', $queryParams);

            $existingQueryString = http_build_query(request()->except(['post_id']));
            if ($existingQueryString) {
                $url .= '?' . $existingQueryString;
            }

            return redirect($url)->with('success', 'Komentar berhasil dihapus.');
        }

        return redirect()->route('forum-komentar', ['id_post' => request('id_post')])->with('error', 'Komentar tidak dapat ditemukan atau terjadi kesalahan.');
    }


    public function deletebalasan($id)
    {
        $commentId = request('comment_id');

        $balas = BalasComment::find($id);
        $balas->delete();

        $queryParams = ['id_comment' => $commentId];
        $url = route('forum-balasan', $queryParams);

        $existingQueryString = http_build_query(request()->except(['comment_id']));
        if ($existingQueryString) {
            $url .= '?' . $existingQueryString;
        }

        return redirect($url)->with('success', 'Balasan Komentar berhasil dihapus.');
    }
}
