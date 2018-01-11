<?php
namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupRepository;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto;

/**
 * Class CreateAndPersist
 * @package Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern
 */
class CreateAndPersist
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;


    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

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