<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CompanyAssistantsAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private UserRepository $userRepository
    ) {
    }

    public function __invoke()
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var UserInterface $user */
        $user = $token->getUser();

        return $this
            ->userRepository
            ->getUserAssistantCandidates($user);
    }
}
