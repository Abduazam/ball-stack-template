<?php

namespace Modules\Management\Livewire\User\Forms;

use App\Models\User;
use App\Rules\ImageValidRule;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class UserForm extends Form
{
    #[Locked]
    public ?int $userId = null;

    #[Validate(as: 'fields.columns.user.name', translate: true)]
    public ?string $name = null;

    #[Validate(as: 'fields.columns.user.email', translate: true)]
    public ?string $email = null;

    #[Validate(as: 'fields.columns.user.password', translate: true)]
    public ?string $password = null;

    #[Validate(as: 'fields.columns.user.role', translate: true)]
    public ?int $role = null;

    #[Validate(as: 'fields.columns.user.image', translate: true)]
    public mixed $image = null;

    public function rules(): array
    {
        $rule = [
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'password' => ['min:4', 'max:12'],
            'role' => ['required', 'integer', 'exists:roles,id'],
            'image' => ['nullable', new ImageValidRule],
        ];

        $rule['password'][] = $this->userId ? 'nullable' : 'required';

        return $rule;
    }

    public function bind(User $user): void
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()?->id;
        $this->image = $user->image?->path;
    }
}
