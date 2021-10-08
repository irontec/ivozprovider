<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PutProfileAction
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

        $user = $token->getUser();
        $request = $this->requestStack->getCurrentRequest();

        /** @phpstan-ignore-next-line  */
        $data = $this->denormalizer->decode(
            $request->getContent(),
            $request->getRequestFormat(),
            []
        );

        if (!isset($data['oldPass'])) {
            // We cannot set this at domain level because klear doesn't send oldPass
            unset($data['pass']);
        }

        return $this->denormalizer->denormalize(
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
