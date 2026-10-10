<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id_user' => 'USR001', 'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi@example.com', 'username' => 'budi',
            'password' => 'rahasia123', 'no_hp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 1, Bandung',
        ]);

        User::create([
            'id_user' => 'USR002', 'nama_lengkap' => 'Siti Aminah',
            'email' => 'siti@example.com', 'username' => 'siti',
            'password' => 'rahasia456', 'no_hp' => '081298765432',
            'alamat' => 'Jl. Asia Afrika No. 10, Bandung',
        ]);

        $data = [
            ['BRG001', 'Buku Tulis',  'Buku tulis 38 lembar',     5000,  50, 'brg001.jpg'],
            ['BRG002', 'Pulpen',      'Pulpen gel tinta hitam',   3000, 100, 'brg002.jpg'],
            ['BRG003', 'Penggaris',   'Penggaris plastik 30 cm',  4000,  40, 'brg003.webp'],
            ['BRG004', 'Pensil 2B',   'Pensil 2B untuk ujian',    2500,  80, 'brg004.png'],
            ['BRG005', 'Penghapus',   'Penghapus karet putih',    1500,  60, 'brg005.webp'],
            ['BRG006', 'Spidol',      'Spidol whiteboard',        8000,  30, 'brg006.jpg'],
            ['BRG007', 'Stapler',     'Stapler kecil + isi',     15000,  20, 'brg007.webp'],
            ['BRG008', 'Map Plastik', 'Map plastik resleting',    2000,   0, 'brg008.jpg'],
            ['BRG009', 'Lem Kertas',  'Lem stik kertas',          4500,  45, 'brg009.jpg'],
            ['BRG010', 'Gunting',     'Gunting kertas',           7000,  25, 'brg010.webp'],
        ];

        foreach ($data as [$id, $nama, $desk, $harga, $stok, $gambar]) {
            Barang::create([
                'id_barang' => $id, 'nama_barang' => $nama, 'deskripsi' => $desk,
                'harga' => $harga, 'stok' => $stok, 'gambar' => $gambar,
            ]);
        }
    }
}