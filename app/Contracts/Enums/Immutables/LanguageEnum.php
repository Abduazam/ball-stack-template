<?php

namespace App\Contracts\Enums\Immutables;

enum LanguageEnum : string
{
    case ENGLISH = 'en';
    case RUSSIAN = 'ru';

    public static function toArray(): array
    {
        return array_map(function ($case) {
            return $case->value;
        }, self::cases());
    }
}
