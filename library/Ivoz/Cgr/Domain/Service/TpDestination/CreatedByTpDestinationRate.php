<?php

namespace Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto;
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
            self::EVENT_POST_PERSIST => 20
        ];
    }

    public function execute(TpDestinationRateInterface $entity)
    {
        // Replicate Terminal into ast_ps_endpoint
        /**
         * @var TpDestinationInterface $destination
         */
        $destination = $entity->getTpDestination();

        if (is_null($destination)) {
            $destinationDto = new TpDestinationDto();
        } else {
            $destinationDto = $destination->toDto();
        }

        // Update/Insert endpoint data
        $destinationDto
            ->setTag($entity->getDestinationsTag())
            ->setTpDestinationRateId($entity->getId())
            ->setPrefix($entity->getDestination()->getPrefix());

        $destination = $this
                        ->entityPersister
                        ->persistDto(
                            $destinationDto,
                            $destination,
                            true
                        );

        $entity->setTpDestination($destination);
    }

}
