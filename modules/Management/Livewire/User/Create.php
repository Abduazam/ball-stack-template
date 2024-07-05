<?php

namespace Modules\Management\Livewire\User;

use App\Contracts\Traits\Livewire\Actions\RemoveImageTrait;
use App\Contracts\Traits\Livewire\Actions\ShowPasswordTrait;
use App\Contracts\Traits\Livewire\Dispatches\Dispatchable;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Livewire\WithFileUploads;
use Modules\Management\App\Actions\User\CreateUserAction;
use Modules\Management\App\Repositories\Role\RoleRepository;
use Modules\Management\Contracts\Abstracts\Livewire\User\Base;
use Modules\Management\Livewire\User\Forms\UserForm;

#[Lazy]
final class Create extends Base
{
    use WithFileUploads, Dispatchable, RemoveImageTrait, ShowPasswordTrait;

    public UserForm $form;

    /**
     * @throws ValidationException
     */
    public function create(): void
    {
        $validated = $this->form->validate();

        $response = (new ActionHandler)->handle(
            new CreateUserAction($validated)
        );

        $this->handleResponse($response, $this->model, $this->type);
    }

    public function render(RoleRepository $roleRepository): View
    {
        return view($this->path . 'create', [
            'roles' => $roleRepository->all(),
        ]);
    }
}
