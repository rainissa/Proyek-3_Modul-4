<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Toko Alat Tulis')</title>
    <style>
        body { font-family: sans-serif; max-width: 960px; margin: 0 auto; padding: 1rem; }
        nav { display: flex; gap: 1rem; align-items: center; padding-bottom: .75rem; border-bottom: 1px solid #ccc; }
        nav .kanan { margin-left: auto; display: flex; gap: .75rem; align-items: center; }
        .sukses { background: #e6f4ea; color: #1e7e34; padding: .5rem 1rem; margin: .75rem 0; }
        .error { background: #fdecea; color: #c0392b; padding: .5rem 1rem; margin: .75rem 0; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 1rem; }
        .kartu { border: 1px solid #ddd; padding: .75rem; border-radius: 6px; }
        .kartu img, .kartu .kosong { width: 100%; height: 130px; object-fit: cover; background: #eee; display: block; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: .4rem .6rem; text-align: left; }
        form.inline { display: inline; }
        label { display: block; margin-top: .6rem; }
        input, textarea { width: 100%; max-width: 380px; padding: .35rem; }
    </style>
</head>
<body>
    <nav>
        <strong><a href="{{ route('barang.index') }}">Toko Alat Tulis</a></strong>
        <div class="kanan">
            @auth
                <span>Halo, {{ auth()->user()->nama_lengkap }}</span>
                <a href="{{ route('keranjang.index') }}">Keranjang ({{ array_sum(session('keranjang', [])) }})</a>
                <a href="{{ route('pesanan.index') }}">Riwayat pesanan</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </nav>

    @if (session('sukses')) <div class="sukses">{{ session('sukses') }}</div> @endif
    @if (session('error')) <div class="error">{{ session('error') }}</div> @endif

    @yield('isi')
</body>
</html>