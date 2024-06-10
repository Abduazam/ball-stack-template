<?php

namespace Modules\Management\Commands\User;

use App\Models\Management\User;
use Modules\Management\DTO\User\UserDTO;
use App\Contracts\Interfaces\Command\Commandable;

class CreateUserCommand implements Commandable
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
