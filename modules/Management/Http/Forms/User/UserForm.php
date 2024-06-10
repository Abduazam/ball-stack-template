<?php

namespace Modules\Management\Http\Forms\User;

use App\Models\Management\User;
use App\Rules\ImageValidRule;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:50', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'role' => ['required', 'integer', 'exists:roles,id'],
            'password' => ['string', 'min:4', 'max:12'],
            'image' => ['nullable', new ImageValidRule],
        ];

        if ($this->userId) {
            $rule['password'][] = 'nullable';
        } else {
            $rule['password'][] = 'required';
        }

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
