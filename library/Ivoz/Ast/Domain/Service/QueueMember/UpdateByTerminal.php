<?php

namespace Ivoz\Ast\Domain\Service\QueueMember;

use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\Terminal\TerminalLifecycleEventHandlerInterface;

class UpdateByTerminal implements TerminalLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private UserRepository $userRepository,
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

    public function execute(TerminalInterface $terminal): void
    {
        if (!$terminal->hasChanged('name')) {
            return;
        }

        $user = $this->userRepository->findOneByTerminalId(
            (int) $terminal->getId()
        );

        if (!$user) {
            return;
        }

        $this->updateFromUser->execute($user);
    }
}
