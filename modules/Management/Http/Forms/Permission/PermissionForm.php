<?php

namespace Modules\Management\Http\Forms\Permission;

use App\Models\Management\Permission;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Modules\Information\Repositories\Language\LanguageRepository;

class PermissionForm extends Form
{
    #[Locked]
    public ?int $permissionId = null;

    #[Validate(as: 'fields.columns.role.is_default', translate: true)]
    public bool $is_default = false;

    #[Validate(as: 'fields.columns.role.description', translate: true)]
    public array $description = [];

    public function rules(): array
    {
        return [
            'is_default' => ['required', 'bool'],
            'description' => ['nullable', 'array'],
            'description.*' => ['string', 'min:3', 'max:255'],
        ];
    }

    public function bind(Permission $permission): void
    {
        $this->permissionId = $permission->id;
        $this->is_default = $permission->is_default;

        $languages = (new LanguageRepository)->all();

        $descriptions = json_decode($permission->description, true);

        foreach ($languages as $language) {
            $key = $language->slug;

            if (isset($descriptions[$key])) {
                $this->description[$key] = $descriptions[$key];
            } else {
                $this->description[$key] = '';
            }
        }
    }
}
