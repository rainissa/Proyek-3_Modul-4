@extends('layouts.app')
@section('judul', 'Daftar Barang')
@section('isi')
    <h1>Daftar barang</h1>
    <div class="grid">
        @foreach ($barang as $b)
            <div class="kartu">
                @if ($b->gambar && file_exists(public_path('images/' . $b->gambar)))
                    <img src="{{ asset('images/' . $b->gambar) }}" alt="{{ $b->nama_barang }}">
                @else
                    <div class="kosong"></div>
                @endif
                <h3>{{ $b->nama_barang }}</h3>
                <p>{{ $b->deskripsi }}</p>
                <p><strong>Rp {{ number_format($b->harga, 0, ',', '.') }}</strong></p>
                <p>Stok: {{ $b->stok }}</p>

                @if ($b->stok < 1)
                    <button disabled>Stok habis</button>
                @else
                    @auth
                        <form method="POST" action="{{ route('keranjang.tambah', $b->id_barang) }}">
                            @csrf <button type="submit">Masukkan ke keranjang</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login untuk membeli</a>
                    @endauth
                @endif
            </div>
        @endforeach
    </div>
@endsection