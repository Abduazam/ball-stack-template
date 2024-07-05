<?php

namespace Modules\Management\App\Http\Controllers\Role;

use App\Handlers\Export\ExportHandler;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\Management\App\Models\Role\Role;
use Modules\Management\Transfers\Exports\Role\RoleExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class RoleExportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function __invoke(ExportHandler $handler): BinaryFileResponse
    {
        $this->authorize('export', Role::class);

        return $handler->handle(new RoleExport('role'));
    }
}
