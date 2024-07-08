<?php

namespace App\Handlers\Import\Traits;

trait ImportFileManager
{
    const FOLDER = 'imports';

    protected ?string $filepath = null;

    public function store(): static
    {
        $path = $this->dto->file->store(self::FOLDER);

        $this->filepath = $this->getFilepath($path);

        return $this;
    }

    public function getFilepath(string $path): string
    {
        return storage_path('app/' . $path);
    }
}
