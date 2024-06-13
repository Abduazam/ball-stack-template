<?php

namespace Modules\Management\Imports\Role;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use App\Models\Management\Role;
use Generator;
use Illuminate\Support\Facades\DB;
use Modules\Management\DTO\Role\RoleImportDTO;
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
            $collection = (new FastExcel)->withoutHeaders()->import($path);

            $roleData = $this->generators($collection, RoleImportDTO::class);

            $this->insert($roleData);

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

        foreach ($collection as $role) {
            $roles[] = $role->toArray();

            if (filled($role->permissions)) {
                $data = $this->permissions($role->permissions, $existingPermissions);

                $permissions[$role->name] = $data;
            }
        }

        (new ClosureHandler)->handle(function () use ($roles) {
            $roleChunks = array_chunk($roles, $this->chunkSize);

            $updateColumns = ['guard_name', 'created_at', 'updated_at'];

            foreach ($roleChunks as $chunk) {
                Role::upsert($chunk, ['name'], $updateColumns);
            }
        });

        (new ClosureHandler)->handle(function () use ($permissions) {
            $insertedRoles = $this->roleRepository->findByClosure(function ($query) use ($permissions) {
                return $query->with('permissions')->whereIn('name', array_keys($permissions));
            });

            foreach ($insertedRoles as $role) {
                $newPermissions = $permissions[$role->name];

                $currentPermissions = $role->permissions;

                $this->revokePermissions($role, $newPermissions, $currentPermissions);

                $this->givePermissions($role, $newPermissions, $currentPermissions);
            }
        });
    }

    private function revokePermissions($role, $newPermissions, $currentPermissions): void
    {
        $permissions = $currentPermissions->reject(function ($permission) use ($newPermissions) {
            return in_array($permission->name, $newPermissions);
        });

        if (! empty($permissions)) {
            $role->revokePermissionTo($permissions);
        }
    }

    private function givePermissions($role, $newPermissions, $currentPermissions): void
    {
        $permissions = collect($newPermissions)->diff($currentPermissions->pluck('name')->toArray());

        if (! empty($permissions)) {
            $permissionIds = $this->permissionRepository->findByClosure(function ($query) use ($permissions) {
                $query->whereIn('name', $permissions);
            })->pluck('id');

            $data = $permissionIds->map(function ($permissionId) use ($role) {
                return [
                    'permission_id' => $permissionId,
                    'role_id' => $role->id,
                ];
            })->toArray();

            DB::table('role_has_permissions')->insert($data);
        }
    }

    private function permissions(string $permissions, array $existingPermissions): array
    {
        $data = explode(',', $permissions);

        return collect($data)
            ->filter(function ($item) {
                return $item !== '';
            })->map(function ($item) {
                return trim($item);
            })->filter(function ($item) use ($existingPermissions) {
                return in_array($item, $existingPermissions);
            })->toArray();
    }
}
