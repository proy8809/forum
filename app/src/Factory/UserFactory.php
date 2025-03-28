<?php

namespace App\Factory;

use App\Entity\User;
use App\Enum\Role;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function makeUser(string $username, string $firstName, string $lastName, string $password): User
    {
        $user = new User();

        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);

        $user->setUsername($username);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setPassword($hashedPassword);
        $user->setRoles([Role::User->value]);

        return $user;
    }
}