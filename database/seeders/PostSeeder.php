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
            'id_pendonor' => '1',
            'text' => 'Ini adalah status dari pendonor',
            'gambar' => 'https://www.suarasurabaya.net/wp-content/uploads/2019/05/potretd33616_clip2.jpg',
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
