<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/detail/{id}', 'detail')->name('detail');

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::get('register', 'register')->name('register');

        Route::post('login', 'authenticate');
        Route::post('register', 'store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => "Dashboard")->name('dashboard');
});
