<?php

namespace Modules\Settings\Livewire\Profile;

use App\Contracts\Enums\Folder\WireFolderPathEnum;
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
use Modules\Settings\Livewire\Profile\Forms\ProfileForm;

final class Profile extends Component
{
    use WithFileUploads, DispatchingTrait, RemoveImageTrait, ShowPasswordTrait;

    protected string $path = WireFolderPathEnum::PROFILE->value;

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
        return view($this->path);
    }
}
