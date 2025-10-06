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
        // Contoh membuat user dengan role 'warga'
        User::create([
            'nama' => 'Warga Tirtomoyo',
            'nik' => '1234567890123456', 
            'password' => Hash::make('password'),
            'no_telp' => '081234567890',
            'alamat' => 'Jl. Mawar No. 1, Desa Tirtomoyo',
            'role' => 'warga',
        ]);

        // Contoh membuat user dengan role 'admin'
        User::create([
            'nama' => 'Admin Desa',
            'nik' => '9876543210987654',
            'password' => Hash::make('adminpassword'),
            'no_telp' => '089876543210',
            'alamat' => 'Kantor Desa Tirtomoyo',
            'role' => 'admin',
        ]);
    }
}
