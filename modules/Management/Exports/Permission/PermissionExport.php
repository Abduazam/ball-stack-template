<?php

namespace Modules\Management\Exports\Permission;

use App\Contracts\Abstracts\Export\AbstractExport;
use App\Contracts\Interfaces\Export\Exportable;
use Modules\Management\Repositories\Permissions\PermissionRepository;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

class PermissionExport extends AbstractExport implements Exportable
{
    protected PermissionRepository $permissionRepository;

    public function __construct(string $model)
    {
        parent::__construct($model);

        $this->permissionRepository = new PermissionRepository();
    }

    /**
     * @throws IOException
     * @throws WriterNotOpenedException
     * @throws UnsupportedTypeException
     * @throws InvalidArgumentException
     */
    public function export(): string
    {
        $collection = $this->permissionRepository->all();

        $excel = new FastExcel($this->generator($collection));

        $excel->export($this->path, function ($permission) {
            return [
                'ID' => $permission->id,
                'Name' => $permission->name,
                'Guard name' => $permission->guard_name,
                'Description' => translation($permission->description),
                'Roles' => $permission->roles->pluck('name')->implode(', '),
            ];
        });

        return $this->publicPath();
    }
}
