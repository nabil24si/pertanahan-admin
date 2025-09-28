<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersilController;
Route::get("/persil",[PersilController:: class, 'index']);


Route::get('/', function () {
    return view('welcome');
});
