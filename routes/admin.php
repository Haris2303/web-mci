<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [\App\Http\Controllers\Admin\RegisterController::class, 'index'])->name('admin.register');
Route::post('/admins', [\App\Http\Controllers\Admin\RegisterController::class, 'store'])->name('admin.store');
Route::get('/administrator/login', [LoginController::class, 'create']);

Route::post('/admins/login', [\App\Http\Controllers\Admin\LoginController::class, 'store'])
    ->middleware(\App\Http\Middleware\LoginAdminMiddleware::class)
    ->name('admin.login');

Route::middleware(['auth:token', \App\Http\Middleware\IsAdminMiddleware::class])->group(function () {
    Route::get(
        '/dashboard/background',
        [\App\Http\Controllers\Admin\BackgroundController::class, 'create']
    )->name('dashboard.background.create');
    Route::patch(
        '/background',
        [\App\Http\Controllers\Admin\BackgroundController::class, 'update']
    )->name('background.update');

    Route::patch(
        '/vision-mision',
        [\App\Http\Controllers\Admin\VisionMisionController::class, 'update']
    )->name('visionmision.update');

    // Project
    Route::post('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'store'])
        ->name('project.create');
    Route::put('/projects/{slug}', [\App\Http\Controllers\Admin\ProjectController::class, 'update'])
        ->name('project.update');
    Route::delete('/projects/{slug}', [\App\Http\Controllers\Admin\ProjectController::class, 'destroy'])
        ->name('project.delete');

    // Devision
    Route::post('/devisions', [\App\Http\Controllers\Admin\DevisionController::class, 'store'])
        ->name('devision.create');
    Route::put('/devisions/{id}', [\App\Http\Controllers\Admin\DevisionController::class, 'update'])
        ->where('id', '[0-9]+')
        ->name('devision.update');
    Route::delete('/devisions/{id}', [\App\Http\Controllers\Admin\DevisionController::class, 'destroy'])
        ->where('id', '[0-9]+')
        ->name('devision.delete');

    // Leadership Structure
    Route::patch('/leadership_structures', [\App\Http\Controllers\Admin\LeadershipStructureController::class, 'upsert'])
        ->name('leadership-structre.upsert');

    // Gallery
    Route::post('/galleries', [\App\Http\Controllers\Admin\GalleryController::class, 'store'])
        ->name('gallery.create');
    Route::delete('/galleries/{id}', [\App\Http\Controllers\Admin\GalleryController::class, 'destroy'])
        ->where('id', '[0-9]+')
        ->name('gallery.delete');

    // About Us
    Route::patch('/about_us', [\App\Http\Controllers\Admin\AboutUsController::class, 'upsert'])->name('about-us.create');

    // Cooperations
    Route::post('/cooperations', [\App\Http\Controllers\Admin\CooperationController::class, 'store'])
        ->name('cooperation.store');
    Route::put('/cooperations/{id}', [\App\Http\Controllers\Admin\CooperationController::class, 'update'])
        ->where('id', '[0-9]+')
        ->name('cooperation.update');
    Route::delete('/cooperations/{id}', [\App\Http\Controllers\Admin\CooperationController::class, 'destroy'])
        ->where('id', '[0-9]+')
        ->name('cooperation.delete');
});
