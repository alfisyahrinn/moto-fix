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
            'email' => 'motofix@gmail.com',
            'role' => 'admin',
            'address' => 'Jl. Panglima Sudirman No. 7',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('motofixadmin'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $admin = \App\Models\User::create([
            'name' => 'Alam',
            'email' => 'rizkyalamsyah.dev@gmail.com',
            'role' => 'admin',
            'address' => 'Jl. Panglima Sudirman No. 7',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('alamsyah'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);

        $user = \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'address' => 'Jl. Panglima Sudirman No. 7',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('user123'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);

        $user = \App\Models\User::create([
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'role' => 'user',
            'address' => 'Jl. Panglima Sudirman No. 7',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('user123'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
    }
}
