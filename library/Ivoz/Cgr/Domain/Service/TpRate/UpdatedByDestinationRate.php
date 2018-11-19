<?php

namespace Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Cgr\Domain\Model\TpRate\TpRate;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Provider\Domain\Service\DestinationRate\DestinationRateLifecycleEventHandlerInterface;

class UpdatedByDestinationRate implements DestinationRateLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * CreatedByTpDestinationRate constructor.
     * @param EntityTools $entityTools
     */
    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    /**
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * Create a new TpDestinationRate when a DestinationRate is created
     *
     * @param DestinationRateInterface $destinationRate
     */
    public function execute(DestinationRateInterface $destinationRate)
    {
        $brand = $destinationRate->getDestinationRateGroup()->getBrand();
        $tpRate = $destinationRate->getTpRate();

        /** @var TpRateDto $tpRateDto */
        $tpRateDto = is_null($tpRate)
            ? TpRate::createDto()
            : $this->entityTools->entityToDto($tpRate);

        $tpRateDto
            ->setTpid($brand->getCgrTenant())
            ->setDestinationRateId($destinationRate->getId())
            ->setTag($destinationRate->getCgrRatesTag())
            ->setConnectFee($destinationRate->getConnectFee())
            ->setRateCost($destinationRate->getCost())
            ->setRateIncrement($destinationRate->getRateIncrement())
            ->setGroupIntervalStart($destinationRate->getGroupIntervalStart());

        $tpRate = $this->entityTools->persistDto(
            $tpRateDto,
            $tpRate,
            true
        );

        $destinationRate
            ->setTpRate($tpRate);

        $this->entityTools
            ->persist($destinationRate);
    }
}
