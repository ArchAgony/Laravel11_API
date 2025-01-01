<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// mengembalikan pesan 'api'
Route::get('/', function (){
    return 'api';
});

// mengambil nama dari resource di controller yang akan membuatkan semua route
// ambil contoh jika methodnya get, terus pake resoutce, nanti ya fungsinya sama
// Route::resource();

// sama seperti yang atas, cuma ndak ada method create sama edit
// karena method tersebut buwat view
Route::apiResource('posts', PostController::class);

// membuat route yang mengarahkan ke controller AuthController
// arahkan ke function yang bernama register
Route::post('/register', [AuthController::class, 'register']);

// arahkan ke function yang bernama login
Route::post('/login', [AuthController::class, 'login']);

// arahkan ke function yang bernama logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');