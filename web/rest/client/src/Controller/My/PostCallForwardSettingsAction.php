<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Serializer\Serializer;

class PostCallForwardSettingsAction
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
    public function __construct(
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
        $data['user'] = $user->getid();

        return $this->serializer->denormalize(
            $data,
            CallForwardSetting::class,
            $request->getRequestFormat(),
            []
        );
    }
}
