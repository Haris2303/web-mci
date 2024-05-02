<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/users/login', [\App\Http\Controllers\Api\UserController::class, 'login']);
Route::post('/users', [\App\Http\Controllers\Api\UserController::class, 'register']);

Route::middleware(['auth:token'])->group(function () {
    Route::get('users/current', [\App\Http\Controllers\Api\UserController::class, 'get']);
    Route::patch('/users/current', [\App\Http\Controllers\Api\UserController::class, 'update']);
    Route::delete('/users/logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);
});
