<?php

namespace Modules\Management\Transfers\Imports\Permission\Traits;

use App\Contracts\Traits\Import\Languageable;
use App\Contracts\Traits\Import\Permissible;
use Generator;
use Modules\Management\App\DTOs\Permission\PermissionImportDTO;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;

trait EncodeMethods
{
    use Permissible, Languageable;

    /**
     * @throws IOException
     * @throws UnsupportedTypeException
     * @throws ReaderNotOpenedException
     */
    private function data(string $path): Generator
    {
        $existingPermissions = $this->existingPermissions();

        $filter = function ($item) use ($existingPermissions) {
            $reindexItem = array_values($item);

            return in_array($reindexItem[1], $existingPermissions);
        };

        return $this->generatorData($path, self::DTO, $filter);
    }

    private function insertable(Generator $collection): array
    {
        $languages = array_flip($this->existingLanguages());

        $permissions = [];

        /**
         * @var PermissionImportDTO $item
         */
        foreach ($collection as $item) {
            $permission = [];

            foreach ($item->description as $slug => $translation) {
                if (isset($languages[$slug]) && $translation !== null) {
                    $permission[$slug] = $translation;
                }
            }

            if (!empty($permission)) {
                $permissions[] = $this->mergeValues($item, $permission);
            }
        }

        return $permissions;
    }

    private function mergeValues(PermissionImportDTO $item, array $permission): array
    {
        return array_merge(
            $item->toArray(),
            [
                'description' => json_encode($permission)
            ]
        );
    }
}
