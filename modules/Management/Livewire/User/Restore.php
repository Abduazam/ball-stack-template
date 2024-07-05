<?php

namespace Modules\Management\Livewire\User;

use App\Contracts\Traits\Livewire\Dispatches\Dispatchable;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Modules\Management\App\Actions\User\RestoreUserAction;
use Modules\Management\Contracts\Abstracts\Livewire\User\Base;

final class Restore extends Base
{
    use Dispatchable;

    public User $user;

    public function restore(): void
    {
        $response = (new ActionHandler)->handle(
            new RestoreUserAction($this->user)
        );

        $this->handleResponse($response, $this->model);
    }

    public function render(): View
    {
        return view($this->path . 'restore');
    }
}
