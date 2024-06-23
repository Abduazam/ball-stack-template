<?php

namespace Modules\Management\Transfers\Imports\User;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use App\Models\User;
use Generator;
use Modules\Management\App\DTOs\User\UserImportDTO;
use Modules\Management\App\Repositories\Role\RoleRepository;
use Modules\Management\App\Repositories\User\UserRepository;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use Throwable;

final class UserImport extends AbstractImport implements Importable
{
    protected UserRepository $userRepository;
    protected RoleRepository $roleRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->roleRepository = new RoleRepository();
    }

    /**
     * @throws IOException
     * @throws Throwable
     * @throws ReaderNotOpenedException
     * @throws UnsupportedTypeException
     */
    public function import(string $path): bool
    {
        try {
            $userData = $this->generatorData($path, UserImportDTO::class);

            $this->insert($userData);

            return true;
        } catch (Throwable $exception) {
            throw new $exception;
        }
    }

    /**
     * @param Generator $collection
     */
    protected function insert(Generator $collection): void
    {
        $existingRoles = $this->roleRepository->all()->pluck('name')->toArray();

        $users = [];
        $roles = [];

        /**
         * @var UserImportDTO $user
         */
        foreach ($collection as $user) {
            $users[] = $user->toArray();

            if (filled($user->role) && in_array($user->role, $existingRoles)) {
                $roles[$user->email] = $user->role;
            }
        }

        (new ClosureHandler)->handle(function () use ($users) {
            $userChunks = array_chunk($users, $this->chunkSize);

            $updateColumns = ['name', 'password', 'email_verified_at'];

            foreach ($userChunks as $chunk) {
                User::upsert($chunk, ['email'], $updateColumns);
            }
        });

        (new ClosureHandler)->handle(function () use ($roles) {
            $insertedUsers = $this->userRepository->findByClosure(function ($query) use ($roles) {
                return $query->with('roles')->whereIn('email', array_keys($roles));
            });

            foreach ($insertedUsers as $user) {
                if (! $user->hasRole($roles[$user->email])) {
                    $user->syncRoles($roles[$user->email]);
                }
            }
        });
    }
}
