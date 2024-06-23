<?php

namespace Modules\Settings\Livewire\Import\Methods;

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

trait ImportMethods
{
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

            $this->handleResponse(true, 'import', 'view');
        }
    }
}
