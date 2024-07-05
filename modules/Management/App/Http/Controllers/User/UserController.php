<?php

namespace Modules\Management\App\Http\Controllers\User;

use App\Contracts\Enums\Folder\FolderPathEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    protected string $path = FolderPathEnum::USER->value;

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('index', User::class);

        return view($this->path . 'index');
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create', User::class);

        return view($this->path . 'create');
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(User $user): View
    {
        $this->authorize('show', $user);

        return view($this->path . 'show', [
            'user' => $user->load('image', 'roles')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(User $user): View
    {
        $this->authorize('update', $user);

        return view($this->path . 'edit', [
            'user' => $user->load('roles'),
        ]);
    }
}
