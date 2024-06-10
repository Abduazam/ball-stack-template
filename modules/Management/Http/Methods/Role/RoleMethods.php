<?php

namespace Modules\Management\Http\Methods\Role;

use Illuminate\Database\Eloquent\Collection;
use Modules\Management\Repositories\Permissions\PermissionRepository;

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

    public function setPermission(int $permissionId): void
    {
        $index = array_search($permissionId, $this->form->permissions);

        if ($index === false) {
            $this->form->permissions[] = $permissionId;
        } else {
            unset($this->form->permissions[$index]);

            $this->form->all = false;
        }

        $this->form->permissions = array_values($this->form->permissions);
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
}
