<?php

namespace App\Contracts\Interfaces\Export;

interface Exportable
{
    public function export(): string;
}
