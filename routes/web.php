<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('home');

Route::view('detail/{id}', 'detail')->name('detail');

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::get('register', 'register')->name('register');

        Route::post('login', 'authenticate');
        Route::post('register', 'store');
    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('dashboard', fn () => "Dashboard")->name('dashboard');

    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::post('store', 'store')->name('cart.store');
    });
});
