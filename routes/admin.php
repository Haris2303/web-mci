<?php

use Illuminate\Support\Facades\Route;

Route::get('/register', [\App\Http\Controllers\Admin\RegisterController::class, 'index'])->name('admin.register');
Route::post('/admins', [\App\Http\Controllers\Admin\RegisterController::class, 'store'])->name('admin.store');
Route::post('/admins/login', [\App\Http\Controllers\Admin\LoginController::class, 'store'])->name('admin.login');

Route::middleware(\App\Http\Middleware\DashboardAuthMiddleware::class)->group(function () {
    Route::get(
        '/dashboard/background',
        [\App\Http\Controllers\Admin\BackgroundController::class, 'create']
    )->name('dashboard.background.create');
    Route::post(
        '/background',
        [\App\Http\Controllers\Admin\BackgroundController::class, 'store']
    )->name('backgrzound.store');
});
