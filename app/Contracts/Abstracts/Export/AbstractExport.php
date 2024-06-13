<?php

namespace App\Contracts\Abstracts\Export;

use App\Contracts\Classes\Livewire\ModelTranslation;
use Generator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractExport
{
    protected array $headers = [];

    protected string $path;

    protected string $folder = 'exports';

    protected string $filename = 'export';

    protected string $type = 'xlsx';

    protected int $chunkSize = 1000;

    abstract protected function headers(): void;

    abstract protected function asArray($item): array;

    public function __construct(string $model)
    {
        $this->setFilename($model);

        $this->setPath();

        $this->headers();
    }

    protected function getHeader(string $key): string
    {
        return trans($key);
    }

    public function setFilename(string $model): void
    {
        $translation = (new ModelTranslation)->take($model);

        $this->filename = trans($translation);
    }

    public function setPath(): void
    {
        if (! file_exists(public_path($this->folder))) {
            mkdir(public_path($this->folder), 0755, true);
        }

        $this->path = $this->folder . '/' . $this->filename . '.' . $this->type;
    }

    public function publicPath(): string
    {
        return public_path($this->path);
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
