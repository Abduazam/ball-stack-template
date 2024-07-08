<?php

namespace Modules\Management\Transfers\Imports\User\Traits;

use App\Models\User;
use Generator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Management\App\DTOs\User\UserImportDTO;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;

trait EncodeMethods
{
    private function existingRoles(): array
    {
        return $this->roleRepository->all()
            ->pluck('name')
            ->toArray();
    }

    private function insertingUsers(array $emails): Collection
    {
        return $this->userRepository->findByClosure(
            function ($query) use ($emails) {
                return $query->with('roles')->whereIn('email', $emails);
            }
        );
    }

    /**
     * @throws IOException
     * @throws UnsupportedTypeException
     * @throws ReaderNotOpenedException
     */
    private function data(string $path): Generator
    {
        return $this->generatorData($path, self::DTO);
    }

    private function insertable(Generator $collection): array
    {
        $existingRoles = array_flip($this->existingRoles());

        $users = [];
        $roles = [];

        /**
         * @var UserImportDTO $item
         */
        foreach ($collection as $item) {
            $users[] = $item->toArray();

            $this->addRole($item, $roles, $existingRoles);
        }

        return [
            'users' => $users,
            'roles' => $roles,
        ];
    }

    private function addRole(UserImportDTO $item, array &$roles, array $existingRoles): void
    {
        if (filled($item->role) && isset($existingRoles[$item->role])) {
            $roles[$item->email] = $item->role;
        }
    }

    private function assignRole(User $user, array $roles): void
    {
        if (isset($roles[$user->email]) && !$user->hasRole($roles[$user->email])) {
            $user->syncRoles($roles[$user->email]);
        }
    }
}
