<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    App\Providers\HorizonServiceProvider::class,
    Barryvdh\Debugbar\ServiceProvider::class,
    Modules\Information\App\Providers\InformationServiceProvider::class,
    Modules\Management\App\Providers\ManagementServiceProvider::class,
    Modules\Settings\App\Providers\SettingsServiceProvider::class,
];
