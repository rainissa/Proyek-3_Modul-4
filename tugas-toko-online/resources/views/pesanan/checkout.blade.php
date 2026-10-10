@extends('layouts.app')
@section('judul', 'Checkout')
@section('isi')
    <h1>Checkout</h1>
    @if ($errors->any()) <div class="error">{{ $errors->first() }}</div> @endif

    <form method="POST" action="{{ route('checkout.proses') }}">
        @csrf
        <label>Alamat pengiriman
            <textarea name="alamat_pengiriman" rows="4" required>{{ old('alamat_pengiriman', auth()->user()->alamat) }}</textarea>
        </label>
        <p>Ongkos kirim diabaikan. Total bayar = total harga barang (dihitung ulang oleh server).</p>
        <p>
            <button type="submit">Buat pesanan</button>
            <a href="{{ route('keranjang.index') }}">Kembali</a>
        </p>
    </form>
@endsection