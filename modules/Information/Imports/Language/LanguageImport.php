<?php

namespace Modules\Information\Imports\Language;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use App\Models\Information\Language;
use Generator;
use Modules\Information\DTO\Language\LanguageImportDTO;
use Modules\Information\Repositories\Language\LanguageRepository;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use Throwable;

final class LanguageImport extends AbstractImport implements Importable
{
    protected LanguageRepository $languageRepository;

    public function __construct()
    {
        $this->chunkSize = 10;
        $this->languageRepository = new LanguageRepository();
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
