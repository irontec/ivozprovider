<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupRepository;
use Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern\CreateAndPersist as CreateAndPersistRoutingPatternGroupsRelPattern;

/**
 * Class UpdateByRoutingPattern
 * @package Ivoz\Provider\Domain\Service\RoutingPatternGroup
 */
class UpdateByRoutingPatternAndCountry
{
    public function __construct(
        private EntityPersisterInterface $entityPersister,
        private RoutingPatternGroupRepository $routingPatternGroupRepository,
        private CreateAndPersistRoutingPatternGroupsRelPattern $createAndPersistRoutingPatternGroupsRelPattern
    ) {
    }

    /**
     * @return void
     */
    public function execute(RoutingPatternInterface $routingPattern, CountryInterface $country)
    {
        $brandId = (int) $routingPattern
            ->getbrand()
            ->getId();

        $routingPatternGroup = $this
            ->routingPatternGroupRepository
            ->findByBrandIdAndName(
                $brandId,
                $country->getZone()->getEn()
            );

        if (empty($routingPatternGroup)) {
            $routingPatternGroupDto = RoutingPatternGroup::createDto();
            $routingPatternGroupDto
                ->setName($country->getZone()->getEn())
                ->setBrandId($brandId);

            /** @var RoutingPatternGroupInterface $routingPatternGroup */
            $routingPatternGroup = $this->entityPersister->persistDto(
                $routingPatternGroupDto,
                null,
                true
            );
        }

        $this->createAndPersistRoutingPatternGroupsRelPattern->execute(
            $routingPattern,
            $routingPatternGroup
        );
    }
}
