<?php

namespace App\Livewire\Settings;

use App\Contracts\Enums\Route\RoutePathEnum;
use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Import\ImportHandler;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;
use Modules\Settings\App\Http\Forms\Import\ImportForm;
use Throwable;

class Import extends Component
{
    use DispatchingTrait, WithFileUploads;

    public ImportForm $form;

    public ?string $model = null;

    public mixed $batchId = null;
    public bool $importing = false;
    public bool $importFinished = false;

    public function mount(): void
    {
        $this->dispatchTrue();
    }

    /**
     * @throws ValidationException
     * @throws Throwable
     */
    public function import(): void
    {
        $validated = $this->form->validate();

        $this->importing = true;

        $batch = (new ImportHandler($validated))->getSection()->saveFile()->handle();

        if (is_bool($batch)) {
            $this->importing = false;

            $this->handleResponse(true, 'import', 'view');
        } else {
            $this->batchId = $batch->id;
        }
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

    public function render(PermissionRepository $permissionRepository): View
    {
        return view('livewire.settings.import', [
            'sections' => $permissionRepository->findByClosure(function ($query) {
                return $query->where('name', 'like', '%.import')->where('name', '!=', RoutePathEnum::IMPORT->value);
            }),
        ]);
    }
}
