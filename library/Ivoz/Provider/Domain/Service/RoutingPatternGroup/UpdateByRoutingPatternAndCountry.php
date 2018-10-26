<?php
namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupRepository;
use Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern\CreateAndPersist as CreateAndPersistRoutingPatternGroupsRelPattern;

/**
 * Class UpdateByRoutingPattern
 * @package Ivoz\Provider\Domain\Service\RoutingPatternGroup
 */
class UpdateByRoutingPatternAndCountry
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var RoutingPatternGroupRepository
     */
    protected $routingPatternGroupRepository;

    /**
     * @var CreateAndPersistRoutingPatternGroupsRelPattern
     */
    protected $createAndPersistRoutingPatternGroupsRelPattern;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        RoutingPatternGroupRepository $routingPatternGroupRepository,
        CreateAndPersistRoutingPatternGroupsRelPattern $createAndPersistRoutingPatternGroupsRelPattern
    ) {
        $this->entityPersister = $entityPersister;
        $this->routingPatternGroupRepository = $routingPatternGroupRepository;
        $this->createAndPersistRoutingPatternGroupsRelPattern = $createAndPersistRoutingPatternGroupsRelPattern;
    }

    public function execute(RoutingPatternInterface $entity, CountryInterface $country)
    {

        if (!$country->getZone()) {
            /**
             * @todo Every country has a value on db. Is this even needed?
             */
            return;
        }

        $brandId = $entity
            ->getbrand()
            ->getId();

        $routingPatternGroup = $this
            ->routingPatternGroupRepository
            ->findByBrandIdAndName(
                $brandId,
                $country->getZone()->getEn()
            );

        if (empty($routingPatternGroup)) {

            /**
             * @var RoutingPatternGroupDto $routingPatternGroupDto
             */
            $routingPatternGroupDto = RoutingPatternGroup::createDto();
            $routingPatternGroupDto
                ->setName($country->getZone()->getEn())
                ->setBrandId($brandId);

            $routingPatternGroup = $this->entityPersister->persistDto(
                $routingPatternGroupDto,
                null,
                true
            );
        }

        $this->createAndPersistRoutingPatternGroupsRelPattern->execute(
            $entity,
            $routingPatternGroup
        );
    }
}
