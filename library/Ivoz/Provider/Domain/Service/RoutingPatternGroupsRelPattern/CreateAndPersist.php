<?php
namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto;

/**
 * Class CreateAndPersist
 * @package Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern
 */
class CreateAndPersist
{
    public function __construct(
        private EntityPersisterInterface $entityPersister
    ) {
    }

    /**
     * @return void
     */
    public function execute(RoutingPatternInterface $routingPattern, RoutingPatternGroupInterface $patternGroup)
    {
        /**
         * @var RoutingPatternGroupsRelPatternDTO $routingPatternGroupsRelPatternDto
         */
        $routingPatternGroupsRelPatternDto = RoutingPatternGroupsRelPattern::createDto();
        $routingPatternGroupsRelPatternDto
            ->setRoutingPatternId($routingPattern->getId())
            ->setRoutingPatternGroupid($patternGroup->getId());

        $this->entityPersister->persistDto(
            $routingPatternGroupsRelPatternDto
        );
    }
}
