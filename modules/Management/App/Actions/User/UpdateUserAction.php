<?php

namespace Modules\Management\App\Actions\User;

use App\Contracts\Interfaces\Action\Actionable;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\Management\App\DTOs\User\UserDTO;

class UpdateUserAction implements Actionable
{
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

    private function addNewImage(User $user): void
    {
        $path = $this->dto->image->store('users/avatars', 'public');

        $user->image()->create([
            'path' => $path,
        ]);
    }

    private function deletePreviousImage(): void
    {
        if ($this->user->image) {
            Storage::disk('public')->delete($this->user->image->path);

            $this->user->image->delete();
        }
    }

    private function handleRoleUpdate(): void
    {
        if (! $this->user->hasRole($this->dto->role)) {
            $this->user->syncRoles($this->dto->role);
        }
    }
}
