<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::resource('auth', AuthController::class);
Route::resource('warga', WargaController::class);
Route::resource('user', UserController::class);
Route::resource('jenispenggunaan', JenisPenggunaanController::class);
Route::resource('dashboard', DashboardController::class);
