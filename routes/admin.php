<?php

use Illuminate\Support\Facades\Route;

Route::get('/register', [\App\Http\Controllers\Admin\RegisterController::class, 'index'])->name('admin.register');
