<?php

namespace Modules\Management\Exports\Role;

use App\Contracts\Abstracts\Export\AbstractExport;
use App\Contracts\Interfaces\Export\Exportable;
use Modules\Management\Repositories\Role\RoleRepository;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

class RoleExport extends AbstractExport implements Exportable
{
    protected RoleRepository $roleRepository;

    public function __construct(string $model)
    {
        parent::__construct($model);

        $this->chunkSize = 50;
        $this->roleRepository = new RoleRepository();
    }

    /**
     * @throws IOException
     * @throws WriterNotOpenedException
     * @throws UnsupportedTypeException
     * @throws InvalidArgumentException
     */
    public function export(): string
    {
        $collection = $this->roleRepository->all();

        $excel = new FastExcel($this->generator($collection));

        $excel->export($this->path, function ($role) {
            return [
                'ID' => $role->id,
                'Name' => $role->name,
                'Users' => $role->users->pluck('email')->implode(', '),
                'Permissions' => $role->permissions->pluck('name')->implode(', '),
            ];
        });

        return $this->publicPath();
    }
}
