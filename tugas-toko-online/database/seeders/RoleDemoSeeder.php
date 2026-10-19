<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleDemoSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['id_user' => 'USR901', 'username' => 'admin1',    'nama_lengkap' => 'Admin Toko',    'role' => 'admin'],
            ['id_user' => 'USR902', 'username' => 'customer1', 'nama_lengkap' => 'Budi Customer', 'role' => 'customer'],
            ['id_user' => 'USR903', 'username' => 'staff1', 'nama_lengkap' => 'Sari Staff',    'role' => 'staff'],
        ];

        foreach ($akun as $data) {
            $user = User::firstOrNew(['username' => $data['username']]);
            $user->id_user = $data['id_user'];
            $user->nama_lengkap = $data['nama_lengkap'];
            $user->email = $data['username'] . '@example.com';
            $user->no_hp = '08123456789';
            $user->alamat = 'Bandung';
            $user->password = Hash::make('password123');
            $user->role = $data['role'];
            $user->save();
        }
    }
}