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
            'id_pendonor' => '10',
            'id_post' =>  null,
            'id_comment' =>  28,
            'id_reply' =>  null,
            'text' => 'tes',
            'type' => 'Komentar',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));
    }
}
