<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('id_barang')->get();
        $jumlahItem = array_sum(session('keranjang', []));

        return view('barang.index', compact('barang', 'jumlahItem'));
    }
}