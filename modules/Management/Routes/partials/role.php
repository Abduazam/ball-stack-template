<?php

use Illuminate\Support\Facades\Route;
use Modules\Management\App\Http\Controllers\Role\RoleController;
use Modules\Management\App\Http\Controllers\Role\RoleExportController;

Route::get('roles/export', RoleExportController::class)->name('roles.export');
Route::resource('roles', RoleController::class)->except(['store', 'update', 'destroy']);
Route::prefix('roles')->name('roles.')->group(function () {
    $routes = ['delete', 'restore', 'destroy', 'import'];

    foreach ($routes as $route) {
        Route::get($route, fn() => abort(404))->name($route);
    }
});
