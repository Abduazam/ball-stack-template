<?php

namespace Modules\Management\Livewire\User;

use App\Contracts\Traits\Livewire\Dispatches\Dispatchable;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Modules\Management\App\Actions\User\DestroyUserAction;
use Modules\Management\Contracts\Abstracts\Livewire\User\Base;

final class Destroy extends Base
{
    use Dispatchable;

    public User $user;

    public function destroy(): void
    {
        $response = (new ActionHandler)->handle(
            new DestroyUserAction($this->user)
        );

        $this->handleResponse($response, $this->model);
    }

    public function render(): View
    {
        return view($this->path . 'destroy');
    }
}
