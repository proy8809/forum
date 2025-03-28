<?php

namespace App\Twig\Components;

use App\Factory\UserFactory;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;

#[AsLiveComponent]
final class RegistrationForm extends AbstractController
{
    use DefaultActionTrait;
    use ValidatableComponentTrait;

    #[LiveProp(writable: true)]
    #[Assert\Length(min: 8, minMessage: "Username must be at least 8 characters long")]
    public string $username = "";

    #[LiveProp(writable: true)]
    #[Assert\NotBlank(message: "First name can't be empty")]
    public string $firstName = "";

    #[LiveProp(writable: true)]
    #[Assert\NotBlank(message: "Last name can't be empty")]
    public string $lastName = "";

    #[LiveProp(writable: true)]
    #[Assert\Length(min: 8, minMessage: "Password must be at least 8 characters long")]
    public string $password = "";

    #[LiveProp(writable: true)]
    #[Assert\IdenticalTo(propertyPath: "password", message: "Passwords don't match")]
    public string $passwordConfirmation = "";

    public function __construct(
        private readonly UserFactory $userFactory,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function getIsRegisterButtonDisabled(): bool
    {
        return !empty($this->getValidator()->validate($this));
    }

    #[LiveAction]
    public function submit(): RedirectResponse {
        $this->validate();

        $userEntity = $this->userFactory->makeUser(
            $this->username,
            $this->firstName,
            $this->lastName,
            $this->password
        );

        $this->userRepository->persist($userEntity);

        $this->addFlash("success", "Registration complete!");
        return $this->redirectToRoute("login_index");
    }
}
