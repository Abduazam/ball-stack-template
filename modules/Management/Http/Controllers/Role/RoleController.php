<?php

namespace Modules\Management\Http\Controllers\Role;

use App\Contracts\Enums\Folder\FolderPathEnum;
use App\Http\Controllers\Controller;
use App\Models\Management\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;

class RoleController extends Controller
{
    protected string $path = FolderPathEnum::ROLE->value;

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('index', Role::class);

        return view($this->path . 'index');
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create', Role::class);

        return view($this->path . 'create');
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Role $role): View
    {
        $this->authorize('show', $role);

        return view($this->path . 'show', [
            'role' => $role->load('users', 'permissions')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(Role $role): View
    {
        $this->authorize('update', $role);

        return view($this->path . 'edit', [
            'role' => $role->load('users', 'permissions'),
        ]);
    }
}
