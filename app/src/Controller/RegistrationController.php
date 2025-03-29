<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration_index')]
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('forum_index');
        }

        return $this->render('registration/index.html.twig');
    }
}
