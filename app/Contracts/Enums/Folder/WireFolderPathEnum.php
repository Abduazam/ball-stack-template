<?php

namespace App\Contracts\Enums\Folder;

enum WireFolderPathEnum : string
{
    /**
     * Information
     */
    case LANGUAGE = 'wire-information::language.';

    /**
     * Management
     */
    case USER = 'wire-management::user.';
    case ROLE = 'wire-management::role.';
    case PERMISSION = 'wire-management::permission.';

    /**
     * Settings
     */
    case PROFILE = 'wire-settings::profile';
    case IMPORT = 'wire-settings::import';
}
