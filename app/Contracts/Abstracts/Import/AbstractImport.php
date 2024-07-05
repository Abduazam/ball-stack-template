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

    protected bool $withoutHeaders = true;

    /**
     * @throws IOException
     * @throws UnsupportedTypeException
     * @throws ReaderNotOpenedException
     */
    public function generatorData(string $path, $dto, ?Closure $function = null): Generator
    {
        $importer = new FastExcel();

        if ($this->withoutHeaders) {
            $importer->withoutHeaders();
        }

        $collection = $importer->import($path);

        if ($this->withoutHeaders) {
            $collection = $collection->slice(1);
        }

        foreach ($collection as $item) {
            $dtoInstance = new $dto($item);

            if ($function === null || $function($item)) {
                yield $dtoInstance;
            }
        }
    }
}
