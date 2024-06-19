<?php

namespace Modules\Management\App\Livewire\User;

use App\Contracts\Traits\Livewire\Actions\RemoveImageTrait;
use App\Contracts\Traits\Livewire\Actions\ShowPasswordTrait;
use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Livewire\WithFileUploads;
use Modules\Management\App\Actions\User\UpdateUserAction;
use Modules\Management\App\Contracts\Abstracts\Livewire\User\Base;
use Modules\Management\App\Http\Forms\User\UserForm;
use Modules\Management\App\Repositories\Role\RoleRepository;

#[Lazy]
class Update extends Base
{
    use WithFileUploads, DispatchingTrait, RemoveImageTrait, ShowPasswordTrait;

    public User $user;

    public UserForm $form;

    public function mount(): void
    {
        $this->form->bind($this->user);
    }

    /**
     * @throws ValidationException
     */
    public function update(): void
    {
        $validated = $this->form->validate();

        $response = (new ActionHandler)->handle(
            new UpdateUserAction($this->user, $validated)
        );

        $this->handleResponse($response, 'user', 'view');
    }

    public function render(RoleRepository $roleRepository): View
    {
        return view($this->path . 'update', [
            'roles' => $roleRepository->all(),
        ]);
    }
}
