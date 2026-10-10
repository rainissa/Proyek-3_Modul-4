<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function formCheckout()
    {
        if (empty(session('keranjang', []))) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang masih kosong.');
        }

        return view('pesanan.checkout');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => ['required', 'string'],
        ]);

        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang masih kosong.');
        }

        try {
            $order = DB::transaction(function () use ($keranjang, $request) {
                // Kunci baris barang supaya stok tidak berubah di tengah proses
                $barang = Barang::whereIn('id_barang', array_keys($keranjang))
                    ->lockForUpdate()->get()->keyBy('id_barang');

                // 1. Validasi stok + hitung total dari HARGA DATABASE
                $total = 0;
                foreach ($keranjang as $id => $jumlah) {
                    $b = $barang[$id] ?? null;
                    if (!$b) {
                        throw new \RuntimeException('Ada barang yang tidak ditemukan.');
                    }
                    if ($jumlah > $b->stok) {
                        throw new \RuntimeException(
                            "Stok {$b->nama_barang} tidak cukup (sisa {$b->stok})."
                        );
                    }
                    $total += $b->harga * $jumlah;
                }

                // 2. Buat pesanan
                $order = Order::create([
                    'id_order'          => 'O' . date('ymdHis') . random_int(10, 99),
                    'id_user'           => Auth::id(),
                    'tanggal_order'     => now(),
                    'total_harga'       => $total,
                    'alamat_pengiriman' => $request->alamat_pengiriman,
                ]);

                // 3. Simpan detail + 4. kurangi stok
                foreach ($keranjang as $id => $jumlah) {
                    $b = $barang[$id];

                    OrderDetail::create([
                        'id_order'     => $order->id_order,
                        'id_barang'    => $id,
                        'harga_satuan' => $b->harga,
                        'jumlah_beli'  => $jumlah,
                    ]);

                    $b->decrement('stok', $jumlah);
                }

                return $order;
            });
        } catch (\RuntimeException $e) {
            return redirect()->route('keranjang.index')->with('error', $e->getMessage());
        }

        // 5. Kosongkan keranjang (hanya jika transaksi sukses)
        session()->forget('keranjang');

        return redirect()->route('pesanan.show', $order->id_order)
            ->with('sukses', 'Checkout berhasil. Terima kasih!');
    }

    public function index()
    {
        $pesanan = Order::where('id_user', Auth::id())
            ->orderByDesc('tanggal_order')->get();

        return view('pesanan.index', compact('pesanan'));
    }

    public function show($id)
    {
        // where id_user: user tidak bisa melihat pesanan orang lain
        $order = Order::with('details.barang')
            ->where('id_user', Auth::id())
            ->where('id_order', $id)
            ->firstOrFail();

        return view('pesanan.show', compact('order'));
    }
}