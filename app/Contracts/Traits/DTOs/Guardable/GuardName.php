<?php

namespace App\Contracts\Traits\DTOs\Guardable;

trait GuardName
{
    private function guardName(): string
    {
        return config('auth.defaults.guard');
    }
}
