<?php

namespace Modules\Information\Transfers\Imports\Language;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use Generator;
use Modules\Information\App\DTOs\Language\LanguageImportDTO;
use Modules\Information\App\Models\Language\Language;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use Throwable;

final class LanguageImport extends AbstractImport implements Importable
{
    public function __construct()
    {
        $this->chunkSize = 10;
    }

    /**
     * @throws IOException
     * @throws Throwable
     * @throws ReaderNotOpenedException
     * @throws UnsupportedTypeException
     */
    public function import(string $path): bool
    {
        try {
            $languageData = $this->generatorData($path, LanguageImportDTO::class);

            $this->insert($languageData);

            return true;
        } catch (Throwable $exception) {
            throw new $exception;
        }
    }

    protected function insert(Generator $collection): void
    {
        $languages = [];

        /**
         * @var LanguageImportDTO $language
         */
        foreach ($collection as $language) {
            $languages[] = $language->toArray();
        }

        (new ClosureHandler)->handle(function () use ($languages) {
            $languageChunk = array_chunk($languages, $this->chunkSize);

            $updateColumns = ['title'];

            foreach ($languageChunk as $chunk) {
                Language::upsert($chunk, ['slug'], $updateColumns);
            }
        });
    }
}
