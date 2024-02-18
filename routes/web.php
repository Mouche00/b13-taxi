<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestController::class, 'index']);

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});


Route::get('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::middleware(['can:passenger'])->group(function () {
    Route::get('/passenger/dashboard', [PassengerController::class, 'index']);
    Route::get('/passenger/reservations', [PassengerController::class, 'reservations']);

    Route::post('/reservation/add', [ReservationController::class, 'store']);
});

Route::middleware(['can:driver'])->group(function () {
    Route::get('/driver/dashboard', [DriverController::class, 'index']);
    Route::get('/driver/routes', [DriverController::class, 'routes']);
    Route::get('/driver/reservations', [DriverController::class, 'reservations']);

    Route::post('route/add', [RouteController::class, 'store']);
});

//Route::get('/admin', [AdminController::class], 'index')->middleware('can:admin');
//Route::get('/driver', [DriverController::class], 'index')->middleware('can:driver');
