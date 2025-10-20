<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisPenggunaanController;





Route::get('/', function () {
    return view('welcome');
});

/**route ke tampilan data persil**/
Route::get("/persil",[PersilController:: class, 'index']);


/**route untuk login dan proses login**/
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/store', [AuthController::class, 'store'])->name('auth.store');

Route::resource('auth', AuthController::class);
Route::resource('warga', WargaController::class);
Route::resource('jenispenggunaan', JenisPenggunaanController::class);

Route::get('/tampilanlogin', function () {
    return view('tampilanlogin');
})->name('tampilanlogin');

/**route untuk tampilan dashboard**/
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});