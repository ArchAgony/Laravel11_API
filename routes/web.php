<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/simpanUser', [AuthController::class, 'simpanUser']);
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/cekLogin', [AuthController::class, 'cekLogin']);
// Route::get('/home', [NavController::class, 'home'])->middleware('auth');
// Route::get('/user', [NavController::class, 'user']);
// Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [NavController::class, 'home']);
    Route::get('/user', [NavController::class, 'user']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
