@extends('layouts.app')

@section('content')
@if (session()->has('alert_s'))
<p>{{ session('alert_s') }}</p>
@endif

<div class="row">
    <div class="col-lg-6 mx-auto my-4">
        <div class="card my-4">
            <div class="card-header">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <form action="/login" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-control mb-2" type="text" name="email">
                        @error('email')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-control mb-2" type="password" name="password">
                        @error('password')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Login</button>
                </form>
                <p>Belum punya akun? Silahkan klik <a href="{{ route('register') }}">Daftar</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
