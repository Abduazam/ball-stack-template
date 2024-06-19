<?php

namespace Modules\Information\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class InformationRouteServiceProvider extends RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')->group(__DIR__.'/../../Routes/web.php');
        });
    }
}
