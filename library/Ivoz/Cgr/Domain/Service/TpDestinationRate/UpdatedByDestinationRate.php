<?php

namespace Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRate;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateDto;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;
use Ivoz\Cgr\Domain\Service\TpRate\UpdatedByDestinationRate as TpRateUpdatedByDestinationRate;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Provider\Domain\Service\DestinationRate\DestinationRateLifecycleEventHandlerInterface;

class UpdatedByDestinationRate implements DestinationRateLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = TpRateUpdatedByDestinationRate::POST_PERSIST_PRIORITY + 1;

    /**
     * CreatedByTpDestinationRate constructor.
     * @param EntityTools $entityTools
     */
    public function __construct(
        private EntityTools $entityTools
    ) {
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
     *
     * @return void
     */
    public function execute(DestinationRateInterface $destinationRate)
    {
        $brand = $destinationRate->getDestinationRateGroup()->getBrand();
        $tpDestinationRate = $destinationRate->getTpDestinationRate();

        $roundingMethod = $destinationRate->getDestinationRateGroup()->getRoundingMethod();

        /** @var TpDestinationRateDto $tpDestinationRateDto */
        $tpDestinationRateDto = is_null($tpDestinationRate)
            ? TpDestinationRate::createDto()
            : $this->entityTools->entityToDto($tpDestinationRate);

        $tpDestinationRateDto
            ->setTpid($brand->getCgrTenant())
            ->setDestinationRateId($destinationRate->getId())
            ->setTag($destinationRate->getCgrTag())
            ->setDestinationsTag($destinationRate->getCgrDestinationsTag())
            ->setRoundingMethod($roundingMethod)
            ->setRatesTag($destinationRate->getCgrRatesTag());

        $tpDestinationRate = $this->entityTools->persistDto(
            $tpDestinationRateDto,
            $tpDestinationRate,
            true
        );

        /** @var DestinationRateDto $destinationRateDto */
        $destinationRateDto = $this
            ->entityTools
            ->entityToDto(
                $destinationRate
            );

        $destinationRateDto
            ->setTpDestinationRate($tpDestinationRateDto);

        $this
            ->entityTools
            ->persistDto(
                $destinationRateDto,
                $destinationRate
            );
    }
}
