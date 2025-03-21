<?php

namespace Ivoz\Ast\Domain\Service\PsIdentify;

use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentify;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Service\RetailAccount\RetailAccountLifecycleEventHandlerInterface;

class UpdateByRetailAccount implements RetailAccountLifecycleEventHandlerInterface
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
     * @param RetailAccountInterface $retailAccount
     * @return void
     */
    public function execute(RetailAccountInterface $retailAccount)
    {
        $identify = $retailAccount->getPsIdentify();

        /** @var PsIdentifyDto $identifyDto */
        $identifyDto = is_null($identify)
            ? PsIdentify::createDto()
            : $this->entityTools->entityToDto($identify);

        // Get sorcery identifier
        $sorceryId = $retailAccount->getSorcery();

        // Insert Identify data
        $identifyDto
            ->setSorceryId($sorceryId)
            ->setEndpoint($sorceryId)
            ->setMatchHeader($sorceryId)
            ->setRetailAccountId($retailAccount->getId());

        /** @var PsIdentifyInterface $identify */
        $identify = $this->entityTools
            ->persistDto($identifyDto, $identify);

        $retailAccount->setPsIdentify($identify);
    }
}
