<?php

namespace Database\Seeders;

use App\Models\Pendonor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pendonor')->insertGetId(array(
            'nama' => 'Afif Permana',
            'tanggal_lahir' => '2002-09-10',
            'kode_pendonor' => 'dara'.rand(10000, 99999),
            'jenis_kelamin' => 'Laki-Laki',
            'id_golongan_darah'=> 1,
            'berat_badan' => 47,
            'kontak_pendonor' => '08877541516',
            'email' => 'ibraprakasa5@gmail.com',
            'alamat_pendonor' => 'Padang Panjang',
            'password' => bcrypt('123456789'),
            'stok_darah_tersedia' =>0,
            'created_at' =>now(),
        ));
    }
}
