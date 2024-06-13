<?php

namespace App\Handlers\Import;

use App\Contracts\Classes\Import\ImportObject;
use App\Contracts\Interfaces\Import\Importable;
use App\Jobs\Import\ImportExcelJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Modules\Settings\DTO\Import\ImportDTO;
use Throwable;

class ImportHandler
{
    protected ImportDTO $dto;
    protected ?string $filepath = null;
    protected Importable $import;

    public function __construct(array $data)
    {
        $this->dto = new ImportDTO($data);
    }

    public function getSection(): static
    {
        $this->import = (new ImportObject)->take($this->dto->section);

        return $this;
    }

    public function saveFile(): static
    {
        $path = $this->dto->file->store('imports');

        $this->filepath = storage_path('app/' . $path);

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function handle()
    {
        try {
            return $this->importWithJob();
        } catch (Throwable $exception) {
            throw new $exception;
        }
    }

    /**
     * @throws Throwable
     */
    private function importWithJob(): Batch
    {
        return Bus::batch([
            new ImportExcelJob($this->import, $this->filepath),
        ])->dispatch();
    }

    private function importWithSync(): bool
    {
        return $this->import->import($this->filepath);
    }
}
