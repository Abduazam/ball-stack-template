<?php

namespace App\Contracts\Enums\Folder;

enum FolderPathEnum : string
{
    /**
     * Information
     */
    case LANGUAGE = 'dashboard.information.language.';

    /**
     * Management
     */
    case USER = 'dashboard.management.user.';
    case ROLE = 'dashboard.management.role.';
    case PERMISSION = 'dashboard.management.permission.';

    /**
     * Settings
     */
    case PROFILE = 'dashboard.settings.profile';
    case IMPORT = 'dashboard.settings.import';
}
