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
use Modules\Management\Transfers\Imports\User\Traits\EncoderMethods;

final class UserImport extends AbstractImport implements Importable
{
    use EncoderMethods;

    const DTO = UserImportDTO::class;

    protected ClosureHandler $handler;
    protected UserRepository $userRepository;
    protected RoleRepository $roleRepository;

    public function __construct()
    {
        $this->handler = new ClosureHandler();
        $this->userRepository = new UserRepository();
        $this->roleRepository = new RoleRepository();
    }

    public function import(string $path): bool
    {
        $this->insert($this->data($path));

        return true;
    }

    public function insert(Generator $collection): void
    {
        $data = $this->insertable($collection);

        $this->handler->handle(function () use ($data) {
            # User updating
            $uniqueColumns = ['email'];
            $updateColumns = ['name', 'password', 'email_verified_at'];

            $userChunks = array_chunk($data['users'], $this->chunkSize);

            foreach ($userChunks as $chunk) {
                User::upsert($chunk, $uniqueColumns, $updateColumns);
            }

            $insertingUsers = $this->insertingUsers(array_keys($data['roles']));

            /**
             * User's role updating
             *
             * @var User $user
             */
            foreach ($insertingUsers as $user) {
                $this->assignRole($user, $data['roles']);
            }
        });
    }
}
