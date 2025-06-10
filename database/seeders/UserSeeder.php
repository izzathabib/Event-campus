<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get role IDs
        $roles = DB::table('roles')->pluck('id', 'desc');

        // Insert one user for each role
        DB::table('users')->insertOrIgnore([
            [
                'name' => 'COMPUTER SCIENCE SOCIETY',
                'username' => 'csusm',
                'email' => 'csusm@email.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['society'] ?? 1,
                'email_verified_at' => now(),
                'admin_verified' => 1,
            ],
            [
                'name' => 'Mo Bin Salah',
                'username' => 'mosalah',
                'email' => 'mosalah@email.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['student'] ?? 2,
                'email_verified_at' => now(),
                'admin_verified' => 1,
            ],
            [
                'name' => 'Nazmi Bin Bashar',
                'username' => 'nazmibashar',
                'email' => 'nazmibashar@email.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['admin'] ?? 3,
                'email_verified_at' => now(),
                'admin_verified' => 1,
            ],
            [
                'name' => 'Muslim Bin Hadi',
                'username' => 'muslimhadi',
                'email' => 'muslimhadi@email.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['advisor'] ?? 4,
                'email_verified_at' => now(),
                'admin_verified' => 1,
            ],
            [
                'name' => 'Sayuti Bin Ahmad',
                'username' => 'sayutiahmad',
                'email' => 'sayutiahmad@email.com',
                'password' => Hash::make('password'),
                'role_id' => $roles['tnc'] ?? 5,
                'email_verified_at' => now(),
                'admin_verified' => 1,
            ],
        ]);
    }
}
