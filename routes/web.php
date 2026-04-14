<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController3;
require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index']);
Route::get('/laptop/theloai/{id}', [HomeController::class, 'theoDanhMuc']);
Route::post('/timkiem', [HomeController::class, 'timKiem']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/laptop/{id}', [LaptopController3::class, 'show'])->name('laptop.show');

Route::middleware('auth')->group(function () {

    Route::get('/gio-hang', [LaptopController3::class, 'index'])->name('cart.index');
    Route::post('/them-gio-hang', [LaptopController3::class, 'addToCart'])->name('cart.add');
    Route::post('/xoa-gio-hang/{id}', [LaptopController3::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [LaptopController3::class, 'checkout'])->name('cart.checkout');

});

