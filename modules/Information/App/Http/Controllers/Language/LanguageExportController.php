<?php

namespace Modules\Information\App\Http\Controllers\Language;

use App\Handlers\Export\ExportHandler;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\Information\App\Models\Language\Language;
use Modules\Information\Transfers\Exports\Language\LanguageExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class LanguageExportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function __invoke(ExportHandler $handler): BinaryFileResponse
    {
        $this->authorize('export', Language::class);

        return (new ExportHandler)->handle(new LanguageExport('language'));
    }
}
