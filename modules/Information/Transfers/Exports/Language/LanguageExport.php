<?php

namespace Modules\Information\Transfers\Exports\Language;

use App\Contracts\Abstracts\Export\AbstractExport;
use App\Contracts\Interfaces\Export\Exportable;
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
        parent::__construct($model);

        $this->languageRepository = new LanguageRepository();
    }

    /**
     * @throws IOException
     * @throws WriterNotOpenedException
     * @throws UnsupportedTypeException
     * @throws InvalidArgumentException
     */
    public function export(): string
    {
        $collection = $this->languageRepository->all();

        $excel = new FastExcel($this->generator($collection));

        $excel->export($this->path, function ($language) {
            return $this->asArray($language);
        });

        return $this->publicPath();
    }

    protected function headers(): void
    {
        $this->headers = [
            'id' => $this->getHeader('fields.columns.general.id'),
            'slug' => $this->getHeader('fields.columns.language.slug'),
            'title' => $this->getHeader('fields.columns.language.title'),
        ];
    }

    protected function asArray($item): array
    {
        $result = [];

        foreach ($this->headers as $attribute => $header) {
            $value = $item->$attribute;

            $result[$header] = $value;
        }

        return $result;
    }
}
