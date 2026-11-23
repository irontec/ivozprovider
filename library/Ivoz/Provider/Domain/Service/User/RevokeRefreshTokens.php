<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Provider\Domain\Model\User\UserInterface;

class RevokeRefreshTokens implements UserLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

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
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY,
        ];
    }

    public function execute(UserInterface $user): void
    {
        if ($user->isNew()) {
            return;
        }

        $hasBeenDisabled = !$user->getActive() && $user->hasChanged('active');
        $hasNewCredentials = $user->hasChanged('pass') || $user->hasChanged('email');
        if (!$hasBeenDisabled && !$hasNewCredentials) {
            return;
        }

        /** @var string|null $previousEmail */
        $previousEmail = $user->getInitialValue('email');
        if (!$previousEmail) {
            return;
        }

        $this->refreshTokenRevoker->revokeByUsername($previousEmail);
    }
}
