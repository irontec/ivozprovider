<?php

namespace Ivoz\Cgr\Domain\Service\TpCdrStat;

use Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStat;
use Ivoz\Core\Application\Service\EntityTools;
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
