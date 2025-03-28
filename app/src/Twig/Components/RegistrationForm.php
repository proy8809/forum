<?php

namespace App\Twig\Components;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class RegistrationForm
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $username = "";

    #[LiveProp(writable: true)]
    public string $firstName = "";

    #[LiveProp(writable: true)]
    public string $lastName = "";

    #[LiveProp(writable: true)]
    public string $password = "";

    #[LiveProp(writable: true)]
    public string $passwordConfirmation = "";

    #[LiveAction]
    public function submit(): void {

    }
}
