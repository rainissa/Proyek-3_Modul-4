<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'      => 'budi',
            'password'      => 'rahasia123',
            'nama_lengkap'  => 'Budi Santoso',
        ]);

        User::create([
            'username'      => 'rai',
            'password'      => 'rahasia456',
            'nama_lengkap'  => 'Rainissa Azizah',
        ]);
    }
}
