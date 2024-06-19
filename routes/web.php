<?php

use App\Http\Controllers\Dashboard\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::prefix('dashboard')
    ->middleware(['auth', 'has_permission', 'locale'])
    ->name('dashboard.')
    ->group(function () {
        Route::get('/', WelcomeController::class)->name('welcome');
    });

