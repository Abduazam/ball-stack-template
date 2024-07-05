<?php

namespace App\Contracts\Enums\Immutables\Export;

use App\Contracts\Interfaces\Enum\Enumable;

enum ExportTypeEnum : string implements Enumable
{
    case CSV = 'csv';
    case XLS = 'xls';
    case XLSX = 'xlsx';

    public static function toArray(): array
    {
        return array_map(function ($case) {
            return $case->value;
        }, self::cases());
    }
}
