<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::prefix('dashboard')
    ->middleware(['auth', 'has_permission', 'locale'])
    ->name('dashboard.')
    ->group(base_path('routes/v1/web.php'));

