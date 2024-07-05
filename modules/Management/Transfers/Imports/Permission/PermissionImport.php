<?php

namespace Modules\Management\Transfers\Imports\Permission;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use Generator;
use Modules\Information\App\Repositories\Language\LanguageRepository;
use Modules\Management\App\DTOs\Permission\PermissionImportDTO;
use Modules\Management\App\Models\Permission\Permission;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;
use Modules\Management\Transfers\Imports\Permission\Traits\EncoderMethods;

final class PermissionImport extends AbstractImport implements Importable
{
    use EncoderMethods;

    const DTO = PermissionImportDTO::class;

    protected ClosureHandler $handler;
    protected LanguageRepository $languageRepository;
    protected PermissionRepository $permissionRepository;

    public function __construct()
    {
        $this->chunkSize = 100;
        $this->withoutHeaders = false;
        $this->handler = new ClosureHandler();
        $this->languageRepository = new LanguageRepository();
        $this->permissionRepository = new PermissionRepository();
    }

    public function import(string $path): bool
    {
        $this->insert($this->data($path));

        return true;
    }

    public function insert(Generator $collection): void
    {
        $permissions = $this->insertable($collection);

        $this->handler->handle(function () use ($permissions) {
            $uniqueColumns = ['name', 'guard_name'];
            $updateColumns = ['description', 'is_default'];

            $chunks = array_chunk($permissions, $this->chunkSize);

            foreach ($chunks as $chunk) {
                Permission::upsert($chunk, $uniqueColumns, $updateColumns);
            }
        });
    }
}
