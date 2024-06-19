<?php

namespace App\Livewire\Management\User;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Management\App\Actions\User\DestroyUserAction;

class Destroy extends Component
{
    use DispatchingTrait;

    public User $user;

    public function destroy(): void
    {
        $response = (new ActionHandler)->handle(
            new DestroyUserAction($this->user)
        );

        $this->handleResponse($response, 'user');
    }

    public function render(): View
    {
        return view('livewire.management.user.destroy');
    }
}
