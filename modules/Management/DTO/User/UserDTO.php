<?php

namespace Modules\Management\DTO\User;

use App\Contracts\Interfaces\DTO\ObjectTransferable;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

readonly class UserDTO implements ObjectTransferable
{
    public string $name;
    public string $email;
    public ?string $password;
    public int $role;
    public null|string|TemporaryUploadedFile $image;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->role = $data['role'];
        $this->image = $data['image'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public function toNonNullArray(): array
    {
        return array_filter($this->toArray(), function ($value) {
            return !is_null($value);
        });
    }
}
