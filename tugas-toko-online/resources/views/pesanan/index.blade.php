@extends('layouts.app')
@section('judul', 'Riwayat Pesanan')
@section('isi')
    <h1>Riwayat pesanan</h1>
    @if ($pesanan->isEmpty())
        <p>Belum ada pesanan.</p>
    @else
        <table>
            <tr><th>ID pesanan</th><th>Tanggal</th><th>Total</th><th></th></tr>
            @foreach ($pesanan as $p)
                <tr>
                    <td>{{ $p->id_order }}</td>
                    <td>{{ $p->tanggal_order->format('d-m-Y H:i') }}</td>
                    <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                    <td><a href="{{ route('pesanan.show', $p->id_order) }}">Detail</a></td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
