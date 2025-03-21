<?php

namespace Ivoz\Ast\Domain\Service\PsIdentify;

use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentify;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
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
        $identify = $friend->getPsIdentify();

        /** @var PsIdentifyDto $identifyDto */
        $identifyDto = is_null($identify)
            ? PsIdentify::createDto()
            : $this->entityTools->entityToDto($identify);

        // Get sorcery identifier
        $sorceryId = $friend->getSorcery();

        // Insert Identify data
        $identifyDto
            ->setSorceryId($sorceryId)
            ->setEndpoint($sorceryId)
            ->setMatchHeader($sorceryId)
            ->setFriendId($friend->getId());

        /** @var PsIdentifyInterface $identify */
        $identify = $this->entityTools
            ->persistDto($identifyDto, $identify);

        $friend->setPsIdentify($identify);
    }
}
