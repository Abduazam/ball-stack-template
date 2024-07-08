<?php

namespace Modules\Information\Transfers\Imports\Language\Traits;

use Generator;
use Modules\Information\App\DTOs\Language\LanguageImportDTO;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;

trait EncodeMethods
{
    /**
     * @throws IOException
     * @throws UnsupportedTypeException
     * @throws ReaderNotOpenedException
     */
    private function data(string $path): Generator
    {
        return $this->generatorData($path, self::DTO);
    }

    private function insertable(Generator $collection): array
    {
        $languages = [];

        /**
         * @var LanguageImportDTO $language
         */
        foreach ($collection as $language) {
            $languages[] = $language->toArray();
        }

        return $languages;
    }
}
