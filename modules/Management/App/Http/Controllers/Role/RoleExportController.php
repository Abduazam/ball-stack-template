<?php

namespace Modules\Management\App\Http\Controllers\Role;

use App\Handlers\Export\ExportHandler;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\Management\App\DataTransfer\Exports\Role\RoleExport;
use Modules\Management\App\Models\Role\Role;
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
