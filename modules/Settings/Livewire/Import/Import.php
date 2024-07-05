<?php

namespace Modules\Settings\Livewire\Import;

use App\Contracts\Enums\Route\RoutePathEnum;
use App\Contracts\Traits\Livewire\Dispatches\Dispatchable;
use App\Handlers\Import\ImportHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\WithFileUploads;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;
use Modules\Settings\Contracts\Abstracts\Livewire\Import\Base;
use Modules\Settings\Livewire\Import\Forms\ImportForm;
use Modules\Settings\Livewire\Import\Methods\ImportMethods;
use Throwable;

final class Import extends Base
{
    use Dispatchable, WithFileUploads, ImportMethods;

    protected $listeners = ['refresh' => '$refresh'];

    public ImportForm $form;

    /**
     * @throws ValidationException
     * @throws Throwable
     */
    public function import(): void
    {
        $validated = $this->form->validate();

        $this->importing = true;

        $batch = (new ImportHandler($validated))->importable()->store()->handle();

        if (is_bool($batch)) {
            $this->importing = false;

            $this->handleResponse(true, $this->model, $this->type);
        } else {
            $this->batchId = $batch->id;
        }
    }

    public function render(PermissionRepository $permissionRepository): View
    {
        return view($this->path, [
            'sections' => $permissionRepository->findByClosure(function ($query) {
                return $query->where('name', 'like', '%.import')->where('name', '!=', RoutePathEnum::IMPORT->value);
            }),
        ]);
    }
}
