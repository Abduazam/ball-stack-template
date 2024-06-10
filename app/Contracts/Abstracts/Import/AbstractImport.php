<?php

namespace App\Contracts\Abstracts\Import;

use Closure;
use Generator;

abstract class AbstractImport
{
    protected int $chunkSize = 1000;

    public function generators($collection, ?Closure $function = null): Generator
    {
        $collection = $collection->slice(1);

        foreach ($collection as $item) {
            if ($function) {
                if ($function($item)) {
                    yield $item;
                }
            } else {
                yield $item;
            }
        }
    }
}
