<?php

namespace Modules\Settings\App\DTOs\Profile;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

readonly class ProfileDTO extends AbstractObjectTransfer implements ObjectTransferable
{
    public string $name;
    public string $email;
    public ?string $password;
    public null|string|TemporaryUploadedFile $image;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->image = $data['image'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'image' => $this->image,
        ];
    }
}
