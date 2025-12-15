<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenPersilController;
use App\Http\Controllers\JenisPenggunaanController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\PetaPersilController;
use App\Http\Controllers\ProfilePengembangController;
use App\Http\Controllers\SengketaPersilController;
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
        Route::delete('peta_persil/media/{id}', [PetaPersilController::class, 'deleteMedia'])->name('peta_persil.deleteMedia');
        Route::resource('peta_persil', PetaPersilController::class);
        Route::delete('sengketa_persil/media/{id}', [SengketaPersilController::class, 'deleteMedia'])->name('sengketa_persil.deleteMedia');
        Route::resource('sengketa_persil', SengketaPersilController::class);
        Route::delete('dokumen_persil/media/{id}', [DokumenPersilController::class, 'deleteMedia'])->name('dokumen_persil.deleteMedia');
        Route::resource('dokumen_persil', DokumenPersilController::class);
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
            'store',
        ]);

        Route::resource('warga', WargaController::class)->only([
            'index',
            'show',
            'create',
            'store',
        ]);

        Route::resource('user', UserController::class)->only([
            'index',
            'show',
            'create',
            'store',
        ]);

        Route::resource('jenispenggunaan', JenisPenggunaanController::class)->only([
            'index',
            'show',
            'create',
            'store',
        ]);
        Route::resource('dokumen_persil', DokumenPersilController::class)->only([
            'index',
            'show',
            'create',
            'store',
        ]);

        Route::resource('sengketa_persil', SengketaPersilController::class)->only([
            'index',
            'show',
            'create',
            'store',
        ]);
        Route::resource('peta_persil', PetaPersilController::class)->only([
            'index',
            'show',
            'create',
            'store',
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
