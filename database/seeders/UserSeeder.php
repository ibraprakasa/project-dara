<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = DB::table('roles')->where('role_name', 'admin')->value('id');
        $superadminRoleId = DB::table('roles')->where('role_name', 'superadmin')->value('id');

        User::create([
            'name'=>'Admin',
            'email'=>'admin1@gmail.com',
            'email_verified_at' => now(),
            'password'=>Hash::make('admin123'),
            'role_id' => $adminRoleId,
            'remember_token' => Str::random(10),
            'alamat' => 'Codelabs',
            'nohp' => '08223622179',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name'=>'Superadmin',
            'email'=>'superadmin1@gmail.com',
            'password'=>Hash::make('superadmin123'),
            'role_id' => $superadminRoleId,
            'remember_token' => Str::random(10),
            'alamat' => 'Codelabs2',
            'nohp' => '082436221342',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
