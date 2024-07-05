<?php

namespace App\Contracts\Interfaces\Export;

use Generator;

interface Exportable
{
    public function collection(): Generator;

    public function headers(): void;

    public function asArray($item): array;

    public function export(): string;
}
