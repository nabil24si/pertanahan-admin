<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('welcome');
});

/**route ke tampilan data persil**/
Route::get("/persil",[PersilController:: class, 'index']);


/**route untuk login dan proses login**/
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/store', [AuthController::class, 'store'])->name('auth.store');
Route::get('/tampilanlogin', function () {
    return view('tampilanlogin');
})->name('tampilanlogin');

/**route untuk tampilan dashboard**/
Route::get('/dashboard', function () {
    return view('dashboard');
});