<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/users/login', [\App\Http\Controllers\Api\UserController::class, 'login']);

Route::middleware(['auth:token'])->group(function () {
    Route::post('/users', [\App\Http\Controllers\Api\UserController::class, 'register']);
    Route::get('users/current', [\App\Http\Controllers\Api\UserController::class, 'get']);
    Route::patch('/users/current', [\App\Http\Controllers\Api\UserController::class, 'update']);
    Route::delete('/users/logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);
    Route::delete('/users/{user}', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
});
