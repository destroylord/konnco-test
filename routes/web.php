<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseController;
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
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', fn () => "Dashboard")->name('dashboard');

    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::post('store', 'store')->name('cart.store');
        Route::post('checkout', 'checkout')->name('cart.checkout');
        Route::patch('update', 'update')->name('cart.update');
        Route::delete('{cart}', 'destroy')->name('cart.destroy');
    });
});

Route::get('purchase/{purchase}', [PurchaseController::class, 'show'])->name('purchase.show');
Route::post('purchase/{purchase}', [PurchaseController::class, 'upload'])->name('purchase.upload');
