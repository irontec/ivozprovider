<?php

namespace Ivoz\Cgr\Domain\Service\TpCdrStat;

use Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStat;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierLifecycleEventHandlerInterface;

class CreateByCarrier implements CarrierLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(CarrierInterface $carrier)
    {
        $isNew = $carrier->isNew();
        if (!$isNew) {
            return;
        }

        $brand = $carrier->getBrand();

        $metrics = [ 'ACD', 'ASR'];

        foreach ($metrics as $metric) {
            // Create a new metric TpCdrStat when Carrier is created
            $CdrStatDto = TpCdrStat::createDTO();
            $CdrStatDto
                ->setTpid($brand->getCgrTenant())
                ->setCarrierId($carrier->getId())
                ->setTag($carrier->getCgrSubject())
                ->setSubjects($carrier->getCgrSubject())
                ->setMetrics($metric);

            $this->entityTools->persistDto($CdrStatDto);
        }
    }
}
