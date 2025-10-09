<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PutProfileAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private DenormalizerInterface $denormalizer
    ) {
    }

    public function __invoke(Request $request)
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token) {
            throw new ResourceClassNotFoundException('User not found');
        }

        $user = $token->getUser();
        if (!$user) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @phpstan-ignore-next-line  */
        $data = $this->denormalizer->decode(
            $request->getContent(),
            $request->getRequestFormat(),
            []
        );

        if (isset($data['pass']) && !isset($data['oldPass'])) {
            throw new BadRequestHttpException('oldPass is required when changing password');
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
