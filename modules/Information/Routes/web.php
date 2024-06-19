<?php

use Illuminate\Support\Facades\Route;
use Modules\Information\App\Http\Controllers\Language\LanguageController;
use Modules\Information\App\Http\Controllers\Language\LanguageExportController;

Route::prefix('dashboard/information')
    ->middleware(['auth', 'has_permission', 'locale'])
    ->name('dashboard.information.')
    ->group(function () {
        Route::get('languages/export', LanguageExportController::class)->name('languages.export');
        Route::resource('languages', LanguageController::class)->except(['store', 'update', 'destroy']);
        Route::prefix('languages')->name('languages.')->group(function () {
            $routes = ['delete', 'restore', 'destroy', 'import'];

            foreach ($routes as $route) {
                Route::get($route, fn() => abort(404))->name($route);
            }
        });
    });



