<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\RegisterController;
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

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');

Route::get('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/driver/dashboard', [DriverController::class, 'index'])->middleware('can:driver');
Route::get('/passenger/dashboard', [PassengerController::class, 'index'])->middleware('can:passenger');

Route::post('route/add', [RouteController::class, 'store'])->middleware('can:driver');

//Route::get('/admin', [AdminController::class], 'index')->middleware('can:admin');
//Route::get('/driver', [DriverController::class], 'index')->middleware('can:driver');
