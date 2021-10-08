<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PostCallForwardSettingsAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private DenormalizerInterface $denormalizer,
        private RequestStack $requestStack
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
        $request = $this->requestStack->getCurrentRequest();

        /** @phpstan-ignore-next-line */
        $data = $this->denormalizer->decode(
            $request->getContent(),
            $request->getRequestFormat(),
            []
        );
        $data['user'] = $user->getid();

        return $this->denormalizer->denormalize(
            $data,
            CallForwardSetting::class,
            $request->getRequestFormat(),
            []
        );
    }
}
