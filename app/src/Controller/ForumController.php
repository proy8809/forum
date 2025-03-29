<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class ForumController extends AbstractController
{
    #[Route('/forum', name: 'forum_index')]
    #[IsGranted("ROLE_USER")]
    public function index(): Response
    {
        return $this->render('forum/index.html.twig');
    }
}
