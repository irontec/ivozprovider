<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CallHistoryAction
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var UsersCdrRepository
     */
    protected $usersCdrRepository;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    public function __construct (
        TokenStorage $tokenStorage,
        UsersCdrRepository $usersCdrRepository,
        RequestStack $requestStack
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->usersCdrRepository = $usersCdrRepository;
        $this->requestStack = $requestStack;
    }

    public function __invoke()
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        $user = $token->getUser();

        return $this
            ->usersCdrRepository
            ->findBy(['user' => $user->getId()]);
    }
}