<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';

Route::get('/laptop/list', 'App\Http\Controllers\LaptopController2@laptoplist')->name('laptoplist');
Route::post('/laptop/delete', 'App\Http\Controllers\LaptopController2@laptopdelete')->name('laptopdelete');
Route::get('/laptop/detail/{id}', 'App\Http\Controllers\LaptopController2@laptopdetail')->name('laptopdetail');

