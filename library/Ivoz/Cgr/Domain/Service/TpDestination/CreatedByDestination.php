<?php

namespace Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Service\Destination\DestinationLifecycleEventHandlerInterface;

class CreatedByDestination implements DestinationLifecycleEventHandlerInterface
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

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * Create a new TpDestination when a Destination is created
     *
     * @param DestinationInterface $destination
     */
    public function execute(DestinationInterface $destination)
    {
        $isNew = $destination->isNew();
        if (!$isNew) {
            return;
        }

        $brand = $destination->getBrand();
        $tpDestination = $destination->getTpDestination();

        /** @var TpDestinationDto $tpDestinationDto */
        $tpDestinationDto = is_null($tpDestination)
            ? TpDestination::createDto()
            : $this->entityTools->entityToDto($tpDestination);

        $tpDestinationDto
            ->setTpid($brand->getCgrTenant())
            ->setPrefix($destination->getPrefix())
            ->setDestinationId($destination->getId())
            ->setTag($destination->getCgrTag());

        $tpDestination = $this->entityTools->persistDto(
            $tpDestinationDto,
            $tpDestination,
            true
        );

        $destination
            ->setTpDestination($tpDestination);

        $this->entityTools
            ->persist($destination);
    }
}
