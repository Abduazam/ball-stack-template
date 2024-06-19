<?php

namespace Modules\Management\App\Livewire\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Modules\Management\App\Actions\Role\RestoreRoleAction;
use Modules\Management\App\Contracts\Abstracts\Livewire\Role\Base;
use Modules\Management\App\Models\Role\Role;

class Restore extends Base
{
    use DispatchingTrait;

    public Role $role;

    public function restore(): void
    {
        $response = (new ActionHandler)->handle(
            new RestoreRoleAction($this->role)
        );

        $this->handleResponse($response, 'role');
    }

    public function render(): View
    {
        return view($this->path . 'restore');
    }
}
