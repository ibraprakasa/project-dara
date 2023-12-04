<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('posts')->insertGetId(array(
<<<<<<< HEAD
<<<<<<< HEAD
            'id_pendonor' => '1',
=======
            'id_pendonor' => '10',
>>>>>>> 76a76523381a7402caf2a24bd4a422584af6b80b
=======
            'id_pendonor' => '10',
=======
            'id_pendonor' => '1',
>>>>>>> 9a8511b2388a10af3a1dda67a9231608ea051f75
>>>>>>> 07bd78a0f832732285adfb4e2b00d1819c73ac9c
            'text' => 'Ini adalah status dari pendonor',
            'gambar' => '1697793546.jpeg',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));

        // DB::table('posts')->insertGetId(array(
        //     'id_pendonor' => '10',
        //     'text' => 'Ini adalah status dari halo oee',
        //     'gambar' => 'Kosong 123',
        //     'created_at' =>now(),
        //     'updated_at' =>now(),
        // ));
        
    }
}
