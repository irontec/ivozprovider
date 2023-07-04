<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Model\Dashboard\Dashboard;
use Service\Application\Dashboard\GetDashboard;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DashboardAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private GetDashboard $getDashboard
    ) {
    }

    public function __invoke(Request $request): Dashboard
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        return $this->getDashboard->execute();
    }
}
