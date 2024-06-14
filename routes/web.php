<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Login
Route::post('/admins', [\App\Http\Controllers\Admin\RegisterController::class, 'store'])
    ->middleware('guest')
    ->name('admin.store');

Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'store']);

// dashboard index
Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::delete('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'destroy'])->name('admins.logout');

    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');

    Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');

    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');

    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])
        ->name('users.destroy');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    // Background
    Route::get(
        '/background',
        [\App\Http\Controllers\Admin\BackgroundController::class, 'create']
    )->name('background.create');

    Route::patch(
        '/background',
        [\App\Http\Controllers\Admin\BackgroundController::class, 'upsert']
    )->name('background.upsert');

    // Vision Mission
    Route::get('/vision-mision', [\App\Http\Controllers\Admin\VisionMisionController::class, 'create'])->name('vision-mision.create');

    Route::patch(
        '/vision-mision',
        [\App\Http\Controllers\Admin\VisionMisionController::class, 'upsert']
    )->name('vision-mision.upsert');

    // Project / Work Program
    Route::get('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('project.index');

    Route::get('/project/create', [\App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('project.create');

    Route::get('/project/edit/{slug}', [\App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('project.edit');

    Route::post('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'store'])
        ->name('project.store');

    Route::put('/projects/{slug}', [\App\Http\Controllers\Admin\ProjectController::class, 'update'])
        ->name('project.update');

    Route::delete('/projects/{slug}', [\App\Http\Controllers\Admin\ProjectController::class, 'destroy'])
        ->name('project.delete');

    // Devision
    Route::get('/devisions', [\App\Http\Controllers\Admin\DevisionController::class, 'index'])->name('devision.index');

    Route::get('/devisions/create', [\App\Http\Controllers\Admin\DevisionController::class, 'create'])->name('devision.create');

    Route::get('/devisions/edit/{id}', [\App\Http\Controllers\Admin\DevisionController::class, 'edit'])
        ->where('id', '[0-9]+')
        ->name('devision.edit');

    Route::post('/devisions', [\App\Http\Controllers\Admin\DevisionController::class, 'store'])
        ->name('devision.store');

    Route::put('/devisions/{id}', [\App\Http\Controllers\Admin\DevisionController::class, 'update'])
        ->where('id', '[0-9]+')
        ->name('devision.update');

    Route::delete('/devisions/{id}', [\App\Http\Controllers\Admin\DevisionController::class, 'destroy'])
        ->where('id', '[0-9]+')
        ->name('devision.delete');

    // Leadership Structure
    Route::get('/leadership-structure', [\App\Http\Controllers\Admin\LeadershipStructureController::class, 'index'])
        ->name('leadership-structure.index');

    Route::patch('/leadership-structures', [\App\Http\Controllers\Admin\LeadershipStructureController::class, 'upsert'])
        ->name('leadership-structure.upsert');

    // Gallery
    Route::get('/galleries', [\App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('gallery.index');

    Route::get('/galleries/create', [\App\Http\Controllers\Admin\GalleryController::class, 'create'])->name('gallery.create');

    Route::post('/galleries', [\App\Http\Controllers\Admin\GalleryController::class, 'store'])
        ->name('gallery.store');

    Route::delete('/galleries/{id}', [\App\Http\Controllers\Admin\GalleryController::class, 'destroy'])
        ->where('id', '[0-9]+')
        ->name('gallery.delete');

    // About Us
    Route::get('/about-us', [\App\Http\Controllers\Admin\AboutUsController::class, 'index'])->name('about-us.index');

    Route::patch('/about-us', [\App\Http\Controllers\Admin\AboutUsController::class, 'upsert'])->name('about-us.upsert');

    // Cooperations
    Route::get('/cooperations', [\App\Http\Controllers\Admin\CooperationController::class, 'index'])->name('cooperation.index');

    Route::get('/cooperations/create', [\App\Http\Controllers\Admin\CooperationController::class, 'create'])->name('cooperation.create');

    Route::get('/cooperations/{id}', [\App\Http\Controllers\Admin\CooperationController::class, 'edit'])
        ->where('id', '[0-9]+')
        ->name('cooperation.edit');

    Route::post('/cooperations', [\App\Http\Controllers\Admin\CooperationController::class, 'store'])
        ->name('cooperation.store');

    Route::put('/cooperations/{id}', [\App\Http\Controllers\Admin\CooperationController::class, 'update'])
        ->where('id', '[0-9]+')
        ->name('cooperation.update');

    Route::delete('/cooperations/{id}', [\App\Http\Controllers\Admin\CooperationController::class, 'destroy'])
        ->where('id', '[0-9]+')
        ->name('cooperation.delete');
});

require __DIR__ . '/auth.php';
