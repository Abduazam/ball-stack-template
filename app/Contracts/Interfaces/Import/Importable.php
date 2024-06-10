<?php

namespace App\Contracts\Interfaces\Import;

interface Importable
{
    public function import(string $path): bool;
}
