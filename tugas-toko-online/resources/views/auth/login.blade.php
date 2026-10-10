@extends('layouts.app')
@section('judul', 'Login')
@section('isi')
    <h1>Login</h1>
    @if ($errors->has('login')) <div class="error">{{ $errors->first('login') }}</div> @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Username
            <input type="text" name="username" value="{{ old('username') }}" required>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <p><button type="submit">Masuk</button></p>
    </form>
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
@endsection