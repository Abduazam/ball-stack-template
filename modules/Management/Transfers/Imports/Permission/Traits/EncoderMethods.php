<?php

namespace Modules\Management\Transfers\Imports\Permission\Traits;

use Generator;
use Modules\Management\App\DTOs\Permission\PermissionImportDTO;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;

trait EncoderMethods
{
    private function existingPermissions(): array
    {
        return $this->permissionRepository->all()
            ->pluck('name')
            ->toArray();
    }

    private function existingLanguages(): array
    {
        return $this->languageRepository->all()
            ->pluck('slug')
            ->toArray();
    }

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
