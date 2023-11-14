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
            'id_pendonor' => 13,
            'text' => 'DARA merupakan aplikasi yang sangat menolong saya yg awam terkait seputar donor darah. Terima kasih DARA!',
            'star' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ));
    }
}
