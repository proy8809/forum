<?php

namespace App\EventListener;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;

final class RedirectToForumIndexListener
{
    private const REDIRECTED_ROUTES = ["registration_index", "login_index"];
    private const FORUM_INDEX_ROUTE_NAME = "forum_index";

    public function __construct(
        private readonly RouterInterface $router,
        private readonly Security $security
    ) {
    }

    #[AsEventListener(event: KernelEvents::REQUEST)]
    public function __invoke(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $requestedRoute = $event->getRequest()->attributes->get('_route');

        if (in_array($requestedRoute, self::REDIRECTED_ROUTES) && $this->security->getUser()) {
            $redirectTo = $this->router->generate(self::FORUM_INDEX_ROUTE_NAME);
            $event->setResponse(new RedirectResponse($redirectTo));
        }
    }
}
