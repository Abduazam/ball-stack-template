<?php

namespace App\Livewire\Settings;

use App\Contracts\Traits\Livewire\Actions\RemoveImageTrait;
use App\Contracts\Traits\Livewire\Actions\ShowPasswordTrait;
use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Settings\App\Actions\Profile\UpdateProfileAction;
use Modules\Settings\App\Http\Forms\Profile\ProfileForm;

class Profile extends Component
{
    use WithFileUploads, DispatchingTrait, RemoveImageTrait, ShowPasswordTrait;

    public User $user;

    public ProfileForm $form;

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
            new UpdateProfileAction($this->user, $validated)
        );

        $this->handleResponse($response, 'profile', 'view');
    }

    public function render(): View
    {
        return view('livewire.settings.profile');
    }
}
