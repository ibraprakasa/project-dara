<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
use App\Models\JadwalDonor;
use App\Models\JadwalPendonor;
use App\Models\Pendonor;
use App\Models\RiwayatDonor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

use function PHPUnit\Framework\isEmpty;

class DataPendonorControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','home']]);
    }

    public function login(Request $request){
       //set validation
       $validator = Validator::make($request->all(), [
        'kode_pendonor' => 'required',
        'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        //get credentials from request
        $credentials = $request->only('kode_pendonor', 'password');

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Kode pendonor atau Password Anda salah'
            ], 401);
        }

        //if auth success
        $user = auth()->guard('api')->user();
        return response()->json([
            'success' => true,
            'message' => 'berhasil login',
            'token'   => $token,
            'token_type' => 'bearer',
            'exp_token' => JWTAuth::factory()->getTTL()*1
        ], 200);
    }

    public function home(){
        $currentDate = Carbon::today()->format('Y-m-d');
        $user = auth()->guard('api')->user();
        $goldar = GolonganDarah::where('id',$user->id_golongan_darah)->first();
        if(!$goldar){
            $goldar = null;
        }
        $jadwal = JadwalPendonor::where('id_pendonor',$user->id)->get();
        $jadwal_me = null;
        $jadwal_pendonor = [];
        // Jadwal yang akan disimpan
        $jadwalTerdekat = [];

        if(!$jadwal){
            $jadwal_me = null;
        }else{
            foreach($jadwal as $i){
                $jadwal_pendonor[] = JadwalDonor::find($i->id_jadwal_donor_darah);
            }
            if (!empty($jadwal_pendonor)) {
                foreach ($jadwal_pendonor as $x) {
                    // Mengambil tanggal dari jadwal
                    $tanggalJadwal = Carbon::parse($x->tanggal_donor);
            
                    // Memeriksa apakah tanggal jadwal lebih besar atau sama dengan tanggal saat ini
                    if ($tanggalJadwal->greaterThanOrEqualTo($currentDate)) {
                        // Menambahkan jadwal yang dekat ke dalam array $jadwalTerdekat
                        $jadwalTerdekat[] = $x;
                    }
                }
                // Mengurutkan $jadwalTerdekat berdasarkan tanggal terkecil
                $jadwalTerdekat = collect($jadwalTerdekat)->sortBy(function ($jadwal) {
                    return $jadwal->tanggal_donor;
                })->values();

                // Mengambil jadwal terdekat yang pertama dari array yang telah diurutkan
                $jadwalPalingDekat = $jadwalTerdekat->first();

                if($jadwalPalingDekat){
                    $jadwal_me = $jadwalPalingDekat;
                }else{
                    $jadwal_me = null;
                }
                
                // $jadwalPalingDekat akan berisi jadwal yang paling mendekati tanggal saat ini
            }
        }

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'gambar' => $user->gambar,
                'nama' => $user->nama,
                'kode_pendonor'=> $user->kode_pendonor,
                'id_golongan_darah' => [
                    'id' => $goldar->id,
                    'nama' => $goldar->nama
                ],
                'berat_badan'=> $user->berat_badan,
                'jadwal_terdekat' => $jadwal_me
                ]
        ]);
    }

    public function showProfile(){
        $user = auth()->guard('api')->user();
        $goldar = GolonganDarah::find($user->id_golongan_darah)->first();
        if(!$goldar){
            $goldar = null;
        }
        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'gambar' => $user->gambar,
                'nama' => $user->nama,
                'email' => $user->email,
                'kode_pendonor'=> $user->kode_pendonor,
                'id_golongan_darah' => [
                    'id' => $goldar->id,
                    'nama' => $goldar->nama
                ],
                'berat_badan'=> $user->berat_badan,
                'alamat_pendonor' => $user->alamat_pendonor,
                'tanggal_lahir' => $user->tanggal_lahir,
                'kontak_pendonor' => $user->kontak_pendonor,
                'jenis_kelamin' => $user->jenis_kelamin
                ]
        ]);
    }

    public function showProfileOtherDonor($id){
        $user = Pendonor::where('id',$id)->first();
        $goldar = GolonganDarah::where('id',$user->id_golongan_darah)->first();
        if(!$goldar){
            $goldar = null;
        }
        $riwayatDonor = RiwayatDonor::where('pendonor_id',$user->id)->get();
        $total_donor = 0;
        foreach ($riwayatDonor as $riwayat) {
            $total_donor += $riwayat->jumlah_donor;
        }
        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'gambar' => $user->gambar,
                'nama' => $user->nama,
                'email' => $user->email,
                'kode_pendonor'=> $user->kode_pendonor,
                'id_golongan_darah' => [
                    'id' => $goldar->id,
                    'nama' => $goldar->nama
                ],
                'berat_badan'=> $user->berat_badan,
                'alamat_pendonor' => $user->alamat_pendonor,
                'tanggal_lahir' => $user->tanggal_lahir,
                'kontak_pendonor' => $user->kontak_pendonor,
                'jenis_kelamin' => $user->jenis_kelamin,
                'total_donor_darah' => $total_donor
                ]
        ]);
    }

    public function updateGambar(Request $request) {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'gambar' => 'image', // Sesuaikan dengan jenis gambar yang diterima
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // Mendapatkan ID pengguna dari token
        $userId = auth()->guard('api')->user()->id;
    
        // Temukan pengguna berdasarkan ID
        $user = Pendonor::find($userId);
    
        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }
    
        // Simpan nama gambar lama untuk pengecekan
        $oldImageName = $user->gambar;
    
        // Mengunggah gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $file_name);
            $user->gambar = $file_name;
        }
    
        $user->save();
    
        // Hapus gambar lama jika gambar baru diunggah
        if ($request->hasFile('gambar') && $oldImageName) {
            $oldImagePath = public_path('images/' . $oldImageName);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data' => $user,
        ]);
    }    

    public function updateData(Request $request)
{
        $userId = auth()->guard('api')->user()->id;

        // Temukan pengguna berdasarkan ID
        $user = Pendonor::find($userId);

        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        // Buat array kosong untuk data yang akan diupdate
        $dataToUpdate = [];

        // Periksa apakah ada data untuk masing-masing kolom dalam permintaan
        if ($request->has('nama')) {
            $dataToUpdate['nama'] = $request->nama;
        }

        if ($request->has('email')) {
            $dataToUpdate['email'] = $request->email;
        }

        if ($request->has('alamat_pendonor')) {
            $dataToUpdate['alamat_pendonor'] = $request->alamat_pendonor;
        }

        if ($request->has('tanggal_lahir')) {
            $dataToUpdate['tanggal_lahir'] = $request->tanggal_lahir;
        }

        if ($request->has('jenis_kelamin')) {
            $dataToUpdate['jenis_kelamin'] = $request->jenis_kelamin;
        }

        if ($request->has('kontak_pendonor')) {
            $dataToUpdate['kontak_pendonor'] = $request->kontak_pendonor;
        }

        if ($request->has('berat_badan')) {
            $dataToUpdate['berat_badan'] = $request->berat_badan;
        }

        // Perbarui data pengguna dengan data yang telah difilter
        $user->update($dataToUpdate);

        return response()->json([
            'success' => true,
            'message' => "Berhasil update data"
        ]);
}




    public function editPassword(Request $request){
        $userId = auth()->guard('api')->user();
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => 'required|min:5',
        ]);
    
        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Ambil password dari database
        $user = Pendonor::find($userId->id);
        $databasePassword = $user->password;

        // Memeriksa apakah password lama yang dimasukkan oleh pengguna cocok dengan password di database
        if (!Hash::check($request->password_lama, $databasePassword)) {
            return response()->json([
                'success' => false,
                'message' => 'Password lama Anda salah'
            ]);
        }

        // Jika password lama cocok, maka Anda dapat mengganti password
        $user->password = Hash::make($request->password_baru);
        $user->update();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil ganti password'
        ]);
    }

    public function searchPendonor(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
        ]);
    
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 403);
        }
    
        $query = Pendonor::query();
    
        if ($request->has('nama')) {
            $query->where('nama', 'LIKE', '%' . $request->input('nama') . '%');
        }
    
        $result = $query->get();
        if($result->isEmpty()){
            return response()->json($result,403);
        }
    
        return response()->json($result);
    }

    public function logout(){        
        //remove token
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if($removeToken) {
            //return response JSON
            return response()->json([
                'success' => true,
                'message' => 'Logout Berhasil!',  
            ]);
        }
    }
}
