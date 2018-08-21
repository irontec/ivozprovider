<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
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
     * PutProfileAction constructor.
     * @param TokenStorage $tokenStorage
     * @param Serializer $serializer
     * @param RequestStack $requestStack
     */
    public function __construct (
        TokenStorage $tokenStorage,
        Serializer $serializer,
        RequestStack $requestStack
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->serializer = $serializer;
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
        $request = $this->requestStack->getCurrentRequest();

        $data = $this->serializer->decode(
            $request->getContent(),
            $request->getRequestFormat(),
            []
        );

        if (!isset($data['oldPass'])) {
            // We cannot set this at domain level because klear doesn't send oldPass
            unset($data['pass']);
        }

        return $this->serializer->denormalize(
            $data,
            get_class($user),
            $request->getRequestFormat(),
            [
                'object_to_populate' => $user,
                'operation_normalization_context' => 'updateMyProfile'
            ]
        );
    }
}