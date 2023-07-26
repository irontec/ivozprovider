<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
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

        $admin = $token->getUser();
        if (!$admin instanceof AdministratorInterface) {
            throw new \Exception('User must implement AdministratorInterface', 403);
        }

        return $this->getDashboard->execute(
            $admin
        );
    }
}
