<?php

namespace Database\Seeders;

// database/seeders/FasilitasSeeder.php
use Illuminate\Database\Seeder;
use App\Models\Fasilitas; // Import model

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        Fasilitas::create(['nama_fasilitas' => 'Jalan Rusak']);
        Fasilitas::create(['nama_fasilitas' => 'Lampu Jalan Mati']);
        Fasilitas::create(['nama_fasilitas' => 'Saluran Air Tersumbat']);
        Fasilitas::create(['nama_fasilitas' => 'Tempat Sampah Umum']);
    }
}
