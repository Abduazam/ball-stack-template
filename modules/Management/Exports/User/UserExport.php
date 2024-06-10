<?php

namespace Modules\Management\Exports\User;

use App\Contracts\Abstracts\Export\AbstractExport;
use App\Contracts\Interfaces\Export\Exportable;
use Modules\Management\Repositories\User\UserRepository;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

class UserExport extends AbstractExport implements Exportable
{
    protected UserRepository $userRepository;

    public function __construct(string $model)
    {
        parent::__construct($model);

        $this->userRepository = new UserRepository();
    }

    /**
     * @throws WriterNotOpenedException
     * @throws IOException
     * @throws UnsupportedTypeException
     * @throws InvalidArgumentException
     */
    public function export(): string
    {
        $collection = $this->userRepository->all();

        $excel = new FastExcel($this->generator($collection));

        $excel->export($this->path, function ($user) {
            return [
                'ID' => $user->id,
                'Name' => $user->name,
                'Email' => $user->email,
                'Password' => null,
                'Role' => $user->roles?->first()?->name,
            ];
        });

        return $this->publicPath();
    }
}
