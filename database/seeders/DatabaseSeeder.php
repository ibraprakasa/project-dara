<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\JadwalDonor;
use App\Models\JadwalPendonor;
use App\Models\Pendonor;
use App\Models\RiwayatDonor;
use App\Models\Role;
use App\Models\StokDarah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // JADWAL PENDONOR TO JADWAL DONOR
        DB::table('jadwalpendonor')->delete();
        DB::table('jadwaldonor')->delete(); 

        $jadwalDonor = DB::table('jadwaldonor')->insertGetId(array(
            'lokasi' => 'Tabing',
            'alamat' => 'M Thalin',
            'tanggal_donor' => '2023-07-15',
            'jam_mulai' => '09:00',
            'jam_selesai' => '15:00',
            'kontak' => '082235221661',
            'jumlah_pendonor' => 20,
            'latitude' => 121.4567890,
            'longitude' => 15.6789012,
        ));

        JadwalPendonor::create(array(
            'id_jadwal_donor_darah' => $jadwalDonor,
            'id_pendonor' => 2
        ));
        // END

        // PENDONOR AND STOK DARAH TO GOLONGAN DARAH
        DB::table('pendonor')->delete();
        DB::table('golongandarah')->delete();
        DB::table('stokdarah')->delete();

        $golonganDarah = DB::table('golongandarah')->insertGetId(array(
            'nama' => 'O',
        ));

        Pendonor::create(array(
            'nama' => 'Ibra Prakasa',
            'tanggal_lahir' => '2003-02-15',
            'kode_pendonor' => 'dara'.rand(10000, 99999),
            'jenis_kelamin' => 'Laki-Laki',
            'id_golongan_darah'=> $golonganDarah,
            'berat_badan' => 47,
            'kontak_pendonor' => '08877541516',
            'email' => 'ibraprakasa51@gmail.com',
            'alamat_pendonor' => 'Jambi',
            'password' => Hash::make('ibra123'),
            'stok_darah_tersedia' =>0,
            'created_at' =>now(),
        ));
        
        StokDarah::create(array(
            'gol_darah' => $golonganDarah, // Mengacu pada kolom 'id_goldar' di tabel 'golongandarah'
            'jumlah' => 5,
        ));

        //RIWAYAT DONOR TO PENDONOR
        $pendonor = DB::table('pendonor')->insertGetId(array(
            'nama' => 'Oktaviani Pratiwi',
            'tanggal_lahir' => '2001-06-10',
            'kode_pendonor' => 'dara'.rand(10000, 99999),
            'jenis_kelamin' => 'Perempuan',
            'id_golongan_darah'=> $golonganDarah,
            'berat_badan' => 60,
            'kontak_pendonor' => '08877541516',
            'email' => 'okta05532@gmail.com',
            'alamat_pendonor' => 'Jambi',
            'password' => Hash::make('viani12345'),
            'stok_darah_tersedia' =>3,
            'created_at' =>now(),
        ));

        RiwayatDonor::create(array(
            'pendonor_id' => $pendonor, // Mengacu pada kolom 'id_goldar' di tabel 'golongandarah'
            'jumlah_donor' => 10,
            'tanggal_donor' => '2023-08-19'
        ));
    }
}
