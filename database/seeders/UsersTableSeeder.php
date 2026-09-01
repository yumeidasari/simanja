<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@material.com'],
            [
                'name' => 'Admin Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'role' => 'ADMIN',
                'id_bidang' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'user@material.com'],
            [
                'name' => 'Contoh User',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'role' => 'USER',
                'id_bidang' => 1, // sesuaikan id di tabel unit_kerja kamu
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}