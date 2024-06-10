<?php

namespace App\Handlers\Export;

use App\Contracts\Interfaces\Export\Exportable;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class ExportHandler
{
    /**
     * @throws Throwable
     */
    public function handle(Exportable $export): BinaryFileResponse
    {
        try {
            $filepath = $export->export();

            return response()->download($filepath)->deleteFileAfterSend();
        } catch (Throwable $exception) {
            throw new $exception;
        }
    }
}
