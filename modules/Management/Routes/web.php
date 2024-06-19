<?php

use Illuminate\Support\Facades\Route;
use Modules\Management\App\Http\Controllers\Permission\PermissionController;
use Modules\Management\App\Http\Controllers\Permission\PermissionExportController;
use Modules\Management\App\Http\Controllers\Role\RoleController;
use Modules\Management\App\Http\Controllers\Role\RoleExportController;
use Modules\Management\App\Http\Controllers\User\UserController;
use Modules\Management\App\Http\Controllers\User\UserExportController;

Route::prefix('dashboard/management')
    ->middleware(['auth', 'has_permission', 'locale'])
    ->name('dashboard.management.')
    ->group(function () {
        Route::get('users/export', UserExportController::class)->name('users.export');
        Route::resource('users', UserController::class)->except(['store', 'update', 'destroy']);
        Route::prefix('users')->name('users.')->group(function () {
            $routes = ['delete', 'restore', 'destroy', 'import'];

            foreach ($routes as $route) {
                Route::get($route, fn() => abort(404))->name($route);
            }
        });

        Route::get('roles/export', RoleExportController::class)->name('roles.export');
        Route::resource('roles', RoleController::class)->except(['store', 'update', 'destroy']);
        Route::prefix('roles')->name('roles.')->group(function () {
            $routes = ['delete', 'restore', 'destroy', 'import'];

            foreach ($routes as $route) {
                Route::get($route, fn() => abort(404))->name($route);
            }
        });

        Route::get('permissions/export', PermissionExportController::class)->name('permissions.export');
        Route::prefix('permissions')->name('permissions.')->group(function () {
            Route::get('', [PermissionController::class, 'index'])->name('index');
            Route::get('{permission}', [PermissionController::class, 'show'])->name('show');

            $routes = ['create', 'edit', 'delete', 'restore', 'destroy', 'import'];

            foreach ($routes as $route) {
                Route::get($route, fn() => abort(404))->name($route);
            }
        });
    });
