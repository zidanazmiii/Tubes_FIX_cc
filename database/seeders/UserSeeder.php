<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Import Hash facade untuk hashing password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat User Admin
        User::create([
            'name' => 'Admin Toko Kue',
            'email' => 'admin@tokokue.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
            'role' => 'admin',
            'email_verified_at' => now(), // Langsung set email terverifikasi untuk admin
        ]);

        // Membuat User Pelanggan Contoh 1
        User::create([
            'name' => 'Pelanggan Satu',
            'email' => 'pelanggan1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        // Membuat User Pelanggan Contoh 2
        User::create([
            'name' => 'Pelanggan Dua',
            'email' => 'pelanggan2@example.com',
            'password' => Hash::make('password456'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        // Anda bisa menambahkan lebih banyak pengguna contoh jika diperlukan
        // User::factory(5)->create(); // Jika Anda memiliki UserFactory yang sudah diatur untuk role customer
    }
}
