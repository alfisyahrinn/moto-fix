<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        $admin = \App\Models\User::create([
            'name' => 'alfi syahrin',
            'email' => 'sahrin201@gmail.com',
            'role' => 'admin',
            'address' => 'Jl. Panglima Sudirman No. 7',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $admin = \App\Models\User::create([
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'role' => 'user',
            'address' => 'Jl. Panglima Sudirman No. 7',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $admin = \App\Models\User::create([
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'role' => 'user',
            'address' => 'Jl. Panglima Sudirman No. 7',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
    }
}
