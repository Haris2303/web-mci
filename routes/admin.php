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

    Route::post('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'store'])
        ->name('project.create');
    Route::put('/projects/{slug}', [\App\Http\Controllers\Admin\ProjectController::class, 'update'])
        ->name('project.update');
    Route::delete('/projects/{slug}', [\App\Http\Controllers\Admin\ProjectController::class, 'destroy'])
        ->name('project.delete');

    Route::post('/devisions', [\App\Http\Controllers\Admin\DevisionController::class, 'store'])
        ->name('devision.create');
    Route::put('/devisions/{id}', [\App\Http\Controllers\Admin\DevisionController::class, 'update'])
        ->where('id', '[0-9]+')
        ->name('devision.update');
    Route::delete('/devisions/{id}', [\App\Http\Controllers\Admin\DevisionController::class, 'destroy'])
        ->where('id', '[0-9]+')
        ->name('devision.delete');

    Route::put('/leadership_structures', [\App\Http\Controllers\Admin\LeadershipStructureController::class, 'upsert'])
        ->name('leadership-structre.upsert');
});
