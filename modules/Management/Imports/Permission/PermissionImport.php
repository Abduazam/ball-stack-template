<?php

namespace Modules\Management\Imports\Permission;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use App\Models\Management\Permission;
use Generator;
use Modules\Management\Repositories\Permissions\PermissionRepository;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;
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
            $collection = (new FastExcel)->withoutHeaders()->import($path);

            $existingPermissions = $this->permissionRepository->all()->pluck('name')->toArray();

            $permissionData = $this->generators($collection, function ($item) use ($existingPermissions) {
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

        foreach ($collection as $item) {
            $permissions[] = [
                'name' => $item[1],
                'guard_name' => config('auth.defaults.guard'),
                'description' => $this->description($item[2]),
                'is_default' => $item[3],
            ];
        }

        (new ClosureHandler)->handle(function () use ($permissions) {
            $permissionChunk = array_chunk($permissions, $this->chunkSize);

            $updateColumns = ['description', 'is_default'];

            foreach ($permissionChunk as $chunk) {
                Permission::upsert($chunk, ['name', 'guard_name'], $updateColumns);
            }
        });
    }

    private function description(string $value): false|string|null
    {
        if (blank($value)) {
            return null;
        }

        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return json_encode($decoded);
        }

        return json_encode(['error' => 'Invalid JSON']);
    }
}
