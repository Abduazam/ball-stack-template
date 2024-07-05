<?php

namespace Modules\Management\App\Http\Controllers\User;

use App\Handlers\Export\ExportHandler;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\Management\Transfers\Exports\User\UserExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class UserExportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function __invoke(ExportHandler $handler): BinaryFileResponse
    {
        $this->authorize('export', User::class);

        return $handler->handle(new UserExport('user'));
    }
}
