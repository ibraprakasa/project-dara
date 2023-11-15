<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('testimonial')->insertGetId(array(
            'id_pendonor' => 10,
            'text' => 'DARA LUAR BIASA!',
            'star' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ));
    }
}
