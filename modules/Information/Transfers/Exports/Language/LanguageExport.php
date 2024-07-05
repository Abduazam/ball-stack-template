<?php

namespace Modules\Information\Transfers\Exports\Language;

use App\Contracts\Abstracts\Export\AbstractExport;
use App\Contracts\Interfaces\Export\Exportable;
use Generator;
use Modules\Information\App\Repositories\Language\LanguageRepository;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

final class LanguageExport extends AbstractExport implements Exportable
{
    protected LanguageRepository $languageRepository;

    public function __construct(string $model)
    {
        $this->languageRepository = new LanguageRepository();

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

        $excel->export($this->path, function ($language) {
            return $this->asArray($language);
        });

        return $this->path();
    }

    public function collection(): Generator
    {
        $collection = $this->languageRepository->all();

        return $this->generator($collection);
    }

    public function headers(): void
    {
        $this->headers = [
            'id' => $this->head('fields.columns.general.id'),
            'slug' => $this->head('fields.columns.language.slug'),
            'title' => $this->head('fields.columns.language.title'),
        ];
    }

    public function asArray($item): array
    {
        $result = [];

        foreach ($this->headers as $attribute => $header) {
            $value = $item->$attribute;

            $result[$header] = $value;
        }

        return $result;
    }
}
