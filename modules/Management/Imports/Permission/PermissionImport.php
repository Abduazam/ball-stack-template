<?php

namespace Modules\Management\Imports\Permission;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use App\Models\Management\Permission;
use Generator;
use Modules\Management\DTO\Permission\PermissionImportDTO;
use Modules\Management\Repositories\Permissions\PermissionRepository;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use Throwable;

final class PermissionImport extends AbstractImport implements Importable
{
    protected PermissionRepository $permissionRepository;

    public function __construct()
    {
        $this->chunkSize = 100;
        $this->permissionRepository = new PermissionRepository();
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
            $existingPermissions = $this->permissionRepository->all()->pluck('name')->toArray();

            $permissionData = $this->generatorData($path, PermissionImportDTO::class, function ($item) use ($existingPermissions) {
                return in_array($item[1], $existingPermissions);
            });

            $this->insert($permissionData);

            return true;
        } catch (Throwable $exception) {
            throw new $exception;
        }
    }

    protected function insert(Generator $collection): void
    {
        $permissions = [];

        /**
         * @var PermissionImportDTO $permission
         */
        foreach ($collection as $permission) {
            $permissions[] = $permission->toArray();
        }

        (new ClosureHandler)->handle(function () use ($permissions) {
            $permissionChunk = array_chunk($permissions, $this->chunkSize);

            $updateColumns = ['description', 'is_default'];

            foreach ($permissionChunk as $chunk) {
                Permission::upsert($chunk, ['name', 'guard_name'], $updateColumns);
            }
        });
    }
}
