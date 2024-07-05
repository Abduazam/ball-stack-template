<?php

namespace Modules\Management\Transfers\Exports\Role;

use App\Contracts\Abstracts\Export\AbstractExport;
use App\Contracts\Interfaces\Export\Exportable;
use Generator;
use Modules\Management\App\Repositories\Role\RoleRepository;
use Modules\Management\Transfers\Exports\Role\Traits\DecoderMethods;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

final class RoleExport extends AbstractExport implements Exportable
{
    use DecoderMethods;

    public RoleRepository $roleRepository;

    public function __construct(string $model)
    {
        $this->roleRepository = new RoleRepository();

        parent::__construct($model);
    }

    /**
     * @throws IOException
     * @throws WriterNotOpenedException
     * @throws UnsupportedTypeException
     * @throws InvalidArgumentException
     */
    public function export(): string
    {
        $excel = new FastExcel($this->collection());

        $excel->export($this->path, function ($role) {
            return $this->asArray($role);
        });

        return $this->path();
    }

    public function collection(): Generator
    {
        $collection = $this->roleRepository->all();

        return $this->generator($collection);
    }

    public function headers(): void
    {
        $this->headers = [
            'id' => $this->head('fields.columns.general.id'),
            'name' => $this->head('fields.columns.role.name'),
            'users' => $this->head('fields.columns.role.users'),
            'permissions' => $this->head('fields.columns.role.permissions'),
        ];
    }

    public function asArray($item): array
    {
        $result = [];

        foreach ($this->headers as $attribute => $header) {
            $value = match ($attribute) {
                'users' => $this->users($item),
                'permissions' => $this->permissions($item),
                default => $item->$attribute,
            };

            $result[$header] = $value;
        }

        return $result;
    }
}
