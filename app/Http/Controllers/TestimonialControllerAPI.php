<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function add(Request $request){
        $user = auth()->guard('api')->user();
        $validasi = Validator::make($request->all(), [
            'star' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validasi->errors()
            ]);
        }

        $rating = Testimonial::create([
            'id_pendonor' => $user->id,
            'text' => $request->text,
            'star' => $request->star
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil memberikan rating'
        ]);
    }
}
