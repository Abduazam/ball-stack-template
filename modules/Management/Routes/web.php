<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/management')
    ->middleware(['auth', 'has_permission', 'locale'])
    ->name('dashboard.management.')
    ->group(function () {
        require __DIR__ . '/partials/user.php';
        require __DIR__ . '/partials/role.php';
        require __DIR__ . '/partials/permission.php';
    });
