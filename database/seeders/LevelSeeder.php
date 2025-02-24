<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create([
            'nama_level' => 'Admin'
        ]);

        Level::create([
            'nama_level' => 'Kasir'
        ]);

        Level::create([
            'nama_level' => 'Pimpinan'
        ]);
    }
}
