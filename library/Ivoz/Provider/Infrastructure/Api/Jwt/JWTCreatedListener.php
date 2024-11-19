<?php

namespace Ivoz\Provider\Infrastructure\Api\Jwt;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\Administrator\AssertAdministratorCanImpersonate;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function __construct(
        private AssertAdministratorCanImpersonate $administratorImpersonationChecker
    ) {
    }

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $payload = $event->getData();
        /** @var AdministratorInterface | UserInterface $user */
        $user = $event->getUser();
        $payload['id'] = $user->getId();
        $payload['iden'] = (string) $user;

        $event->setData($payload);

        /** @var array<int>|null $onBehalfOfIds */
        $onBehalfOfIds = $payload['onBehalfOfIds'] ?? null;
        if (empty($onBehalfOfIds)) {
            return;
        }

        $this
            ->administratorImpersonationChecker
            ->execute(
                end($onBehalfOfIds),
                $user
            )
        ;
    }
}
