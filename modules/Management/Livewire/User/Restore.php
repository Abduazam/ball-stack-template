<?php

namespace Modules\Management\Livewire\User;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Modules\Management\App\Actions\User\RestoreUserAction;
use Modules\Management\Contracts\Abstracts\Livewire\User\Base;

final class Restore extends Base
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
        return view($this->path . 'restore');
    }
}
