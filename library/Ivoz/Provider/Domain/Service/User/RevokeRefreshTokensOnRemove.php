<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\User\UserInterface;

class RevokeRefreshTokensOnRemove implements UserLifecycleEventHandlerInterface
{
    public const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private RefreshTokenRevokerInterface $refreshTokenRevoker
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY,
        ];
    }

    public function execute(UserInterface $user): void
    {
        $email = $user->getEmail();
        if (!$email) {
            return;
        }

        $this->refreshTokenRevoker->revokeByUsername($email);
    }
}
