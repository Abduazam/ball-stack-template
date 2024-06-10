<?php

namespace App\Livewire\Management\User;

use App\Contracts\Traits\Livewire\Actions\RemoveImageTrait;
use App\Contracts\Traits\Livewire\Actions\ShowPasswordTrait;
use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Management\Commands\User\CreateUserCommand;
use Modules\Management\Http\Forms\User\UserForm;
use Modules\Management\Repositories\Role\RoleRepository;

#[Lazy]
class Create extends Component
{
    use WithFileUploads, DispatchingTrait, RemoveImageTrait, ShowPasswordTrait;

    public UserForm $form;

    /**
     * @throws ValidationException
     */
    public function create(): void
    {
        $validated = $this->form->validate();

        $response = (new CommandHandler)->handle(
            new CreateUserCommand($validated)
        );

        $this->handleResponse($response, 'user', 'view');
    }

    public function render(RoleRepository $roleRepository): View
    {
        return view('livewire.management.user.create', [
            'roles' => $roleRepository->all(),
        ]);
    }
}
