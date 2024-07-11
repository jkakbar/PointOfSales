<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'id_level' => '1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123')
        ]);
        User::factory()->create([
            'name' => 'Kasir',
            'id_level' => '2',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('123')
        ]);
        User::factory()->create([
            'name' => 'Pimpinan',
            'id_level' => '3',
            'email' => 'pimpinan@gmail.com',
            'password' => bcrypt('123')
        ]);
    }
}
