<?php

namespace Controller\My;

use Ivoz\Provider\Application\Service\ActiveCall\RegistrationChannelResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;

class ActiveCallsRealtimeFilterAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private RegistrationChannelResolver $registrationChannelResolver
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $token = $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var Administrator $user */
        $user = $token->getUser();

        /** @var array{username: string, roles: array<int, string>} $tokenPayload */
        $tokenPayload = [
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ];

        $criteria = $this
            ->registrationChannelResolver
            ->execute(
                null,
                $tokenPayload
            );

        return new Response(
            (string) json_encode(
                [
                    'criteria' => $criteria
                ]
            ),
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );
    }
}
