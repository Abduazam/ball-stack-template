<?php

namespace Modules\Settings\Http\Controllers\Profile;

use App\Contracts\Enums\Folder\FolderPathEnum;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Management\Repositories\User\UserRepository;

class ProfileController extends Controller
{
    protected string $path = FolderPathEnum::PROFILE->value;

    public function __invoke(UserRepository $repository): View
    {
        $user = $repository->findById(auth()->id());

        return view($this->path, [
            'user' => $user->load('image')
        ]);
    }
}
