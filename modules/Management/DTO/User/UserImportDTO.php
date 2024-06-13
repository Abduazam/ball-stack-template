<?php

namespace Modules\Management\DTO\User;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;

readonly class UserImportDTO extends AbstractObjectTransfer implements ObjectTransferable
{
    public string $name;
    public string $email;
    public string $password;
    public string $role;
    public function __construct(array $data)
    {
        $this->name = $data[1];
        $this->email = $data[2];
        $this->password = $data[3];
        $this->role = $data[4];


    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password(),
            'email_verified_at' => now(),
        ];
    }

    private function password(): string
    {
        $password = 'password';

        if (filled($this->password)) {
            $password = $this->password;
        }

        return bcrypt($password);
    }
}
