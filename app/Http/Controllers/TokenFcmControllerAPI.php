<?php

namespace App\Http\Controllers;

use App\Models\TokenFCM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokenFcmControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'home']]);
    }

    public function addToken(Request $request)
    {
        $user = auth()->guard('api')->user();
        $validator = Validator::make($request->all(), [
            'token' => $request->token
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        $status_token_fcm = TokenFCM::where('id_pendonor', $user->id)->where('token', $request->token);

        if (!$status_token_fcm) {
            TokenFCM::create([
                'id_pendonor' => $user->id,
                'token' => $request->token
            ]);

            return response()->json([
                'success' => true,
                'message' => "berhasil"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "gagal"
        ]);
    }

    public function deleteToken($token){
        $user = auth()->guard('api')->user();
        $cek = TokenFCM::where('id_pendonor',$user->id)->where('token',$token)->first();
        if($cek){
            $cek->delete();
        }
    }
}
