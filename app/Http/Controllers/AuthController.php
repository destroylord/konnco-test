<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        session()->regenerate();

        return redirect('/');
    }

    public function authenticate(LoginRequest $request)
    {
        $request->authenticate();
        return redirect('/');
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole('seller');

        return redirect()->route('login')->with('alert_s', 'Berhasil mendaftarkan akun');
    }
}
