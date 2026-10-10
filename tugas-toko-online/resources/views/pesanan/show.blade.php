@extends('layouts.app')
@section('judul', 'Detail Pesanan')
@section('isi')
    <h1>Detail pesanan {{ $order->id_order }}</h1>
    <p>Tanggal: {{ $order->tanggal_order->format('d-m-Y H:i') }}</p>
    <p>Alamat pengiriman: {{ $order->alamat_pengiriman }}</p>

    <table>
        <tr><th>Barang</th><th>Harga satuan</th><th>Jumlah</th><th>Subtotal</th></tr>
        @foreach ($order->details as $d)
            <tr>
                <td>{{ $d->barang->nama_barang }}</td>
                <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $d->jumlah_beli }}</td>
                <td>Rp {{ number_format($d->harga_satuan * $d->jumlah_beli, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr><th colspan="3">Total</th><th>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</th></tr>
    </table>
    <p><a href="{{ route('pesanan.index') }}">&laquo; Kembali ke riwayat</a></p>
@endsection