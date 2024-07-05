<?php

namespace App\Contracts\Traits\Livewire\Dispatches;

trait Dispatchable
{
    use DispatchActionsTrait, DispatchHandlesTrait;

    public bool $dispatching = false;

    public function dispatchTrue(): void
    {
        $this->dispatching = true;
    }

    public function dispatchFalse(): void
    {
        $this->dispatching = false;
    }

    public function dispatchFlash($dispatch, $message): void
    {
        $this->dispatch($dispatch, ['message' => $message]);
    }

    public function modalDispatchResponse($response, $model): void
    {
        $action = $this->getAction();

        if ($this->compare($response)) {
            $this->actAsCreate($action);

            $this->actAsUpdate($action);

            $this->dispatch('refresh');

            $this->flash($action, $model);
        } else {
            $this->error($response);
        }
    }

    public function viewDispatchResponse($response, $model, $return): void
    {
        $action = $this->getAction();

        if ($this->compare($response)) {
            if ($this->dispatching) {
                $this->actAsCreate($action);

                $this->actAsUpdate($action);

                $this->actAsImport($action);

                $this->flash($action, $model);
            } else {
                $this->redirecting($return);
            }
        } else {
            $this->error($response);
        }
    }
}
