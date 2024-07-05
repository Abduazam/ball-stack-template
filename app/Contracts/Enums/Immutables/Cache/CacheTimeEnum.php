<?php

namespace App\Contracts\Enums\Immutables\Cache;

enum CacheTimeEnum : int
{
    case FOREVER = 0;
    case MINUTE = 60;
    case HOUR = 3600;
    case DAY = 86400;
    case WEEK = 604800;

    public static function forever(): int
    {
        return CacheTimeEnum::FOREVER->value;
    }
}
