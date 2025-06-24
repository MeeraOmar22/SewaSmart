<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');;


Route::get('/', [CarController::class, 'welcome'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/about',function(){
    return view('about');
});

Route::get('/contact',function(){
    return view('contact');
});

Route::get('/booking/{id}',[BookingController::class,'getCarDetail'])
->middleware(['auth', 'verified'])
->name('booking');

Route::get('/payment',[BookingController::class,'getBookingDetail'])
->middleware(['auth', 'verified'])
->name('payment');

Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::post('/booking/create', [BookingController::class, 'store'])
     ->name('booking.create')
     ->middleware(['auth','verified']);


Route::post('/booking/return/{id}', [DashboardController::class, 'returnCar'])->name('booking.return');

Route::post('/booking/cancel/{id}', [DashboardController::class, 'cancelBooking'])->name('booking.cancel');

Route::put('/booking/update/{id}', [DashboardController::class, 'updateBooking'])->name('booking.update');

Route::post('/booking/feedback/{id}', [DashboardController::class, 'submitFeedback'])->name('booking.feedback');

Route::get('/cars', [CarController::class, 'index'])->name('cars.listings');
Route::get('/get-car-options', [CarController::class, 'getCarOptions']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
