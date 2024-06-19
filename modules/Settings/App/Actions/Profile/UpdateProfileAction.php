<?php

namespace Modules\Settings\App\Actions\Profile;

use App\Contracts\Interfaces\Action\Actionable;
use App\Handlers\Closure\ClosureHandler;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\Settings\App\DTOs\Profile\ProfileDTO;

class UpdateProfileAction implements Actionable
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

        $this->user->fill($userAttributes)->save();

        if (is_null($this->dto->image)) {
            $this->deletePreviousImage();
        }

        if ($this->dto->image instanceof TemporaryUploadedFile) {
            $this->deletePreviousImage();

            $this->addNewImage();
        }

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
