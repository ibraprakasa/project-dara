<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('comments')->insertGetId(array(
            'id_pendonor' => '1',
            'id_post' => '1',
            'text' => 'Waduh kok status lu gabener dah?',
            'created_at' =>now(),
            'updated_at' =>now(),
        ));

        // DB::table('comments')->insertGetId(array(
        //     'id_pendonor' => '5',
        //     'id_post' => '5',
        //     'text' => 'Broo lu keren banget!',
        //     'created_at' =>now(),
        //     'updated_at' =>now(),
        // ));
    }
}
