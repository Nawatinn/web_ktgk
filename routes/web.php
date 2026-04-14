<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/laptop/theloai/{id}', [HomeController::class, 'theoDanhMuc']);
Route::post('/timkiem', [HomeController::class, 'timKiem']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
