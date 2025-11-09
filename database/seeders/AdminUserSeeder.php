<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use GuzzleHttp\Promise\Create;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dulu apakah admin sudah ada
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'id' => Str::uuid(),
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'telepon' => '081368087522',
                'alamat' => 'jl hj komarudin',
                'password' => Hash::make('password123'), // ganti sesuai keinginan
                'role' => 'admin', // pastikan field ini ada di tabel users
            ]);
        }

        User::create([
            'id' => Str::uuid(),
            'name' => 'Nafis Rizqullah',
            'email' => 'nafisrizqullah99@gmail.com',
            'telepon' => '085709328586',
            'alamat' => 'jalan jalan',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
