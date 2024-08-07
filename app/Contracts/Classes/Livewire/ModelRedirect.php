<?php

namespace App\Contracts\Classes\Livewire;

use App\Contracts\Enums\Route\RoutePathEnum;
use InvalidArgumentException;

class ModelRedirect
{
    protected array $redirects = [
        # Information
        'language' => RoutePathEnum::LANGUAGE->value,
        # Management
        'user' => RoutePathEnum::USER->value,
        'role' => RoutePathEnum::ROLE->value,
        'permission' => RoutePathEnum::PERMISSION->value,
        # Settings
        'profile' => RoutePathEnum::PROFILE->value,
        'import' => RoutePathEnum::IMPORT->value,
    ];

    public function take(string $key)
    {
        if (! array_key_exists($key, $this->redirects)) {
            throw new InvalidArgumentException("The key '$key' does not exist in redirects.");
        }

        $route = $this->redirects[$key];

        if (str_ends_with($route, '.')) {
            return $route . 'index';
        }

        return $route;
    }
}
