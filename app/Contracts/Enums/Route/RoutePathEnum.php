<?php

namespace App\Contracts\Enums\Route;

enum RoutePathEnum : string
{
    /**
     * Information
     */
    case LANGUAGE = 'dashboard.information.languages.';

    /**
     * Management
     */
    case USER = 'dashboard.management.users.';
    case ROLE = 'dashboard.management.roles.';
    case PERMISSION = 'dashboard.management.permissions.';

    /**
     * Settings
     */
    case PROFILE = 'dashboard.settings.profile';
    case IMPORT = 'dashboard.settings.import';
}
