<?php

namespace App\Contracts\Enums\Folder;

enum FolderPathEnum : string
{
    /**
     * Information
     */
    case LANGUAGE = 'information::language.';

    /**
     * Management
     */
    case USER = 'management::user.';
    case ROLE = 'management::role.';
    case PERMISSION = 'management::permission.';

    /**
     * Settings
     */
    case PROFILE = 'settings::profile';
    case IMPORT = 'settings::import';
}
