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
            'id_pendonor' => '13',
            'id_post' =>  '5',
            'id_comment' =>  null,
            'id_reply' =>  null,
            'text' => 'Laporan ini mengandung SARA, mohon ditindaklanjuti, terimakasih.',
            'type' => 'Postingan',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));
    }
}
