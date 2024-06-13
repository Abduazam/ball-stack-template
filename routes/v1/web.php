<?php

use App\Http\Controllers\Dashboard\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::prefix('information')->name('information.')->group(base_path('routes/v1/partials/information.php'));
Route::prefix('management')->name('management.')->group(base_path('routes/v1/partials/management.php'));
Route::prefix('settings')->name('settings.')->group(base_path('routes/v1/partials/settings.php'));
