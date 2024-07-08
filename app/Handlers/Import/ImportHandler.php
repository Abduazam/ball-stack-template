<?php

namespace App\Handlers\Import;

use App\Contracts\Classes\Import\ImportObject;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Import\Traits\ImportFileManager;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Modules\Settings\App\DTOs\Import\ImportDTO;
use Modules\Settings\App\Jobs\Import\ImportExcelJob;
use Throwable;

class ImportHandler
{
    use ImportFileManager;

    protected ImportDTO $dto;
    protected Importable $import;

    public function __construct(array $data)
    {
        $this->dto = new ImportDTO($data);
    }

    public function importable(): static
    {
        $importable = new ImportObject();

        $this->import = $importable->take($this->dto->section);

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function handle(): Batch|bool
    {
        try {
            return $this->importWithSync();
        } catch (Throwable $exception) {
            dd($exception);
            throw new $exception;
        }
    }

    /**
     * @throws Throwable
     */
    private function importWithJob(): Batch
    {
        return Bus::batch([
            (new ImportExcelJob($this->import, $this->filepath))->onQueue('import'),
        ])->catch(function (Batch $batch, Throwable $exception) {
            throw new $exception;
        })->dispatch();
    }

    private function importWithSync(): bool
    {
        return $this->import->import($this->filepath);
    }
}
