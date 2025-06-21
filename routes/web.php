<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');;


Route::get('/about',function(){
    return view('about');
});

Route::get('/contact',function(){
    return view('contact');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cars', [CarController::class, 'index'])->name('cars.listings');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cars', [CarController::class, 'index'])->name('cars.listings');
});

require __DIR__.'/auth.php';
