<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insertGetId(array(
            'id_pendonor' => '5',
            'text' => 'Ini adalah status dari pendonor',
            'gambar' => 'Kosong dulu',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));
    }
}
