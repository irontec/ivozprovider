<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Model\LastMonthCalls;
use Service\Domain\GetLastMonthCalls;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LastMonthCallsAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private GetLastMonthCalls $getLastMonthCalls
    ) {
    }

    public function __invoke(): LastMonthCalls
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var UserInterface $user */
        $user = $token->getUser();

        return $this->getLastMonthCalls->execute($user);
    }
}
