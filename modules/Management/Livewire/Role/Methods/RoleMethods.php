<?php

namespace Modules\Management\Livewire\Role\Methods;

use Illuminate\Database\Eloquent\Collection;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;

trait RoleMethods
{
    public function updated(string $property): void
    {
        if ($property === 'form.all') {
            $this->form->permissions = $this->form->all
                ? (new PermissionRepository)->all()->pluck('id')->toArray()
                : [];
        }
    }

    public function setGroupPermission(string $permissionIds): void
    {
        $ids = explode(',', $permissionIds);

        $allPresent = empty(array_diff($ids, $this->form->permissions));

        if ($allPresent) {
            $this->form->permissions = array_diff($this->form->permissions, $ids);
        } else {
            $permissions = array_flip($this->form->permissions);

            foreach ($ids as $id) {
                if (!isset($permissions[$id])) {
                    $permissions[$id] = true;
                }
            }

            $this->form->permissions = array_keys($permissions);
        }
    }

    public function setDefaultPermissions(Collection $defaults): void
    {
        if (empty($this->form->permissions)) {
            $this->form->permissions = $defaults->pluck('id')->toArray();
        }
    }

    public function areAllPermissionsSelected($group, $permissionIds): bool
    {
        foreach ($permissionIds as $id) {
            if (!in_array($id, $this->form->permissions)) {
                $this->dispatch('unchecked', [
                    'id' => $group
                ]);

                return false;
            }
        }

        $this->dispatch('checked', [
            'id' => $group
        ]);

        return true;
    }
}
