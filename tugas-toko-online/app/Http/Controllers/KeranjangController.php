<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session('keranjang', []);
        $barang = Barang::whereIn('id_barang', array_keys($keranjang))
            ->get()->keyBy('id_barang');

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
                'nama'     => $b->nama_barang,
                'harga'    => $b->harga,
                'stok'     => $b->stok,
                'jumlah'   => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        return view('keranjang.index', compact('items', 'total'));
    }

    public function tambah($id)
    {
        $b = Barang::findOrFail($id);
        $keranjang = session('keranjang', []);
        $baru = ($keranjang[$id] ?? 0) + 1;

        if ($b->stok < 1) {
            return back()->with('error', 'Stok barang habis.');
        }
        if ($baru > $b->stok) {
            return back()->with('error', "Jumlah melebihi stok (sisa {$b->stok}).");
        }

        $keranjang[$id] = $baru;
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