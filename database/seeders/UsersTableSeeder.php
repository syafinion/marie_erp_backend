<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'user1@example.com',
                'password' => Hash::make('password123'), // Encrypt password
                'token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'user2@example.com',
                'password' => Hash::make('password123'),
                'token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
