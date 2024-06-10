<?php

namespace App\Livewire\Management\User;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Management\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Management\Commands\User\DestroyUserCommand;

class Destroy extends Component
{
    use DispatchingTrait;

    public User $user;

    public function destroy(): void
    {
        $response = (new CommandHandler)->handle(
            new DestroyUserCommand($this->user)
        );

        $this->handleResponse($response, 'user');
    }

    public function render(): View
    {
        return view('livewire.management.user.destroy');
    }
}
