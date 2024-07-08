<?php

namespace App\Contracts\Abstracts\Export;

use Generator;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\Abstracts\Export\Traits\ExportFileManager;

abstract class AbstractExport
{
    use ExportFileManager;

    protected array $headers = [];

    protected int $chunkSize = 1000;

    public function __construct(string $model)
    {
        $this->makeFilename($model);
        $this->makeFilepath();
        $this->headers();
    }

    protected function head(string $key): string
    {
        return trans($key);
    }

    public function generator(Collection $collection): Generator
    {
        $count = $collection->count();

        $chunks = (int) ceil($count / $this->chunkSize);

        for ($i = 0; $i < $chunks; $i++) {
            $offset = $i * $this->chunkSize;
            $chunk = $collection->slice($offset, $this->chunkSize);

            foreach ($chunk as $item) {
                yield $item;
            }
        }
    }
}
