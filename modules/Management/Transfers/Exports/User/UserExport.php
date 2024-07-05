<?php

namespace Modules\Management\Transfers\Exports\User;

use App\Contracts\Abstracts\Export\AbstractExport;
use App\Contracts\Interfaces\Export\Exportable;
use Generator;
use Modules\Management\App\Repositories\User\UserRepository;
use Modules\Management\Transfers\Exports\User\Traits\DecoderMethods;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

final class UserExport extends AbstractExport implements Exportable
{
    use DecoderMethods;

    public UserRepository $userRepository;

    public function __construct(string $model)
    {
        $this->userRepository = new UserRepository();

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

        $excel->export($this->path, function ($user) {
            return $this->asArray($user);
        });

        return $this->path();
    }

    public function collection(): Generator
    {
        $collection = $this->userRepository->all();

        return $this->generator($collection);
    }

    public function headers(): void
    {
        $this->headers = [
            'id' => $this->head('fields.columns.general.id'),
            'name' => $this->head('fields.columns.user.name'),
            'email' => $this->head('fields.columns.user.email'),
            'password' => $this->head('fields.columns.user.password'),
            'role' => $this->head('fields.columns.user.role'),
        ];
    }

    public function asArray($item): array
    {
        $result = [];

        foreach ($this->headers as $attribute => $header) {
            $value = match ($attribute) {
                'password' => $this->password(),
                'role' => $this->role($item),
                default => $item->$attribute
            };

            $result[$header] = $value;
        }

        return $result;
    }
}
