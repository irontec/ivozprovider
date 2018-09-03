<?php

namespace Ivoz\Cgr\Domain\Service\TpCdrStat;

use Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStat;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierLifecycleEventHandlerInterface;

class CreateByCarrier implements CarrierLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * CreateByCarrier constructor.
     *
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
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(CarrierInterface $carrier, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /** @var CarrierDto $carrierDto */
        $carrierDto = $this->entityTools->entityToDto($carrier);

        // Create a new ACD TpCdrStat when Carrier is created
        $CdrStatDto = TpCdrStat::createDTO();
        $CdrStatDto
            ->setCarrierId($carrierDto->getId())
            ->setTag(sprintf("cr%d", $carrierDto->getId()))
            ->setSubjects(sprintf("cr%d", $carrierDto->getId()))
            ->setMetrics("ACD");

        $this->entityTools->persistDto($CdrStatDto, null);

        // Create a new ASR TpCdrStat when Carrier is created
        $CdrStatDto = TpCdrStat::createDTO();
        $CdrStatDto
            ->setCarrierId($carrierDto->getId())
            ->setTag(sprintf("cr%d", $carrierDto->getId()))
            ->setSubjects(sprintf("cr%d", $carrierDto->getId()))
            ->setMetrics("ASR");

        $this->entityTools->persistDto($CdrStatDto, null);
    }
}
