<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaanController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\ProfilePengembangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// =============================
// PUBLIC (TANPA LOGIN)
// =============================
Route::get('/', [AuthController::class, 'index']);
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::resource('auth', AuthController::class)->only(['index', 'store', 'create']);
Route::resource('profilepengembang', ProfilePengembangController::class);
// Route::resource('dashboard', DashboardController::class);



// =============================
// ROUTE ADMIN
// =============================

Route::middleware(['checkislogin'])->group(function () {

    Route::resource('dashboard', DashboardController::class);

    Route::middleware(['checkrole:Admin'])->group(function () {

        // DASHBOARD

        // FULL AKSES (ADMIN)
        Route::delete('/persil/media/{id}', [PersilController::class, 'deleteMedia'])->name('persil.deleteMedia');
        Route::resource('persil', PersilController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('user', UserController::class);
        Route::resource('jenispenggunaan', JenisPenggunaanController::class);
    });
    Route::middleware(['checkrole:Pegawai'])->group(function () {

        // Pegawai hanya bisa Lihat + Tambah
        // Route::resource('dashboard', DashboardController::class);
        Route::resource('persil', PersilController::class)->only([
            'index',
            'show',
            'create',
            'store'
        ]);

        Route::resource('warga', WargaController::class)->only([
            'index',
            'show',
            'create',
            'store'
        ]);

        Route::resource('user', UserController::class)->only([
            'index',
            'show',
            'create',
            'store'
        ]);

        Route::resource('jenispenggunaan', JenisPenggunaanController::class)->only([
            'index',
            'show',
            'create',
            'store'
        ]);
    });
});


// =============================
// ROUTE PEGAWAI
// =============================
// Route::middleware(['checkislogin', 'checkrole:Pegawai'])->group(function () {

//     // Pegawai hanya bisa Lihat + Tambah
//     Route::resource('dashboard', DashboardController::class);
//     Route::resource('persil', PersilController::class)->only([
//         'index', 'show', 'create', 'store'
//     ]);

//     Route::resource('warga', WargaController::class)->only([
//         'index', 'show', 'create', 'store'
//     ]);

//     Route::resource('user', UserController::class)->only([
//         'index', 'show', 'create', 'store'
//     ]);

//     Route::resource('jenispenggunaan', JenisPenggunaanController::class)->only([
//         'index', 'show', 'create', 'store'
//     ]);
// });
