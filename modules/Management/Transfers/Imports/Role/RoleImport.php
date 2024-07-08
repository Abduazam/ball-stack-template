<?php

namespace Modules\Management\Transfers\Imports\Role;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use Generator;
use Modules\Management\App\DTOs\Role\RoleImportDTO;
use Modules\Management\App\Models\Role\Role;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;
use Modules\Management\App\Repositories\Role\RoleRepository;
use Modules\Management\Transfers\Imports\Role\Traits\EncodeMethods;

final class RoleImport extends AbstractImport implements Importable
{
    use EncodeMethods;

    const DTO = RoleImportDTO::class;

    protected ClosureHandler $handler;
    protected RoleRepository $roleRepository;
    protected PermissionRepository $permissionRepository;

    public function __construct()
    {
        $this->chunkSize = 10;
        $this->handler = new ClosureHandler();
        $this->roleRepository = new RoleRepository();
        $this->permissionRepository = new PermissionRepository();
    }

    public function import(string $path): bool
    {
        $this->insert($this->data($path));

        return true;
    }

    public function insert(Generator $collection): void
    {
        $data = $this->insertable($collection);

        $this->handler->handle(function () use ($data) {
            # Role updating
            $roleChunks = array_chunk($data['roles'], $this->chunkSize);

            foreach ($roleChunks as $chunk) {
                Role::upsert($chunk, ['name'], ['guard_name']);
            }

            # Role's permission updating
            $permissions = $data['permissions'];

            $roles = $this->insertingRoles(array_keys($permissions));

            /**
             * @var Role $role
             */
            foreach ($roles as $role) {
                $role->syncPermissions($permissions[$role->name]);
            }
        });
    }
}
