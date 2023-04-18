<?php

namespace Ivoz\Ast\Domain\Service\QueueMember;

use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;
use Ivoz\Provider\Domain\Service\QueueMember\QueueMemberLifecycleEventHandlerInterface;

class UpdateByIvozQueueMember implements QueueMemberLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private UpdateFromQueueMember $updateFromQueueMember,
    ) {
    }

    /** @return array<array-key, int> */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(QueueMemberInterface $queueMember): void
    {
        $this->updateFromQueueMember->execute($queueMember);
    }
}
