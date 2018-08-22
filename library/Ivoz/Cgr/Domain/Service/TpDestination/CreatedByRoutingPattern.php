<?php

namespace Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\Destination\DestinationLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\RoutingPattern\RoutingPatternLifecycleEventHandlerInterface;

class CreatedByRoutingPattern implements RoutingPatternLifecycleEventHandlerInterface
{
    CONST POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * CreatedByRoutingPattern constructor.
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
     * Create a new TpDestination when a RoutingPattern is created
     *
     * @param RoutingPatternInterface $routingPattern
     * @param $isNew
     */
    public function execute(RoutingPatternInterface $routingPattern, $isNew)
    {
        $tpDestination = $routingPattern->getTpDestination();

        /** @var TpDestinationDto $tpDestinationDto */
        $tpDestinationDto = is_null($tpDestination)
            ? TpDestination::createDto()
            : $this->entityTools->entityToDto($tpDestination);

        $tpDestinationDto
            ->setPrefix($routingPattern->getPrefix())
            ->setRoutingPatternId($routingPattern->getId())
            ->setTag($routingPattern->getCgrTag());

        $tpDestination = $this->entityTools->persistDto(
            $tpDestinationDto,
            $tpDestination,
            true
        );

        $routingPattern->setTpDestination($tpDestination);
    }

}
