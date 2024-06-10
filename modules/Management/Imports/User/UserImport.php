<?php

namespace Modules\Management\Imports\User;

use App\Contracts\Abstracts\Import\AbstractImport;
use App\Contracts\Interfaces\Import\Importable;
use App\Handlers\Closure\ClosureHandler;
use App\Models\Management\User;
use Generator;
use Modules\Management\Repositories\Role\RoleRepository;
use Modules\Management\Repositories\User\UserRepository;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Reader\Exception\ReaderNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;
use Throwable;

class UserImport extends AbstractImport implements Importable
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
            $existingEmails = $this->userRepository->all()->pluck('email')->toArray();

            $collection = (new FastExcel)->withoutHeaders()->import($path);

            $generatedUsers = $this->generators($collection, function ($row) use ($existingEmails) {
                return !in_array($row[2], $existingEmails);
            });

            $this->insert($generatedUsers);

            return true;
        } catch (Throwable $exception) {
            throw new $exception;
        }
    }

    private function insert(Generator $collection): void
    {
        $existingRoles = $this->roleRepository->all()->pluck('name')->toArray();

        $users = [];
        $roles = [];

        foreach ($collection as $item) {
            $users[] = [
                'name' => $item[1],
                'email' => $item[2],
                'password' => $item[3] ?? 'password',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (filled($item[4]) && in_array($item[4], $existingRoles)) {
                $roles[$item[2]] = $item[4];
            }
        }

        (new ClosureHandler)->handle(function () use ($users) {
            $userChunks = array_chunk($users, $this->chunkSize);

            foreach ($userChunks as $chunk) {
                User::insert($chunk);
            }
        });

        (new ClosureHandler)->handle(function () use ($roles) {
            $insertedUsers = $this->userRepository->findByClosure(function ($query) use ($roles) {
                return $query->with('roles')->whereIn('email', array_keys($roles));
            });

            foreach ($insertedUsers as $user) {
                $user->assignRole($roles[$user->email]);
            }
        });
    }
}
