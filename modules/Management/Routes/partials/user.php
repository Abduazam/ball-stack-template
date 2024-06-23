<?php

use Illuminate\Support\Facades\Route;
use Modules\Management\App\Http\Controllers\User\UserController;
use Modules\Management\App\Http\Controllers\User\UserExportController;

Route::get('users/export', UserExportController::class)->name('users.export');
Route::resource('users', UserController::class)->except(['store', 'update', 'destroy']);
Route::prefix('users')->name('users.')->group(function () {
    $routes = ['delete', 'restore', 'destroy', 'import'];

    foreach ($routes as $route) {
        Route::get($route, fn() => abort(404))->name($route);
    }
});
