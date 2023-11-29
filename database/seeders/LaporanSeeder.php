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
            'id_pendonor' => '1',
            'id_post' =>  null,
            'id_comment' =>  1,
            'id_reply' =>  null,
            'text' => 'Ini laporan komentar',
            'type' => 'Komentar',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));

        DB::table('reports')->insertGetId(array(
            'id_pendonor' => '1',
            'id_post' =>  null,
            'id_comment' =>  null,
            'id_reply' =>  1,
            'text' => 'Ini laporan balas komentar',
            'type' => 'Balasan',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));

        DB::table('reports')->insertGetId(array(
            'id_pendonor' => '1',
            'id_post' =>  1,
            'id_comment' =>  null,
            'id_reply' =>  null,
            'text' => 'Ini laporan postingan',
            'type' => 'Postingan',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));
    }
}
