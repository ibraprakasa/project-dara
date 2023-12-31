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
        // DB::table('reports')->insertGetId(array(
        //     'id_pendonor' => '10',
        //     'id_post' =>  null,
        //     'id_comment' =>  32,
        //     'id_reply' =>  null,
        //     'text' => 'tes',
        //     'type' => 'Komentar',
        //     'created_at' =>now(),
        //     'updated_at' =>now(),
        // ));

        // DB::table('reports')->insertGetId(array(
        //     'id_pendonor' => '12',
        //     'id_post' =>  null,
        //     'id_comment' =>  null,
        //     'id_reply' =>  26,
        //     'text' => 'Ini balas komentar',
        //     'type' => 'Balasan',
        //     'created_at' =>now(),
        //     'updated_at' =>now(),
        // ));

        DB::table('reports')->insertGetId(array(
            'id_pendonor' => '10',
            'id_post' =>  5,
            'id_comment' =>  null,
            'id_reply' =>  null,
            'text' => 'Ini postingan',
            'type' => 'Postingan',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));
    }
}
