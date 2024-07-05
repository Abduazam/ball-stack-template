<?php

namespace Modules\Management\App\Http\Controllers\Permission;

use App\Handlers\Export\ExportHandler;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\Management\App\Models\Permission\Permission;
use Modules\Management\Transfers\Exports\Permission\PermissionExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class PermissionExportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function __invoke(ExportHandler $handler): BinaryFileResponse
    {
        $this->authorize('export', Permission::class);

        return $handler->handle(new PermissionExport('permission'));
    }
}
