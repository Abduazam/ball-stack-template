<?php

namespace App\Contracts\Traits\DTO;

trait Guardable
{
    private function guardName(): string
    {
        return config('auth.defaults.guard');
    }
}
