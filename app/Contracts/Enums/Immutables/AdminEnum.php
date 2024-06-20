<?php

namespace App\Contracts\Enums\Immutables;

enum AdminEnum : string
{
    case SUPERADMIN = 'super-admin';
    case ADMIN = 'admin';

    public static function toArray(): array
    {
        return array_map(function ($case) {
            return $case->value;
        }, self::cases());
    }
}
