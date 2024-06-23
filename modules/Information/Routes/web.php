<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/information')
    ->middleware(['auth', 'has_permission', 'locale'])
    ->name('dashboard.information.')
    ->group(function () {
        require __DIR__ . '/partials/language.php';
    });



