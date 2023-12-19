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