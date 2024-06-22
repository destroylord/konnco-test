@extends('layouts.auth')

@section('content')
<form action="" method="post">
    @csrf
    <div>
        <label for="name">Nama Lengkap</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}">

        @error('name')
            <small>{{ $message }}</small>
        @enderror
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" type="text" name="email" value="{{ old('email') }}">

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
        <label for="password_confirmation">Konfirmasi Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation">

        @error('password_confirmation')
            <small>{{ $message }}</small>
        @enderror
    </div>
    <div>
        <button type="submit">Daftar</button>
    </div>
</form>
@endsection
