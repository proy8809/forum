<?php

namespace App\Twig\Components;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;

#[AsLiveComponent]
final class LoginForm
{
    use DefaultActionTrait;
    use ValidatableComponentTrait;

    #[LiveProp(writable: true)]
    public string $username = "";

    #[LiveProp(writable: true)]
    public string $password = "";

    #[LiveAction]
    public function submit(): RedirectResponse
    {
        dd($this->username, $this->password);
    }

}
