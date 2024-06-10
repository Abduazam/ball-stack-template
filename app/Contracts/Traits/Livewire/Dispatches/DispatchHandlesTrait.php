<?php

namespace App\Contracts\Traits\Livewire\Dispatches;

use App\Contracts\Classes\Livewire\ModelTranslation;
use App\Contracts\Classes\Livewire\Redirect;
use Throwable;

trait DispatchHandlesTrait
{
    public function handleResponse(Throwable|int|bool $response, string $model, string $type = 'modal'): void
    {
        if ($response instanceof Throwable) {
            $this->error($response);
        } else {
            if ($type === 'modal') {
                $this->modalDispatchResponse($response, $this->getModel($model));
            }

            if ($type === 'view') {
                $this->viewDispatchResponse($response, $this->getModel($model), $this->getRedirect($model));
            }
        }
    }

    public function getModel(string $key): string
    {
        return (new ModelTranslation)->take($key);
    }

    public function getRedirect(string $key): string
    {
        return (new Redirect)->take($key);
    }
}
