<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineEntityPersister;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Serializer\Serializer;

class PutProfileAction
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var DoctrineEntityPersister
     */
    protected $entityPersister;

    /**
     * PutProfileAction constructor.
     * @param TokenStorage $tokenStorage
     * @param Serializer $serializer
     * @param RequestStack $requestStack
     * @param DoctrineEntityPersister $entityPersister
     */
    public function __construct (
        TokenStorage $tokenStorage,
        Serializer $serializer,
        RequestStack $requestStack,
        DoctrineEntityPersister $entityPersister
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->serializer = $serializer;
        $this->requestStack = $requestStack;
        $this->entityPersister = $entityPersister;
    }

    public function __invoke()
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        $user = $token->getUser();
        $request = $this->requestStack->getCurrentRequest();

        $updatedUser = $this->serializer->deserialize(
            $request->getContent(),
            get_class($user),
            $request->getRequestFormat(),
            [
                'object_to_populate' => $user,
                'operation_normalization_context' => 'myProfile'
            ]
        );

        $this->entityPersister->persist($updatedUser);
        return $user;
    }
}