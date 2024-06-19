<?php

namespace Modules\Management\App\Http\Controllers\Permission;

use App\Contracts\Enums\Folder\FolderPathEnum;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Modules\Management\App\Models\Permission\Permission;

class PermissionController extends Controller
{
    protected string $path = FolderPathEnum::PERMISSION->value;

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('index', Permission::class);

        return view($this->path . 'index');
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Permission $permission): View
    {
        $this->authorize('show', $permission);

        return view($this->path . 'show', [
            'permission' => $permission->load('roles')
        ]);
    }
}
