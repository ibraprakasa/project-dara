<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('balas_comments')->insertGetId(array(
            'id_pendonor' => '10',
            'id_comment' => '53',
            'text' => 'Ini adalah balas komen dari pendonor A',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));

        DB::table('balas_comments')->insertGetId(array(
            'id_pendonor' => '5',
            'id_comment' => '53',
            'text' => 'Ini adalah balas komen dari pendonor B',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));
    }
}
