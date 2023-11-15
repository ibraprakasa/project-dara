<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquiriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inquiries')->insertGetId(array(
            'name' => 'Abdul Rdadaaffi Naufal',
            'email' => 'abdulraffi8@gmail.com',
            'phone' => '086832940234',
            'message' => 'Saya ingin mengajukan kerjasama dengan DARA, apakah bisa ?',
            'created_at' => now(),
            'updated_at' => now()
        ));
    }
}
