@extends('layouts.auth')

@section('content')
@if (session()->has('alert_s'))
<p>{{ session('alert_s') }}</p>
@endif

<form action="" method="post">
    @csrf
    <div>
        <label for="email">Email</label>
        <input id="email" type="text" name="email">

        @error('email')
            <small>{{ $message }}</small>
        @enderror
    </div>
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password">

        @error('password')
            <small>{{ $message }}</small>
        @enderror
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
</form>

<p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
@endsection
