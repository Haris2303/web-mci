<?php

use Illuminate\Support\Facades\Route;

Route::get('/register', [\App\Http\Controllers\Admin\RegisterController::class, 'index'])->name('admin.register');
Route::post('/admins', [\App\Http\Controllers\Admin\RegisterController::class, 'store'])->name('admin.store');
Route::post('/admins/login', [\App\Http\Controllers\Admin\LoginController::class, 'store'])->name('admin.login');

Route::middleware('auth:token')->group(function () {
    Route::get(
        '/dashboard/background',
        [\App\Http\Controllers\Admin\BackgroundController::class, 'create']
    )->name('dashboard.background.create');
    Route::put(
        '/background',
        [\App\Http\Controllers\Admin\BackgroundController::class, 'update']
    )->name('background.update');
    Route::put(
        '/vision-mision',
        [\App\Http\Controllers\Admin\VisionMisionController::class, 'update']
    )->name('visionmision.update');
});
