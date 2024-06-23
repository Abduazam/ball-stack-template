<?php

namespace Modules\Management\Transfers\Exports\User;

use App\Contracts\Abstracts\Export\AbstractExport;
use App\Contracts\Interfaces\Export\Exportable;
use Modules\Management\App\Repositories\User\UserRepository;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

final class UserExport extends AbstractExport implements Exportable
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
            return $this->asArray($user);
        });

        return $this->publicPath();
    }

    protected function headers(): void
    {
        $this->headers = [
            'id' => $this->getHeader('fields.columns.general.id'),
            'name' => $this->getHeader('fields.columns.user.name'),
            'email' => $this->getHeader('fields.columns.user.email'),
            'password' => $this->getHeader('fields.columns.user.password'),
            'role' => $this->getHeader('fields.columns.user.role'),
        ];
    }

    protected function asArray($item): array
    {
        $result = [];

        foreach ($this->headers as $attribute => $header) {
            $value = match ($attribute) {
                'password' => null,
                'role' => $item->roles?->first()?->name,
                default => $item->$attribute
            };

            $result[$header] = $value;
        }

        return $result;
    }
}
