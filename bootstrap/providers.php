<?php

use Modules\Information\App\Providers\InformationServiceProvider;
use Modules\Management\App\Providers\ManagementServiceProvider;
use Modules\Settings\App\Providers\SettingsServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    Barryvdh\Debugbar\ServiceProvider::class,

    // MODULE PROVIDERS
    ManagementServiceProvider::class,
    InformationServiceProvider::class,
    SettingsServiceProvider::class,
];
