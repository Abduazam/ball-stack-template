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

final class PermissionExport extends AbstractExport implements Exportable
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
            return $this->asArray($permission);
        });

        return $this->publicPath();
    }

    protected function headers(): void
    {
        $this->headers = [
            'id' => $this->getHeader('fields.columns.general.id'),
            'name' => $this->getHeader('fields.columns.permission.name'),
            'guard_name' => $this->getHeader('fields.columns.permission.guard_name'),
            'description' => $this->getHeader('fields.columns.permission.description'),
            'roles' => $this->getHeader('fields.columns.permission.roles'),
        ];
    }

    protected function asArray($item): array
    {
        $result = [];

        foreach ($this->headers as $attribute => $header) {
            $value = match ($attribute) {
                'description' => translation($item->description),
                'roles' => $item->roles->pluck('name')->implode(', '),
                default => $item->$attribute
            };

            $result[$header] = $value;
        }

        return $result;
    }
}
