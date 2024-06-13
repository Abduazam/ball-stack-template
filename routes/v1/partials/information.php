<?php

use Illuminate\Support\Facades\Route;
use Modules\Information\Http\Controllers\Language\LanguageController;
use Modules\Information\Http\Controllers\Language\LanguageExportController;

Route::get('languages/export', LanguageExportController::class)->name('languages.export');
Route::resource('languages', LanguageController::class)->except(['store', 'update', 'destroy']);
Route::prefix('languages')->name('languages.')->group(function () {
    $routes = ['delete', 'restore', 'destroy', 'import'];

    foreach ($routes as $route) {
        Route::get($route, fn() => abort(404))->name($route);
    }
});
