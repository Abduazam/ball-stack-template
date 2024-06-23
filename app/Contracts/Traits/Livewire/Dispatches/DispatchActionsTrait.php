<?php

namespace App\Contracts\Traits\Livewire\Dispatches;

use Illuminate\Validation\ValidationException;
use PHPUnit\Event\Code\Throwable;

trait DispatchActionsTrait
{
    private function compare(Throwable|int|bool $response): bool
    {
        return is_numeric($response) || is_bool($response);
    }

    private function error($response): void
    {
        $this->dispatchFlash('dispatch-error', $this->getErrorMessageFormatted($response));
    }

    private function flash(string $action, string $model): void
    {
        $this->dispatchFlash('dispatch-success', $this->getSuccessMessageFormatted($action, $model));
    }

    private function redirecting(string $return): void
    {
        redirect()->route($return);
    }

    private function mounting(): void
    {
        if (method_exists($this, 'mount')) {
            $this->mount();
        }
    }

    private function actAsCreate(string $action): void
    {
        if ($action === 'create') {
            $this->dispatch('created');

            $this->form->reset();

            $this->mounting();
        }
    }

    private function actAsUpdate(string $action): void
    {
        if ($action === 'update') {
            $this->dispatch('updated');

            $this->mounting();
        }
    }

    private function actAsImport(string $action): void
    {
        if ($action === 'import') {
            $this->dispatch('refresh');

            $this->form->reset();

            $this->reset('batchId', 'importing', 'importFinished');

            $this->mounting();
        }
    }

    private function getErrorMessageFormatted($exception): string
    {
        if ($exception instanceof ValidationException) {
            $messages = $exception->validator->errors()->all();
        } else {
            $messages = [$exception->getMessage()];
        }

        $formattedMessage = '';
        foreach ($messages as $key => $message) {
            $formattedMessage .= ($key + 1) . '. ' . $message . "<br>";
        }

        return $formattedMessage;
    }

    private function getSuccessMessageFormatted(string $action, string $model): string
    {
        $key = 'messages.actions.successes.' . $action;

        $model = trans($model);

        return trans($key, ['model' => $model]);
    }

    private function getAction(): string
    {
        return strtolower(class_basename($this));
    }
}
