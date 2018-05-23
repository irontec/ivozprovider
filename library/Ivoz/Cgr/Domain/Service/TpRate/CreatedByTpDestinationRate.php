<?php

namespace Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRate;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateDto;
use Ivoz\Cgr\Domain\Service\TpDestinationRate\TpDestinationRateLifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;

class CreatedByTpDestinationRate implements TpDestinationRateLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * CreatedByTpDestinationRate constructor.
     * @param EntityPersisterInterface $entityPersister
     */
    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 30
        ];
    }

    public function execute(TpDestinationRateInterface $entity)
    {
        // Replicate Terminal into ast_ps_endpoint
        /**
         * @var TpDestinationRateInterface $rate
         */
        $rate = $entity->getTpRate();

        if (is_null($rate)) {
            $rateDto = new TpRateDto();
        } else {
            $rateDto = $rate->toDto();
        }

        // Update/Insert endpoint data
        $rateDto
            ->setTag($entity->getRatesTag())
            ->setTpDestinationRateId($entity->getId())
            ->setConnectFee($entity->getRate()->getConnectFee())
            ->setRateCost($entity->getRate()->getCost())
            ->setRateIncrement($entity->getRate()->getRateIncrement())
            ->setGroupIntervalStart($entity->getRate()->getGroupIntervalStart());

        $rate = $this->entityPersister
                    ->persistDto(
                        $rateDto,
                        $rate,
                        true
                    );

        $entity->setTpRate($rate);

    }

}
