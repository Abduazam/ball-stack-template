<?php

namespace Modules\Management\Http\Controllers\Permission;

use App\Contracts\Enums\Folder\FolderPathEnum;
use App\Http\Controllers\Controller;
use App\Models\Management\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;

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
