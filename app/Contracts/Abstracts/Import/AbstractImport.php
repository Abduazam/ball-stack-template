<?php

namespace App\Contracts\Abstracts\Import;

use Closure;
use Generator;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

abstract class AbstractImport
{
    protected int $chunkSize = 1000;

    abstract protected function insert(Generator $collection): void;

    /**
     * @throws IOException
     * @throws UnsupportedTypeException
     * @throws ReaderNotOpenedException
     */
    public function generatorData($path, $dto, ?Closure $function = null): Generator
    {
        $collection = (new FastExcel)->withoutHeaders()->import($path);

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
