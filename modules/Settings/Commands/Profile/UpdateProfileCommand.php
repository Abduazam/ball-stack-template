<?php

namespace Modules\Settings\Commands\Profile;

use App\Contracts\Interfaces\Command\Commandable;
use App\Handlers\Closure\ClosureHandler;
use App\Models\Management\User;
use Illuminate\Support\Facades\Storage;
use Modules\Settings\DTO\Profile\ProfileDTO;

class UpdateProfileCommand implements Commandable
{
    protected User $user;
    protected ProfileDTO $dto;

    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->dto = new ProfileDTO($data);
    }

    public function run(): int
    {
        $userAttributes = $this->dto->toNonNullArray();

        if (!is_string($userAttributes['image'])) {
            $this->deletePreviousImage();
        }

        if (isset($userAttributes['image']) && !is_string($userAttributes['image'])) {
            $this->addNewImage();

            unset($userAttributes['image']);
        }

        $this->user->fill($userAttributes)->save();

        return $this->user->id;
    }

    private function addNewImage(): void
    {
        (new ClosureHandler)->handle(function () {
            $path = $this->dto->image->store('users/avatars', 'public');

            $this->user->image()->create([
                'path' => $path,
            ]);
        });
    }

    private function deletePreviousImage(): void
    {
        (new ClosureHandler)->handle(function () {
            if ($this->user->image) {
                Storage::disk('public')->delete($this->user->image->path);

                $this->user->image->delete();
            }
        });
    }
}
