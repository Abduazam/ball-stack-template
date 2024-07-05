<?php

namespace Modules\Management\App\Actions\User;

use App\Contracts\Interfaces\Action\Actionable;
use App\Contracts\Traits\Actions\Imageable\ImageDeletable;
use App\Contracts\Traits\Actions\Imageable\ImageStorable;
use App\Models\User;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\Management\App\DTOs\User\UserDTO;

class UpdateUserAction implements Actionable
{
    use ImageStorable, ImageDeletable;

    protected User $user;
    protected UserDTO $dto;

    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->dto = new UserDTO($data);
    }

    public function run()
    {
        $this->user->update($this->dto->toNonNullArray());

        $this->handleImageUpdate();

        $this->handleRoleUpdate();

        return $this->user->id;
    }

    private function handleImageUpdate(): void
    {
        if (is_null($this->dto->image)) {
            $this->deletePreviousImage();
            return;
        }

        if ($this->dto->image instanceof TemporaryUploadedFile) {
            $this->deletePreviousImage();

            $this->addNewImage($this->user);
        }
    }

    private function handleRoleUpdate(): void
    {
        if (! $this->user->hasRole($this->dto->role)) {
            $this->user->syncRoles($this->dto->role);
        }
    }
}
