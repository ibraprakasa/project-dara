<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reports')->insertGetId(array(
            'id_pendonor' => '5',
            'id_post' =>  '4',
            'id_comment' =>  null,
            'id_reply' =>  null,
            'text' => 'Ini adalah contoh laporan',
            'type' => 'Postingan',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));

        DB::table('reports')->insertGetId(array(
            'id_pendonor' => '12',
            'id_post' =>  null,
            'id_comment' =>  '6',
            'id_reply' =>  null,
            'text' => 'Ini adalah contoh laporan komentar',
            'type' => 'Komentar',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));

        DB::table('reports')->insertGetId(array(
            'id_pendonor' => '13',
            'id_post' =>  null,
            'id_comment' =>  null,
            'id_reply' =>  '2',
            'text' => 'Ini adalah contoh laporan balasan komentar',
            'type' => 'Balasan',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));
    }
}
