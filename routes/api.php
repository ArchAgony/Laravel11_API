<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', [APIController::class, 'student']);

Route::post('/students/add', [APIController::class, 'addstudent']);

Route::put('/students/update/{id}', [APIController::class, 'updatestudent']);

Route::delete('/students/delete/{id}', [APIController::class, 'deletestudent']);
