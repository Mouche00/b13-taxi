<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
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
    Route::get('/passenger/routes', [PassengerController::class, 'routes']);

    Route::post('/reservation/add', [ReservationController::class, 'store']);
    Route::patch('/reservation/{reservation}/update', [ReservationController::class, 'update']);
    Route::delete('/reservation/{reservation}/delete', [ReservationController::class, 'destroy']);

    Route::post('/review/add', [ReviewController::class, 'store']);
});

Route::middleware(['can:driver'])->group(function () {
    Route::get('/driver/dashboard', [DriverController::class, 'index']);
    Route::get('/driver/routes', [DriverController::class, 'routes']);
    Route::get('/driver/reservations', [DriverController::class, 'reservations']);

    Route::post('route/add', [RouteController::class, 'store']);
    Route::patch('driver/{driver}/edit', [DriverController::class, 'update']);
});

Route::middleware(['can:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::get('/admin/reservations', [AdminController::class, 'reservations']);

    Route::delete('/user/{user}/delete', [UserController::class, 'destroy'])->name('user.destroy');
    Route::delete('/reservation/{reservation}/delete', [ReservationController::class, 'destroy'])->name('reservation.destroy');
});

//Route::get('/admin', [AdminController::class], 'index')->middleware('can:admin');
//Route::get('/driver', [DriverController::class], 'index')->middleware('can:driver');
