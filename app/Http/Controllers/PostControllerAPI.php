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

    public function show()
{
    $posts = Post::orderBy('id', 'desc')->get();
    $responseData = [];

    foreach ($posts as $post) {
        $pendonor = Pendonor::find($post->id_pendonor);
        $jumlah_comment = Comment::where('id_post',$post->id)->count();

        // Pastikan pendonor ditemukan sebelum mencoba mengakses propertinya
        if ($pendonor) {
            $diff = $post->updated_at->diffForHumans();
            $diff = str_replace('dari sekarang', 'yang lalu', $diff);
        
            $responseData[] = [
                'id' => $post->id,
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


    public function addPost(Request $request)
    {
        $user = auth()->guard('api')->user();

        //set validation
    //    $validator = Validator::make($request->all(), [
    //     'text' => 'required_without:gambar', // text harus ada jika gambar kosong
    //     'gambar' => 'required_without:text', // gambar harus ada jika text kosong
    //     ]);

    //     //if validation fails
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()
    //         ]);
    //     }

        $post = Post::create([
            'id_pendonor' => $user->id,
            'text' => $request->text,
            // 'gambar' => $request->gambar
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

    public function findPost($id){

        $post = Post::find($id);
        $pendonor = Pendonor::where('id',$post->id_pendonor)->first();
        $diff = $post->updated_at->diffForHumans();
        $diff = str_replace('dari sekarang', 'yang lalu', $diff);
        $jumlah_comment = Comment::where('id_post',$post->id)->count();
        return response()->json([
            'id' => $post->id,
            'gambar_profile' => $pendonor->gambar,
            'nama' => $pendonor->nama,
            'text' => $post->text,
            'gambar' => $post->gambar,
            'jumlah_comment' => $jumlah_comment,
            'updated_at' => $diff
        ]);
    }
}
