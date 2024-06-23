<?php

namespace Modules\Settings\Livewire\Import;

use App\Contracts\Enums\Folder\WireFolderPathEnum;
use App\Contracts\Enums\Route\RoutePathEnum;
use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Import\ImportHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;
use Modules\Settings\Livewire\Import\Forms\ImportForm;
use Modules\Settings\Livewire\Import\Methods\ImportMethods;
use Throwable;

final class Import extends Component
{
    use DispatchingTrait, WithFileUploads, ImportMethods;

    protected string $path = WireFolderPathEnum::IMPORT->value;

    protected $listeners = ['refresh' => '$refresh'];

    public ImportForm $form;

    public mixed $batchId = null;
    public bool $importing = false;
    public bool $importFinished = false;

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

    public function render(PermissionRepository $permissionRepository): View
    {
        return view($this->path, [
            'sections' => $permissionRepository->findByClosure(function ($query) {
                return $query->where('name', 'like', '%.import')->where('name', '!=', RoutePathEnum::IMPORT->value);
            }),
        ]);
    }
}
