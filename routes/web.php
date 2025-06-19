<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AuthController;

// ... Rute login/register ...

// Rute Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pesawat', [FlightController::class, 'index'])->name('flights.search');
Route::post('/pesawat/cari', [FlightController::class, 'search'])->name('flights.results');
Route::get('/kapal', [ShipController::class, 'index'])->name('ships.search');
Route::post('/kapal/cari', [ShipController::class, 'search'])->name('ships.results');
Route::get('/hotel', [HotelController::class, 'index'])->name('hotels.search');
Route::post('/hotel/cari', [HotelController::class, 'search'])->name('hotels.results');

// Authentication routes (untuk guest/belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rute yang Membutuhkan Login
Route::middleware('auth')->group(function () {
    Route::get('/profil', [AuthController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Rute Pembayaran Pesawat
    Route::prefix('flights')->name('flights.')->group(function () {
        Route::get('/payment/{id_penerbangan}', [FlightController::class, 'showPaymentPage'])->name('payment.show');
        Route::post('/payment', [FlightController::class, 'processPayment'])->name('payment.process');
    });

    // Rute Pembayaran Kapal
    Route::prefix('ships')->name('ships.')->group(function () {
        Route::get('/payment/{id_pelayaran}', [ShipController::class, 'showPaymentPage'])->name('payment.show');
        Route::post('/payment', [ShipController::class, 'processPayment'])->name('payment.process');
    });

    // Rute Pembayaran Hotel
    Route::prefix('hotels')->name('hotels.')->group(function () {
        Route::get('/payment/{id_reservasi}', [HotelController::class, 'showPaymentPage'])->name('payment.show');
        Route::post('/payment', [HotelController::class, 'processPayment'])->name('payment.process');
    });

    // Rute untuk Riwayat Pemesanan
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});