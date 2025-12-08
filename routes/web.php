<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaanController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// =============================
// PUBLIC (TANPA LOGIN)
// =============================
Route::get('/', [AuthController::class, 'index']);
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::resource('auth', AuthController::class)->only(['index', 'store', 'create']);
Route::resource('dashboard', DashboardController::class);



// =============================
// ROUTE ADMIN
// =============================
Route::middleware(['checkislogin', 'checkrole:Admin'])->group(function () {

    // DASHBOARD
    Route::resource('dashboard', DashboardController::class);

    // FULL AKSES (ADMIN)
    Route::resource('persil', PersilController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
    Route::resource('jenispenggunaan', JenisPenggunaanController::class);
});


// =============================
// ROUTE PEGAWAI
// =============================
Route::middleware(['checkislogin', 'checkrole:Pegawai'])->group(function () {

    // Pegawai hanya bisa Lihat + Tambah
    Route::resource('dashboard', DashboardController::class);
    Route::resource('persil', PersilController::class)->only([
        'index', 'show', 'create', 'store'
    ]);

    Route::resource('warga', WargaController::class)->only([
        'index', 'show', 'create', 'store'
    ]);

    Route::resource('user', UserController::class)->only([
        'index', 'show', 'create', 'store'
    ]);

    Route::resource('jenispenggunaan', JenisPenggunaanController::class)->only([
        'index', 'show', 'create', 'store'
    ]);
});
