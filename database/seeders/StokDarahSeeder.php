<?php

namespace Database\Seeders;

use App\Models\StokDarah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $existingRecord = DB::table('golongandarah')->where('nama', 'AB')->first();

        $golonganDarah = $existingRecord->id;

        StokDarah::create(array(
            'gol_darah' => $golonganDarah, // Mengacu pada kolom 'id_goldar' di tabel 'golongandarah'
            'jumlah' => 2,
        ));
    }
}






//     $existingRecord = DB::table('golongandarah')->where('nama', 'A')->first();

// if ($existingRecord) {
//     // Jika entri sudah ada, gunakan ID yang sudah ada
//     $golonganDarah = $existingRecord->id_goldar;
// } else {
//     // Jika entri belum ada, tambahkan entri baru dan dapatkan ID-nya
//     $golonganDarah = DB::table('golongandarah')->insertGetId([
//         'nama' => 'A',
//     ]);
// }
