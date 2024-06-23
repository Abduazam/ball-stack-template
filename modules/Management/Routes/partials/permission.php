<?php

use Illuminate\Support\Facades\Route;
use Modules\Management\App\Http\Controllers\Permission\PermissionController;
use Modules\Management\App\Http\Controllers\Permission\PermissionExportController;

Route::get('permissions/export', PermissionExportController::class)->name('permissions.export');
Route::prefix('permissions')->name('permissions.')->group(function () {
    Route::get('', [PermissionController::class, 'index'])->name('index');
    Route::get('{permission}', [PermissionController::class, 'show'])->name('show');

    $routes = ['create', 'edit', 'delete', 'restore', 'destroy', 'import'];

    foreach ($routes as $route) {
        Route::get($route, fn() => abort(404))->name($route);
    }
});
