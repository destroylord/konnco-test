<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function authenticate()
    {
        if (!Auth::attempt($this->only('email', 'password')))
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah',
            ]);

        if (!Auth::user()->hasRole('user')) {
            Auth::logout();
            Session::regenerate();

            throw ValidationException::withMessages([
                'email' => 'Peran akun tidak sesuai',
            ]);
        }
    }
}
