<?php

namespace App\Contracts\Enums\Folder;

enum FolderPathEnum : string
{
    case PROFILE = 'dashboard.settings.profile';
    case IMPORT = 'dashboard.settings.import';
    case USER = 'dashboard.management.user.';
    case ROLE = 'dashboard.management.role.';
    case PERMISSION = 'dashboard.management.permission.';
}
