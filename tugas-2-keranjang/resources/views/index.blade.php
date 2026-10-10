<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
</head>
<body>
    <h1>Toko Alat Tulis</h1>
    <p><a href="{{ route('keranjang.index') }}">Keranjang ({{ $jumlahItem }})</a></p>
    <hr>

    <h2>Daftar barang</h2>
    <ul>
        @foreach ($barang as $b)
            <li>
                {{ $b->nama }} - Rp {{ number_format($b->harga, 0, ',', '.') }}
                <form method="POST" action="{{ route('keranjang.tambah', $b->id) }}" style="display:inline">
                    @csrf
                    <button type="submit">Masukkan ke keranjang</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>