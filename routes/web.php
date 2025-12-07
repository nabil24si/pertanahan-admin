<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaanController;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::delete('/persil/media/{id}', [PersilController::class, 'deleteMedia'])->name('persil.deleteMedia');
// Route Utama Persil (Index, Create, Store, Show, Edit, Update, Destroy)
Route::resource('persil', PersilController::class);

Route::resource('auth', AuthController::class);
Route::resource('warga', WargaController::class);
Route::resource('user', UserController::class);
Route::resource('jenispenggunaan', JenisPenggunaanController::class);
Route::resource('dashboard', DashboardController::class);



