<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\HotelController;


Route::get('/profil', function () {
    return 'Ini adalah halaman profil (placeholder)';
})->name('profile');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pesawat', [FlightController::class, 'index'])->name('flights.search');
Route::post('/pesawat/cari', [FlightController::class, 'search'])->name('flights.results');
Route::get('/kapal', [ShipController::class, 'index'])->name('ships.search');
Route::post('/kapal/cari', [ShipController::class, 'search'])->name('ships.results');
Route::get('/hotel', [HotelController::class, 'index'])->name('hotels.search');
Route::post('/hotel/cari', [HotelController::class, 'search'])->name('hotels.results');
