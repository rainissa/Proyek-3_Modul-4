@extends('layouts.app')
@section('judul', 'Keranjang')
@section('isi')
    <h1>Keranjang belanja</h1>
    <p><a href="{{ route('barang.index') }}">&laquo; Lanjut belanja</a></p>

    @if (count($items) === 0)
        <p>Keranjang kosong.</p>
    @else
        <table>
            <tr><th>Barang</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th></th></tr>
            @foreach ($items as $i)
                <tr>
                    <td>{{ $i['nama'] }}</td>
                    <td>Rp {{ number_format($i['harga'], 0, ',', '.') }}</td>
                    <td>
                        <form method="POST" action="{{ route('keranjang.kurang', $i['id']) }}" class="inline">
                            @csrf <button type="submit">-</button>
                        </form>
                        {{ $i['jumlah'] }}
                        <form method="POST" action="{{ route('keranjang.tambah', $i['id']) }}" class="inline">
                            @csrf <button type="submit">+</button>
                        </form>
                        <small>(stok {{ $i['stok'] }})</small>
                    </td>
                    <td>Rp {{ number_format($i['subtotal'], 0, ',', '.') }}</td>
                    <td>
                        <form method="POST" action="{{ route('keranjang.hapus', $i['id']) }}" class="inline">
                            @csrf <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr><th colspan="3">Total</th><th colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</th></tr>
        </table>

        <p>
            <form method="POST" action="{{ route('keranjang.kosongkan') }}" class="inline">
                @csrf <button type="submit">Kosongkan keranjang</button>
            </form>
            <a href="{{ route('checkout.form') }}"><button type="button">Checkout</button></a>
        </p>
    @endif
@endsection