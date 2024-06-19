<?php

namespace Modules\Settings\App\Http\Forms\Profile;

use App\Models\User;
use App\Rules\ImageValidRule;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{
    #[Locked]
    public ?int $userId = null;

    #[Validate]
    public ?string $name = null;

    #[Validate]
    public ?string $email = null;

    public ?string $role = null;

    #[Validate]
    public ?string $password = null;

    #[Validate]
    public mixed $image = null;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'password' => ['nullable', 'string', 'min:4'],
            'image' => ['nullable', new ImageValidRule],
        ];
    }

    public function bind(User $user): void
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles?->first()->name;
        $this->image = $user->image?->path;
    }
}
