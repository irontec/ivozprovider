<?php

namespace Ivoz\Ast\Domain\Service\PsIdentify;

use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Service\RetailAccount\RetailAccountLifecycleEventHandlerInterface;

class UpdateByRetailAccount implements RetailAccountLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * UpdateByFriend constructor.
     * @param EntityTools $entityTools
     */
    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::PRIORITY_NORMAL
        ];
    }

    /**
     * @param RetailAccountInterface $retailAccount
     * @return void
     */
    public function execute(RetailAccountInterface $retailAccount)
    {
        $isNew = $retailAccount->isNew();
        if (!$isNew) {
            return;
        }

        // Get sorcery identifier
        $sorceryId = $retailAccount->getSorcery();

        // Insert Identify data
        $identifyDto = new PsIdentifyDto();
        $identifyDto
            ->setSorceryId($sorceryId)
            ->setEndpoint($sorceryId)
            ->setMatchHeader($sorceryId)
            ->setRetailAccountId($retailAccount->getId());

        $this->entityTools
            ->persistDto($identifyDto);
    }
}
