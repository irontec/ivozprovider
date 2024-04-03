<?php

namespace Ivoz\Provider\Infrastructure\Api\Jwt;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\Administrator\AdministratorImpersonationChecker;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function __construct(
        private AdministratorImpersonationChecker $administratorImpersonationChecker
    ) {
    }

    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $payload = $event->getData();
        /** @var AdministratorInterface | UserInterface $user */
        $user = $event->getUser();
        $payload['iden'] = (string) $user;

        $event->setData($payload);

        /** @var string|null $onBehalOfUsername */
        $onBehalOfUsername = $payload['onBehalOfUsername'] ?? null;
        if ($onBehalOfUsername === null) {
            return;
        }

        $this->administratorImpersonationChecker->execute($onBehalOfUsername);
    }
}
