<?php

namespace App\Contracts\Interfaces\Import;

use Generator;

interface Importable
{
    public function import(string $path): bool;

    public function insert(Generator $collection): void;
}
