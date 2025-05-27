<?php

namespace Ivoz\Ast\Domain\Service\PsIdentify;

use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentify;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Service\ResidentialDevice\ResidentialDeviceLifecycleEventHandlerInterface;

class UpdateByResidentialDevice implements ResidentialDeviceLifecycleEventHandlerInterface
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
     * @param ResidentialDeviceInterface $residentialDevice
     * @return void
     */
    public function execute(ResidentialDeviceInterface $residentialDevice)
    {
        $identify = $residentialDevice->getPsIdentify();

        /** @var PsIdentifyDto $identifyDto */
        $identifyDto = is_null($identify)
            ? PsIdentify::createDto()
            : $this->entityTools->entityToDto($identify);

        // Get sorcery identifier
        $sorceryId = $residentialDevice->getSorcery();

        // Insert Identify data
        $identifyDto
            ->setSorceryId($sorceryId)
            ->setEndpoint($sorceryId)
            ->setMatchHeader($sorceryId)
            ->setResidentialDeviceId($residentialDevice->getId());

        /** @var PsIdentifyInterface $identify */
        $identify = $this->entityTools
            ->persistDto($identifyDto, $identify);

        $residentialDevice->setPsIdentify($identify);
    }
}
