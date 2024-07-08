<?php

namespace Modules\Management\Transfers\Exports\Permission;

use App\Contracts\Abstracts\Export\AbstractExport;
use App\Contracts\Interfaces\Export\Exportable;
use App\Contracts\Traits\Export\Translationable;
use Generator;
use Modules\Information\App\Repositories\Language\LanguageRepository;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

final class PermissionExport extends AbstractExport implements Exportable
{
    use Translationable;

    public LanguageRepository $languageRepository;
    public PermissionRepository $permissionRepository;

    public function __construct(string $model)
    {
        $this->languageRepository = new LanguageRepository();
        $this->permissionRepository = new PermissionRepository();

        parent::__construct($model);
    }

    /**
     * @throws WriterNotOpenedException
     * @throws IOException
     * @throws UnsupportedTypeException
     * @throws InvalidArgumentException
     */
    public function export(): string
    {
        $excel = new FastExcel($this->collection());

        $excel->export($this->path, function ($permission) {
            return $this->asArray($permission);
        });

        return $this->path();
    }

    public function collection(): Generator
    {
        $result = $this->permissionRepository->all();

        return $this->generator($result);
    }

    public function headers(): void
    {
        $this->headers = [
            'id' => $this->head('fields.columns.general.id'),
            'name' => $this->head('fields.columns.permission.name'),
            'is_default' => $this->head('fields.columns.permission.is_default'),
        ];

        $this->bindHeaders();
    }

    public function asArray($item): array
    {
        $result = [];

        foreach ($this->headers as $attribute => $header) {
            $value = match ($attribute) {
                'id', 'name', 'is_default' => $item->$attribute,
                default => translation($item->title, $attribute),
            };

            $result[$header] = $value;
        }

        return $result;
    }
}
