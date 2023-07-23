<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'gender' => 'male',
            'phone_number' => '09-769333584',
            'role' => 'admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('HahPT2112#'),
        ]);
    }
}
