<?php

namespace Modules\Settings\Livewire\Import\Methods;

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

trait ImportMethods
{
    public mixed $batchId = null;
    public bool $importing = false;
    public bool $importFinished = false;

    public function mount(): void
    {
        $this->dispatchTrue();
    }

    public function getImportBatch(): ?Batch
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress(): void
    {
        if ($this->getImportBatch()) {
            $this->importFinished = $this->getImportBatch()->finished();
        }

        if ($this->importFinished) {
            $this->importing = false;

            $this->handleResponse(true, $this->model, $this->type);
        }
    }
}
