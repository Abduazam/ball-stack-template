<?php

namespace Modules\Information\Transfers\Imports\Language;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use Generator;
use Modules\Information\App\DTOs\Language\LanguageImportDTO;
use Modules\Information\App\Models\Language\Language;
use Modules\Information\Transfers\Imports\Language\Traits\EncoderMethods;

final class LanguageImport extends AbstractImport implements Importable
{
    use EncoderMethods;

    const DTO = LanguageImportDTO::class;

    protected ClosureHandler $handler;

    public function __construct()
    {
        $this->chunkSize = 10;
        $this->handler = new ClosureHandler();
    }

    public function import(string $path): bool
    {
        $this->insert($this->data($path));

        return true;
    }

    public function insert(Generator $collection): void
    {
        $data = $this->insertable($collection);

        $this->handler->handle(function () use ($data) {
            $chunks = array_chunk($data, $this->chunkSize);

            foreach ($chunks as $chunk) {
                Language::upsert($chunk, ['slug'], ['title']);
            }
        });
    }
}
