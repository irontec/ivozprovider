<?php

namespace Ivoz\Ast\Domain\Service\QueueMember;

use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\Extension\ExtensionLifecycleEventHandlerInterface;

class UpdateByExtension implements ExtensionLifecycleEventHandlerInterface
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

    public function execute(ExtensionInterface $extension): void
    {
        if (!$extension->hasChanged('number')) {
            return;
        }

        $user = $this->userRepository->findOneByExtensionId(
            (int) $extension->getId()
        );

        if (!$user) {
            return;
        }

        $this->updateFromUser->execute($user);
    }
}
