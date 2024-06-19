<?php

namespace Modules\Management\App\Actions\User;

use App\Contracts\Interfaces\Action\Actionable;
use App\Models\User;
use Modules\Management\App\DTOs\User\UserDTO;

class CreateUserAction implements Actionable
{
    protected UserDTO $dto;

    public function __construct(array $data)
    {
        $this->dto = new UserDTO($data);
    }

    public function run()
    {
        $user = User::create($this->dto->toArray());

        if ($this->dto->image) {
            $this->addNewImage($user);
        }

        $user->assignRole($this->dto->role);

        return $user->id;
    }

    private function addNewImage(User $user): void
    {
        $path = $this->dto->image->store('users/avatars', 'public');

        $user->image()->create([
            'path' => $path,
        ]);
    }
}
