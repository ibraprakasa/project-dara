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
<<<<<<< HEAD
            'id_pendonor' => '1',
            'id_comment' => '1',
=======
            'id_pendonor' => '10',
            'id_comment' => '53',
>>>>>>> 0823241284f7f0ef799627da4234a70180fc15c2
            'text' => 'Ini adalah balas komen dari pendonor A',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));

<<<<<<< HEAD
        // DB::table('balas_comments')->insertGetId(array(
        //     'id_pendonor' => '12',
        //     'id_comment' => '46',
        //     'text' => 'Ini adalah balas komen dari pendonor B',
        //     'created_at' =>now(),
        //     'updated_at' =>now(),
        // ));
=======
        DB::table('balas_comments')->insertGetId(array(
            'id_pendonor' => '5',
            'id_comment' => '53',
            'text' => 'Ini adalah balas komen dari pendonor B',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));
>>>>>>> 0823241284f7f0ef799627da4234a70180fc15c2
    }
}
