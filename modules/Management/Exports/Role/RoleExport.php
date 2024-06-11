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

final class RoleExport extends AbstractExport implements Exportable
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
            return $this->asArray($role);
        });

        return $this->publicPath();
    }

    protected function headers(): void
    {
        $this->headers = [
            'id' => $this->getHeader('fields.columns.general.id'),
            'name' => $this->getHeader('fields.columns.role.name'),
            'users' => $this->getHeader('fields.columns.role.users'),
            'permissions' => $this->getHeader('fields.columns.role.permissions'),
        ];
    }

    protected function asArray($item): array
    {
        $result = [];

        foreach ($this->headers as $attribute => $header) {
            $value = match ($attribute) {
                'users' => $item->users->pluck('email')->implode(', '),
                'permissions' => $item->permissions->pluck('name')->implode(', '),
                default => $item->$attribute,
            };

            $result[$header] = $value;
        }

        return $result;
    }
}
