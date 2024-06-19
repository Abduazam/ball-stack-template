<?php

namespace Modules\Management\App\Livewire\User;

use App\Contracts\Traits\Livewire\Actions\RemoveImageTrait;
use App\Contracts\Traits\Livewire\Actions\ShowPasswordTrait;
use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Livewire\WithFileUploads;
use Modules\Management\App\Actions\User\CreateUserAction;
use Modules\Management\App\Contracts\Abstracts\Livewire\User\Base;
use Modules\Management\App\Http\Forms\User\UserForm;
use Modules\Management\App\Repositories\Role\RoleRepository;

#[Lazy]
class Create extends Base
{
    use WithFileUploads, DispatchingTrait, RemoveImageTrait, ShowPasswordTrait;

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

        $this->handleResponse($response, 'user', 'view');
    }

    public function render(RoleRepository $roleRepository): View
    {
        return view($this->path . 'create', [
            'roles' => $roleRepository->all(),
        ]);
    }
}
