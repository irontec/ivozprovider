<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ProfileAction
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    public function __construct (
        TokenStorage $tokenStorage
    ) {
        $this->tokenStorage = $tokenStorage;
    }

    public function __invoke()
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        return $token->getUser();
    }
}