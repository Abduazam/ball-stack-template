<?php

namespace App\Contracts\Enums\Route;

enum RoutePathEnum : string
{
    case PROFILE = 'dashboard.settings.profile';
    case IMPORT = 'dashboard.settings.import';
    case USER = 'dashboard.management.users.';
    case ROLE = 'dashboard.management.roles.';
    case PERMISSION = 'dashboard.management.permissions.';
}
