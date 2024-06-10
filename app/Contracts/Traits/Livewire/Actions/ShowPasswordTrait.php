<?php

namespace App\Contracts\Traits\Livewire\Actions;

trait ShowPasswordTrait
{
    public string $passwordInputType = 'password';
    public int $passwordInputShowButtonOpacity = 0;
    public string $passwordInputEyeIcon = 'fa fa-eye';

    public function showPassword(): void
    {
        $this->passwordInputType = $this->passwordInputType === 'password' ? 'text' : 'password';
        $this->passwordInputEyeIcon = $this->passwordInputEyeIcon === 'fa fa-eye' ? 'fa fa-eye-slash' : 'fa fa-eye';
    }

    public function showEyeButton(): void
    {
        $this->passwordInputShowButtonOpacity = 75;
    }
}
