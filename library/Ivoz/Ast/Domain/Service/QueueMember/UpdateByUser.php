<?php

namespace Ivoz\Ast\Domain\Service\QueueMember;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

class UpdateByUser implements UserLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private UpdateFromUser $updateFromUser,
    ) {
    }

    /** @return array<array-key, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(UserInterface $user): void
    {
        if (
            !$user->hasChanged('name')
            && !$user->hasChanged('lastname')
            && !$user->hasChanged('terminalId')
            && !$user->hasChanged('extensionId')
        ) {
            return;
        }

        $this->updateFromUser->execute($user);
    }
}
