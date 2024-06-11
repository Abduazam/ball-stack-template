<?php

namespace Modules\Management\Imports\Role;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use App\Models\Management\Role;
use Generator;
use Modules\Management\Repositories\Permissions\PermissionRepository;
use Modules\Management\Repositories\Role\RoleRepository;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;
use Throwable;

final class RoleImport extends AbstractImport implements Importable
{
    protected RoleRepository $roleRepository;
    protected PermissionRepository $permissionRepository;

    public function __construct()
    {
        $this->chunkSize = 10;
        $this->roleRepository = new RoleRepository();
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
            $existingRoles = $this->roleRepository->all()->pluck('name')->toArray();

            $collection = (new FastExcel)->withoutHeaders()->import($path);

            $generatedRoles = $this->generators($collection, function ($row) use ($existingRoles) {
                return !in_array($row[1], $existingRoles);
            });

            $this->insert($generatedRoles);

            return true;
        } catch (Throwable $exception) {
            throw new $exception;
        }
    }

    protected function insert(Generator $collection): void
    {
        $existingPermissions = $this->permissionRepository->all()->pluck('name')->toArray();

        $roles = [];
        $permissions = [];

        foreach ($collection as $item) {
            $roles[] = [
                'name' => $item[1],
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (!empty($item[3])) {
                $data = collect(explode(',', $item[3]))
                    ->filter(function ($item) {
                        return $item !== '';
                    })->map(function ($item) {
                        return trim($item);
                    })->filter(function ($item) use ($existingPermissions) {
                        return in_array($item, $existingPermissions);
                    })->toArray();

                $permissions[$item[1]] = $data;
            }
        }

        (new ClosureHandler)->handle(function () use ($roles, $permissions) {
            $roleChunks = array_chunk($roles, $this->chunkSize);

            foreach ($roleChunks as $chunk) {
                Role::insert($chunk);
            }

            $insertedRoles = $this->roleRepository->findByClosure(function ($query) use ($permissions) {
                return $query->with('permissions')->whereIn('name', array_keys($permissions));
            });

            foreach ($insertedRoles as $role) {
                $role->givePermissionTo($permissions[$role->name]);
            }
        });
    }
}
