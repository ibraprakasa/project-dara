<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Siapkan Seeder Berita Disini
        DB::table('berita')->delete();

        // $berita = 
        DB::table('berita')->insertGetId(array(
            'gambar' => '...',
            'judul' => 'Blablabla',
            'deskripsi' => 'Halo gengs disini saya akan membuat sebuah deskripsi tabel berita',
            'created_at' => now(),
        ));
    }
}
