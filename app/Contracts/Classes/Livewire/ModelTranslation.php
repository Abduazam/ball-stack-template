<?php

namespace App\Contracts\Classes\Livewire;

use InvalidArgumentException;

class ModelTranslation
{
    protected array $models = [
        # Information
        'language' => 'fields.columns.language.language',
        # Management
        'user' => 'fields.columns.user.user',
        'role' => 'fields.columns.role.role',
        'permission' => 'fields.columns.permission.permission',
        # Settings
        'profile' => 'fields.nav.profile',
        'import' => 'fields.nav.import',
    ];

    public function take(string $key)
    {
        if (! array_key_exists($key, $this->models)) {
            throw new InvalidArgumentException("The key '$key' does not exist in models.");
        }

        return $this->models[$key];
    }
}
