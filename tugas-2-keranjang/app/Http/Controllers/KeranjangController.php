<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class KeranjangController extends Controller
{
    // Isi session: ['id_barang' => jumlah]. Hanya id dan jumlah.
    public function index()
    {
        $keranjang = session('keranjang', []);
        $barang = Barang::whereIn('id', array_keys($keranjang))->get()->keyBy('id');

        $items = [];
        $total = 0;

        foreach ($keranjang as $id => $jumlah) {
            if (!isset($barang[$id])) {
                continue;
            }
            $b = $barang[$id];
            $subtotal = $b->harga * $jumlah;
            $total += $subtotal;

            $items[] = [
                'id'       => $id,
                'nama'     => $b->nama,
                'harga'    => $b->harga,
                'jumlah'   => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        $jumlahItem = array_sum($keranjang);

        return view('keranjang', compact('items', 'total', 'jumlahItem'));
    }

    public function tambah($id)
    {
        Barang::findOrFail($id);

        $keranjang = session('keranjang', []);
        $keranjang[$id] = ($keranjang[$id] ?? 0) + 1;
        session(['keranjang' => $keranjang]);

        return back();
    }

    public function kurang($id)
    {
        $keranjang = session('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]--;
            if ($keranjang[$id] <= 0) {
                unset($keranjang[$id]);
            }
        }

        session(['keranjang' => $keranjang]);

        return back();
    }

    public function hapus($id)
    {
        $keranjang = session('keranjang', []);
        unset($keranjang[$id]);
        session(['keranjang' => $keranjang]);

        return back();
    }

    public function kosongkan()
    {
        session()->forget('keranjang');

        return back();
    }
}