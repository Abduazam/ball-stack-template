<?php

use App\Http\Controllers\Dashboard\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::prefix('settings')->name('settings.')->group(base_path('routes/v1/partials/settings.php'));
Route::prefix('management')->name('management.')->group(base_path('routes/v1/partials/management.php'));
