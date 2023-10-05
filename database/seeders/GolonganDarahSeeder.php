<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('golongandarah')->insertGetId(array(
            'nama' => 'A',
        ));
        DB::table('golongandarah')->insertGetId(array(
            'nama' => 'B',
        ));
        DB::table('golongandarah')->insertGetId(array(
            'nama' => 'AB',
        ));
    
    }
}
