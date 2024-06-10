<?php

namespace App\Livewire\Management\User;

use App\Contracts\Traits\Livewire\Actions\RemoveImageTrait;
use App\Contracts\Traits\Livewire\Actions\ShowPasswordTrait;
use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Management\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Management\Commands\User\UpdateUserCommand;
use Modules\Management\Http\Forms\User\UserForm;
use Modules\Management\Repositories\Role\RoleRepository;

#[Lazy]
class Update extends Component
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

        $response = (new CommandHandler)->handle(
            new UpdateUserCommand($this->user, $validated)
        );

        $this->handleResponse($response, 'user', 'view');
    }

    public function render(RoleRepository $roleRepository): View
    {
        return view('livewire.management.user.update', [
            'roles' => $roleRepository->all(),
        ]);
    }
}