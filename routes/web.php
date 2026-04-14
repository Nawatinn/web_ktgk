<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController3;
use App\Http\Controllers\LaptopController2;

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/laptop/theloai/{id}', [HomeController::class, 'theoDanhMuc'])->name('category');
Route::get('/timkiem', [HomeController::class, 'timKiem'])->name('timkiem');


Route::get('/laptop/list', [LaptopController2::class, 'laptoplist'])->name('laptoplist');

Route::post('/laptop/delete', [LaptopController2::class, 'laptopdelete'])->name('laptopdelete');

Route::get('/laptop/detail/{id}', [LaptopController2::class, 'laptopdetail'])->name('laptopdetail');

Route::get('/laptop/{id}', [LaptopController3::class, 'show'])->name('laptop.show');
Route::middleware('auth')->group(function () {

    Route::get('/gio-hang', [LaptopController3::class, 'index'])->name('cart.index');

    Route::post('/them-gio-hang', [LaptopController3::class, 'addToCart'])->name('cart.add');

    Route::post('/xoa-gio-hang/{id}', [LaptopController3::class, 'remove'])->name('cart.remove');

    Route::post('/checkout', [LaptopController3::class, 'checkout'])->name('cart.checkout');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


