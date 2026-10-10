<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
</head>
<body>
    <h1>Keranjang belanja</h1>
    <p><a href="{{ route('barang.index') }}">&laquo; Kembali ke daftar barang</a></p>
    <hr>

    @if (count($items) === 0)
        <p>Keranjang kosong.</p>
    @else
        @foreach ($items as $item)
            <div style="margin-bottom:12px">
                <strong>{{ $item['nama'] }}</strong><br>
                Rp {{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['jumlah'] }}
                = Rp {{ number_format($item['subtotal'], 0, ',', '.') }}

                <form method="POST" action="{{ route('keranjang.kurang', $item['id']) }}" style="display:inline">
                    @csrf <button type="submit">-</button>
                </form>
                {{ $item['jumlah'] }}
                <form method="POST" action="{{ route('keranjang.tambah', $item['id']) }}" style="display:inline">
                    @csrf <button type="submit">+</button>
                </form>
                <form method="POST" action="{{ route('keranjang.hapus', $item['id']) }}" style="display:inline">
                    @csrf <button type="submit">Hapus</button>
                </form>
            </div>
        @endforeach

        <hr>
        <h3>Total Rp {{ number_format($total, 0, ',', '.') }}</h3>

        <form method="POST" action="{{ route('keranjang.kosongkan') }}">
            @csrf
            <button type="submit">Kosongkan keranjang</button>
        </form>
    @endif
</body>
</html>