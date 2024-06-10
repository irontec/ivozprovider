<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;

class SanitizeInterVpbxPriority implements FriendLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
        private FriendRepository $friendRepository,
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    public function execute(FriendInterface $friend): void
    {
        if (!$friend->isNew()) {
            return;
        }

        $maxPriority = $this->friendRepository->getMaxPriorityForCompany(
            $friend->getCompany()->getId() ?? 0
        );

        /** @var FriendDto $friendDto */
        $friendDto = $this->entityTools->entityToDto($friend);
        $friendDto->setPriority(
            $maxPriority + 1
        );

        $this->entityTools->updateEntityByDto(
            $friend,
            $friendDto
        );
    }
}
