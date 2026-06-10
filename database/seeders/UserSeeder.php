<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'organizer@test.com'],
            [
                'name' => 'Test Organizer',
                'password' => Hash::make('password'),
                'role' => 'organizer',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}
