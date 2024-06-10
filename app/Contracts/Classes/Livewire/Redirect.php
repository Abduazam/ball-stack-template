<?php

namespace App\Contracts\Classes\Livewire;

use App\Contracts\Enums\Route\RoutePathEnum;
use InvalidArgumentException;

class Redirect
{
    protected array $redirects = [
        'profile' => RoutePathEnum::PROFILE->value,
        'import' => RoutePathEnum::IMPORT->value,
        'user' => RoutePathEnum::USER->value,
        'role' => RoutePathEnum::ROLE->value,
        'permission' => RoutePathEnum::PERMISSION->value,
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
