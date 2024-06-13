<?php

namespace Modules\Information\Http\Controllers\Language;

use App\Handlers\Export\ExportHandler;
use App\Http\Controllers\Controller;
use App\Models\Information\Language;
use Illuminate\Auth\Access\AuthorizationException;
use Modules\Information\Exports\Language\LanguageExport;
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
