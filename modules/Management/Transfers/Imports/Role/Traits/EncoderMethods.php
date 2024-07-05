<?php

namespace Modules\Management\Transfers\Imports\Role\Traits;

use Generator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Management\App\DTOs\Role\RoleImportDTO;
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

    private function insertingRoles(array $roles): Collection
    {
        return $this->roleRepository->findByClosure(
            function ($query) use ($roles) {
                return $query->with('permissions')->whereIn('name', $roles);
            }
        );
    }

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
        $existingPermissions = array_flip($this->existingPermissions());

        $roles = [];
        $permissions = [];

        /**
         * @var RoleImportDTO $item
         */
        foreach ($collection as $item) {
            $roles[] = $item->toArray();

            if (filled($item->permissions)) {
                $permissions[$item->name] = $this->explodePermissions($item->permissions, $existingPermissions);
            }
        }

        return [
            'roles' => $roles,
            'permissions' => $permissions,
        ];
    }

    private function explodePermissions(string $permissions, array $existingPermissions): array
    {
        $data = explode(',', $permissions);

        $result = [];

        foreach ($data as $value) {
            $name = trim($value);

            if ($name !== '' && isset($existingPermissions[$name])) {
                $result[] = $name;
            }
        }

        return $result;
    }
}
