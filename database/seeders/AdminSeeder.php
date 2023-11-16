<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'address' => 'Jl. Panglima Sudirman No. 7',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('admin'), 
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);

    }
}