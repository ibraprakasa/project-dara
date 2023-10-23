<?php

use App\Http\Controllers\BeritaControllerAPI;
use App\Http\Controllers\CommentControllerAPI;
use App\Http\Controllers\DataPendonorControllerAPI;
use App\Http\Controllers\JadwalDonorControllerAPI;
use App\Http\Controllers\JadwalPendonorControllerAPI;
use App\Http\Controllers\LupaPasswordControllerAPI;
use App\Http\Controllers\PostControllerAPI;
use App\Http\Controllers\RiwayatDonorControllerAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/login", [DataPendonorControllerAPI::class, 'login']);
Route::get("/logout", [DataPendonorControllerAPI::class, 'logout']);
Route::get("/home", [DataPendonorControllerAPI::class, 'home']);
Route::get('/berita', [BeritaControllerAPI::class, 'show']);

//untuk menu lokasi donor
Route::get('/jadwal-donor-darah', [JadwalDonorControllerAPI::class, 'show']);
//menu riwayat donor
Route::get('/riwayat-donor-darah', [RiwayatDonorControllerAPI::class, 'show']);

Route::get('/jadwal-donor-pendonor/{id}/{idl}', [JadwalPendonorControllerAPI::class, 'check']);
Route::post('/jadwal-donor-pendonor', [JadwalPendonorControllerAPI::class, 'daftar']);
Route::get('/jadwal-donor-pendonor/{id}', [JadwalPendonorControllerAPI::class, 'find']);

Route::get('/profile', [DataPendonorControllerAPI::class, 'showProfile']);
Route::post('/profile-edit-gambar', [DataPendonorControllerAPI::class, 'updateGambar']);
Route::post('/profile-edit-data', [DataPendonorControllerAPI::class, 'updateData']);
Route::post('/profile-edit-password', [DataPendonorControllerAPI::class, 'editPassword']);

Route::post('/otp/send', [LupaPasswordControllerAPI::class, 'sendOtp']);
Route::post('/otp/check', [LupaPasswordControllerAPI::class, 'checkOtp']);
Route::post('/otp/reset-password', [LupaPasswordControllerAPI::class, 'resetPassword']);

//forum
Route::get('/post', [PostControllerAPI::class, 'show']);
Route::post('/post/add', [PostControllerAPI::class, 'addPost']);
Route::get('/post/{id}', [PostControllerAPI::class, 'findPost']);
Route::get('/comment/{id}', [CommentControllerAPI::class, 'show']);
Route::post('/comment/add', [CommentControllerAPI::class, 'addComment']);