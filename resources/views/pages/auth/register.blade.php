@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6 mx-auto mt-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h4>Registrasi</h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}">

                        @error('name')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="text" name="email" value="{{ old('email') }}">

                        @error('email')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-control" type="password" name="password">

                        @error('password')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation">

                        @error('password_confirmation')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
