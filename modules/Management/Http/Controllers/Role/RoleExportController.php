<?php

namespace Modules\Management\Http\Controllers\Role;

use App\Handlers\Export\ExportHandler;
use App\Http\Controllers\Controller;
use App\Models\Management\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\Management\Exports\Role\RoleExport;
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

        return (new ExportHandler)->handle(new RoleExport('role'));
    }
}
