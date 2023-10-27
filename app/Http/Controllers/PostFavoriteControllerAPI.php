<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostFavoriteControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function show()
    {
        $user = auth()->guard('api')->user();
        $post_favorite = PostFavorite::where('id_pendonor', $user->id)->get();
        return response()->json($post_favorite);
    }

    public function add($id)
    {
        $post = Post::where('id',$id);
        if(!$post){
            return response()->json([
                'status' => false,
                'message' => 'postingan tidak ditemukan'
            ]); 
        }
        $user = auth()->guard('api')->user();

        $add = PostFavorite::create([
            'id_pendonor' => $user->id,
            'id_post' => $id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Success'
        ]);
    }

    public function delete($id){
        $post = PostFavorite::where('id_post',$id);
        if(!$post){
            return response()->json([
                'status' => false,
                'message' => 'postingan tidak ditemukan'
            ]); 
        }
        $user = auth()->guard('api')->user();
        $post_favorite = PostFavorite::where('id_pendonor',$user->id)->where('id_post',$id)->first();
        if($post_favorite){
            $post_favorite->delete();
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

    public function status($id){
        $post = PostFavorite::where('id_post',$id);
        if(!$post){
            return response()->json([
                'status' => false,
                'message' => 'postingan tidak ditemukan'
            ]); 
        }
        $user = auth()->guard('api')->user();
        $post_favorite = PostFavorite::where('id_pendonor',$user->id)->where('id_post',$id)->first();
        if($post_favorite){
            return response()->json([
                'success' => true,
                'message' => 'Tersimpan'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Tidak Tersimpan'
        ]);
    }
}
