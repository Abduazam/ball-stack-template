<?php

namespace App\Contracts\Abstracts\Import;

use Closure;
use Generator;

abstract class AbstractImport
{
    protected int $chunkSize = 1000;

    abstract protected function insert(Generator $collection): void;

    public function generators($collection, $dto, ?Closure $function = null): Generator
    {
        $collection = $collection->slice(1);

        foreach ($collection as $item) {
            if ($function) {
                if ($function($item)) {
                    yield new $dto($item);
                }
            } else {
                yield new $dto($item);
            }
        }
    }
}
