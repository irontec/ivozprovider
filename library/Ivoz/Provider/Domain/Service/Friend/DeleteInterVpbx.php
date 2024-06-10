<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Ivoz\Provider\Domain\Service\Friend\FriendLifecycleEventHandlerInterface;

class DeleteInterVpbx implements FriendLifecycleEventHandlerInterface
{
    public const POST_REMOVE = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
        private FriendRepository $friendRepository,
    ) {
    }

    /**
     * @inheritDoc
     * @return array<string,int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => self::POST_REMOVE,
        ];
    }

    public function execute(FriendInterface $friend): void
    {
        if (!$friend->isInterPbxConnectivity()) {
            return;
        }

        $interCompanyId = $friend->getInterCompany()?->getId() ?? -1;
        $companyId = $friend->getCompany()->getId() ?? -1;

        if ($interCompanyId === -1 || $companyId === -1) {
            return;
        }

        $relatedFriends = $this->friendRepository->findByCompanyAndInterCompany(
            $interCompanyId,
            $companyId
        );

        if (count($relatedFriends) !== 1) {
            return;
        }

        $relatedFriend = array_pop($relatedFriends);

        if ($friend->getName() !== $relatedFriend->getName()) {
            return;
        }

        if ($relatedFriend->hasBeenDeleted()) {
            return;
        }

        $this->entityTools->remove($relatedFriend);
    }
}
