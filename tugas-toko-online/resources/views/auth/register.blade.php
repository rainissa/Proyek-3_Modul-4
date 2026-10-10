@extends('layouts.app')
@section('judul', 'Daftar')
@section('isi')
    <h1>Daftar akun</h1>
    @if ($errors->any())
        <div class="error">@foreach ($errors->all() as $e) {{ $e }}<br> @endforeach</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Nama lengkap <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required></label>
        <label>Email <input type="email" name="email" value="{{ old('email') }}" required></label>
        <label>Username <input type="text" name="username" value="{{ old('username') }}" required></label>
        <label>Password <input type="password" name="password" required></label>
        <label>Ulangi password <input type="password" name="password_confirmation" required></label>
        <label>No. HP <input type="text" name="no_hp" value="{{ old('no_hp') }}"></label>
        <label>Alamat <textarea name="alamat" rows="3">{{ old('alamat') }}</textarea></label>
        <p><button type="submit">Daftar</button></p>
    </form>
@endsection