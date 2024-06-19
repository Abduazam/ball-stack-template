<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\App\Http\Controllers\Import\ImportController;
use Modules\Settings\App\Http\Controllers\Locale\ChangeLanguageController;
use Modules\Settings\App\Http\Controllers\Profile\ProfileController;

Route::prefix('dashboard/settings')
    ->middleware(['auth', 'has_permission', 'locale'])
    ->name('dashboard.settings.')
    ->group(function () {
        Route::get('/profile', ProfileController::class)->name('profile');
        Route::get('/import', ImportController::class)->name('import');
        Route::get('/locale/{slug}', ChangeLanguageController::class)->name('locale');
    });
