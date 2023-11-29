<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Pendonor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function showAll()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        $responseData = [];

        foreach ($posts as $post) {
            $pendonor = Pendonor::find($post->id_pendonor);
            $jumlah_comment = Comment::where('id_post', $post->id)->count();

            // Pastikan pendonor ditemukan sebelum mencoba mengakses propertinya
            if ($pendonor) {
                $diff = $post->updated_at->diffForHumans();
                $diff = str_replace('dari sekarang', 'yang lalu', $diff);

                $responseData[] = [
                    'id' => $post->id,
                    'id_pendonor' => $pendonor->id,
                    'gambar_profile' => $pendonor->gambar,
                    'nama' => $pendonor->nama,
                    'text' => $post->text,
                    'gambar' => $post->gambar,
                    'jumlah_comment' => $jumlah_comment,
                    'updated_at' => $diff
                ];
            }
        }

        if (count($responseData) > 0) {
            return response()->json($responseData);
        } else {
            return response()->json(['message' => 'Tidak ada data post yang ditemukan'], 404);
        }
    }

    public function show()
{
    $perPage = 7; // Jumlah data per halaman
    $posts = Post::orderBy('id', 'desc')->paginate($perPage);

    $responseData = $posts->map(function ($post) {
        $pendonor = Pendonor::find($post->id_pendonor);
        $jumlah_comment = Comment::where('id_post', $post->id)->count();

        // Pastikan pendonor ditemukan sebelum mencoba mengakses propertinya
        if ($pendonor) {
            $diff = $post->updated_at->diffForHumans();
            $diff = str_replace('dari sekarang', 'yang lalu', $diff);

            return [
                'id' => $post->id,
                'id_pendonor' => $pendonor->id,
                'gambar_profile' => $pendonor->gambar,
                'nama' => $pendonor->nama,
                'text' => $post->text,
                'gambar' => $post->gambar,
                'jumlah_comment' => $jumlah_comment,
                'updated_at' => $diff
            ];
        }

        return null; // Tidak ada data jika pendonor tidak ditemukan
    })->filter(); // Filter data nol (null)

    // $totalPages = $posts->lastPage(); // Mendapatkan jumlah total halaman

    if ($responseData->isNotEmpty()) {
        return response()->json($responseData
        );
    } else {
        return response()->json(['message' => 'Tidak ada data post yang ditemukan'], 403);
    }
}


    public function addPost(Request $request)
    {
        $user = auth()->guard('api')->user();

        $post = Post::create([
            'id_pendonor' => $user->id,
            'text' => $request->text,
        ]);

        // Mengunggah gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/post/'), $file_name);
            $post->gambar = $file_name;
            $post->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil tambah post'
        ]);
    }

    public function findPost($id)
    {

        $post = Post::find($id);
        $pendonor = Pendonor::where('id', $post->id_pendonor)->first();
        $diff = $post->updated_at->diffForHumans();
        $diff = str_replace('dari sekarang', 'yang lalu', $diff);
        $jumlah_comment = Comment::where('id_post', $post->id)->count();
        return response()->json([
            'id' => $post->id,
            'id_pendonor' => $pendonor->id,
            'gambar_profile' => $pendonor->gambar,
            'nama' => $pendonor->nama,
            'text' => $post->text,
            'gambar' => $post->gambar,
            'jumlah_comment' => $jumlah_comment,
            'updated_at' => $diff
        ]);
    }

    public function postMe()
{
    $user = auth()->guard('api')->user();
    $posts = Post::orderBy('id', 'desc')->where('id_pendonor', $user->id)->paginate(7); 
    $responseData = [];

    foreach ($posts as $post) {
        $pendonor = Pendonor::find($post->id_pendonor);
        $jumlah_comment = Comment::where('id_post', $post->id)->count();

        // Pastikan pendonor ditemukan sebelum mencoba mengakses propertinya
        if ($pendonor) {
            $diff = $post->updated_at->diffForHumans();
            $diff = str_replace('dari sekarang', 'yang lalu', $diff);

            $responseData[] = [
                'id' => $post->id,
                'id_pendonor' => $pendonor->id,
                'gambar_profile' => $pendonor->gambar,
                'nama' => $pendonor->nama,
                'text' => $post->text,
                'gambar' => $post->gambar,
                'jumlah_comment' => $jumlah_comment,
                'updated_at' => $diff
            ];
        }
    }

    if (count($responseData) > 0) {
        return response()->json($responseData);
    } else {
        return response()->json(['message' => 'Tidak ada data post yang ditemukan'], 403);
    }
}


    public function postOtherDonor($id)
    {
        $user = Pendonor::where('id',$id)->first();
        $posts = Post::orderBy('id', 'desc')->where('id_pendonor', $user->id)->paginate(7);
        $responseData = [];

        foreach ($posts as $post) {
            $pendonor = Pendonor::find($post->id_pendonor);
            $jumlah_comment = Comment::where('id_post', $post->id)->count();

            // Pastikan pendonor ditemukan sebelum mencoba mengakses propertinya
            if ($pendonor) {
                $diff = $post->updated_at->diffForHumans();
                $diff = str_replace('dari sekarang', 'yang lalu', $diff);

                $responseData[] = [
                    'id' => $post->id,
                    'id_pendonor' => $pendonor->id,
                    'gambar_profile' => $pendonor->gambar,
                    'nama' => $pendonor->nama,
                    'text' => $post->text,
                    'gambar' => $post->gambar,
                    'jumlah_comment' => $jumlah_comment,
                    'updated_at' => $diff
                ];
            }
        }

        if (count($responseData) > 0) {
            return response()->json($responseData);
        } else {
            return response()->json(['message' => 'Tidak ada data post yang ditemukan'], 403);
        }
    }

    public function delete($id){
        $post = Post::where('id',$id);
        if(!$post){
            return response()->json([
                'status' => false,
                'message' => 'postingan tidak ditemukan'
            ]); 
        }
        $user = auth()->guard('api')->user();
        $post = Post::where('id_pendonor',$user->id)->where('id',$id)->first();
        if($post){
           if($post->gambar != null){
            $gambarPath = public_path('assets/post/' . $post->gambar);
    
            // Hapus file gambar jika ada
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
           }
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'success delete'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'gagal delete'
        ]);
    }
}
