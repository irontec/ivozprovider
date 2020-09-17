<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PutProfileAction
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * PutProfileAction constructor.
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        SerializerInterface $serializer,
        RequestStack $requestStack
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->serializer = $serializer;
        $this->requestStack = $requestStack;
    }

    public function __invoke()
    {
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
