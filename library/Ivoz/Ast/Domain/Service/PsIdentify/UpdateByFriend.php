<?php

namespace Ivoz\Ast\Domain\Service\PsIdentify;

use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Service\Friend\FriendLifecycleEventHandlerInterface;

class UpdateByFriend implements FriendLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::PRIORITY_NORMAL
        ];
    }

    /**
     * @param FriendInterface $friend
     * @return void
     */
    public function execute(FriendInterface $friend)
    {
        $isNew = $friend->isNew();
        if (!$isNew) {
            return;
        }

        // Get sorcery identifier
        $sorceryId = $friend->getSorcery();

        // Insert Identify data
        $identifyDto = new PsIdentifyDto();
        $identifyDto
            ->setSorceryId($sorceryId)
            ->setEndpoint($sorceryId)
            ->setMatchHeader($sorceryId)
            ->setFriendId($friend->getId());

        $this->entityTools
            ->persistDto($identifyDto);
    }
}
