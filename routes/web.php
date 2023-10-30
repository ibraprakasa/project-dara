<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// LOGIN LOGOUT
Route::get('/', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('loginaksi', 'App\Http\Controllers\LoginController@loginaksi')->name('loginaksi');
Route::post('logoutaksi', 'App\Http\Controllers\LoginController@logoutaksi')->name('logoutaksi')->middleware('auth');
// END 

// LUPA PASSWORD
Route::get('lupapassword1', 'App\Http\Controllers\LupaPasswordController@getEmail')->name('lupapassword1');
Route::post('lupapassword1', 'App\Http\Controllers\LupaPasswordController@postEmail')->name('lupapassword1.post');

Route::get('lupapassword2', 'App\Http\Controllers\LupaPasswordController@getOTP')->name('lupapassword2');
Route::post('lupapassword2', 'App\Http\Controllers\LupaPasswordController@postOTP')->name('lupapassword2.post');

Route::get('lupapassword3', 'App\Http\Controllers\LupaPasswordController@getPasswordResetForm')->name('lupapassword3');
Route::post('lupapassword3', 'App\Http\Controllers\LupaPasswordController@postPasswordReset')->name('lupapassword3.post');

// END


Route::group(['middleware' => ['auth', 'checkrole:1,2']], function () {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard')->middleware('auth');

    // STOK DARAH
    Route::get('stokdarah', 'App\Http\Controllers\StokDarahController@index')->name('stokdarah');
    Route::post('insertstok', 'App\Http\Controllers\StokDarahController@insertstok')->name('insertstok');
    Route::post('updatestok', 'App\Http\Controllers\StokDarahController@updatestok')->name('updatestok');
    // END STOK DARAH

    // AKUN
    Route::get('akun', 'App\Http\Controllers\AkunController@index')->name('akun');
    Route::post('updateakun', 'App\Http\Controllers\AkunController@updateakun')->name('updateakun');
    Route::post('updatepassword', 'App\Http\Controllers\AkunController@updatepassword')->name('updatepassword');
    // END AKUN

    // BERITA
    Route::get('berita', 'App\Http\Controllers\BeritaController@index')->name('berita');
    Route::post('insertberita', 'App\Http\Controllers\BeritaController@insertberita')->name('insertberita');
    Route::post('updateberita/{id}', 'App\Http\Controllers\BeritaController@updateberita')->name('updateberita');
    Route::delete('deleteberita/{id}', 'App\Http\Controllers\BeritaController@deleteberita')->name('deleteberita');
    // END BERITA

    // RIWAYAT DONOR 
    Route::get('riwayatdonor', 'App\Http\Controllers\RiwayatDonorController@index')->name('riwayatdonor');
    // END RIWAYAT DONOR

    //JADWAL DONOR 
    Route::get('jadwaldonor', 'App\Http\Controllers\JadwalDonorController@index')->name('jadwaldonor');
    Route::post('insertjadwaldonor', 'App\Http\Controllers\JadwalDonorController@insertjadwaldonor')->name('insertjadwaldonor');
    Route::post('updatejadwaldonor/{id}', 'App\Http\Controllers\JadwalDonorController@updatejadwaldonor')->name('updatejadwaldonor');
    Route::delete('deletejadwaldonor/{id}', 'App\Http\Controllers\JadwalDonorController@deletejadwaldonor')->name('deletejadwaldonor');
    //END JADWAL DONOR

    //FORUM DONOR 
    Route::get('forum-postingan', 'App\Http\Controllers\ForumController@getPostingan')->name('forum-postingan');
    Route::delete('deletepostingan/{id}', 'App\Http\Controllers\ForumController@deletepostingan')->name('deletepostingan');

    Route::get('forum-komentar/{id_post}', 'App\Http\Controllers\ForumController@getKomentar')->name('forum-komentar');
    Route::delete('deletekomentar/{id}', 'App\Http\Controllers\ForumController@deletekomentar')->name('deletekomentar');

    Route::get('forum-balasan/{id_comment}', 'App\Http\Controllers\ForumController@getBalasan')->name('forum-balasan');
    Route::delete('deletebalasan/{id}', 'App\Http\Controllers\ForumController@deletebalasan')->name('deletebalasan');
    //END FORUM DONOR

    // LAPORAN DONOR
 
    Route::get('laporan','App\Http\Controllers\LaporanController@getLaporan')->name('laporan');

    // END LAPORAN
    
    //INFO PENDAFTAR
    Route::get('/infopendaftar', 'App\Http\Controllers\JadwalDonorController@infopendaftar')->name('infopendaftar');
    Route::delete('deletejadwalpendonor/{id}', 'App\Http\Controllers\JadwalDonorController@deletejadwalpendonor')->name('deletejadwalpendonor');
    //END INFO PENDAFTAR
});


// untuk superadmin
Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    Route::get('kelolaakun', 'App\Http\Controllers\KelolaAkunController@index')->name('kelolaakun');

    // PENDONOR
    Route::post('insertpendonorsuper', 'App\Http\Controllers\KelolaAkunController@insertpendonorsuper')->name('insertpendonorsuper');
    Route::post('updatependonorsuper/{id}', 'App\Http\Controllers\KelolaAkunController@updatependonorsuper')->name('updatependonorsuper');
    Route::delete('deletependonorsuper/{id}', 'App\Http\Controllers\KelolaAkunController@deletependonorsuper')->name('deletependonorsuper');
    // END PENDONOR

    // USER
    Route::post('insertuser', 'App\Http\Controllers\KelolaAkunController@insertuser')->name('insertuser');
    Route::post('updateuser/{id}', 'App\Http\Controllers\KelolaAkunController@updateuser')->name('updateuser');
    Route::delete('deleteuser/{id}', 'App\Http\Controllers\KelolaAkunController@deleteuser')->name('deleteuser');
    Route::post('updatepassworduser/{id}', 'App\Http\Controllers\KelolaAkunController@updatepassworduser')->name('updatepassworduser');
    // END USER
});

//untuk admin
Route::group(['middleware' => ['auth', 'checkrole:2']], function () {
    //DATA PENDONOR
    Route::get('datapendonor', 'App\Http\Controllers\DataPendonorController@index')->name('datapendonor');
    Route::post('insertpendonor', 'App\Http\Controllers\DataPendonorController@insertpendonor')->name('insertpendonor');
    Route::post('updatependonor/{id}', 'App\Http\Controllers\DataPendonorController@updatependonor')->name('updatependonor');
    Route::delete('deletependonor/{id}', 'App\Http\Controllers\DataPendonorController@deletependonor')->name('deletependonor');
    //END
});
