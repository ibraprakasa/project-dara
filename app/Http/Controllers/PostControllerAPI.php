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
    $posts = Post::all();
    $responseData = [];

    foreach ($posts as $post) {
        $pendonor = Pendonor::find($post->id_pendonor);
        $jumlah_comment = Comment::where('id_post',$post->id)->count();

        // Pastikan pendonor ditemukan sebelum mencoba mengakses propertinya
        if ($pendonor) {
            $responseData[] = [
                'id' => $post->id,
                'gambar_profile' => $pendonor->gambar,
                'nama' => $pendonor->nama,
                'text' => $post->text,
                'gambar' => $post->gambar,
                'jumlah_comment' => $jumlah_comment,
                'updated_at' => $post->updated_at
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
       $validator = Validator::make($request->all(), [
        'text' => 'required_without:gambar', // text harus ada jika gambar kosong
        'gambar' => 'required_without:text', // gambar harus ada jika text kosong
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $post = Post::create([
            'id_pendonor' => $user->id,
            'text' => $request->text,
            'gambar' => $request->gambar
        ]);

        if($post){
            
        }
    }
}
