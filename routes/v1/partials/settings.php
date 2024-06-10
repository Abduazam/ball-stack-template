<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\Import\ImportController;
use Modules\Settings\Http\Controllers\Locale\ChangeLanguageController;
use Modules\Settings\Http\Controllers\Profile\ProfileController;

Route::get('/profile', ProfileController::class)->name('profile');
Route::get('/import', ImportController::class)->name('import');
Route::get('/locale/{slug}', ChangeLanguageController::class)->name('locale');

