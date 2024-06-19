<?php

namespace App\Livewire\Management\User;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Management\App\Actions\User\RestoreUserAction;

class Restore extends Component
{
    use DispatchingTrait;

    public User $user;

    public function restore(): void
    {
        $response = (new ActionHandler)->handle(
            new RestoreUserAction($this->user)
        );

        $this->handleResponse($response, 'user');
    }

    public function render(): View
    {
        return view('livewire.management.user.restore');
    }
}
