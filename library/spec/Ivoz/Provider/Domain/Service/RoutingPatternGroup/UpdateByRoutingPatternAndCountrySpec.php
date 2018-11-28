<?php

namespace spec\Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupRepository;
use Ivoz\Provider\Domain\Service\RoutingPatternGroup\UpdateByRoutingPatternAndCountry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern\CreateAndPersist as CreateAndPersistRoutingPatternGroupsRelPattern;
use spec\HelperTrait;
use Ivoz\Provider\Domain\Model\Country\Zone;

class UpdateByRoutingPatternAndCountrySpec extends ObjectBehavior
{
    use HelperTrait;

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

    public function let(
        EntityPersisterInterface $entityPersister,
        RoutingPatternGroupRepository $routingPatternGroupRepository,
        CreateAndPersistRoutingPatternGroupsRelPattern $createAndPersistRoutingPatternGroupsRelPattern
    ) {
        $this->entityPersister = $entityPersister;
        $this->routingPatternGroupRepository = $routingPatternGroupRepository;
        $this->createAndPersistRoutingPatternGroupsRelPattern = $createAndPersistRoutingPatternGroupsRelPattern;

        $this->beConstructedWith(
            $entityPersister,
            $routingPatternGroupRepository,
            $createAndPersistRoutingPatternGroupsRelPattern
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByRoutingPatternAndCountry::class);
    }

    function it_calls_routingPatternGroupsRelPattern_service(
        RoutingPatternInterface $entity,
        BrandInterface $brand,
        CountryInterface $country,
        RoutingPatternGroupInterface $routingPatternGroup
    ) {
        $this->getterProphecy(
            $country,
            ['getZone' => new Zone('', '')]
        );

        $entity
            ->getBrand()
            ->willReturn($brand)
            ->shouldBeCalled();

        $brand
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $this
            ->routingPatternGroupRepository
            ->findByBrandIdAndName(1, '')
            ->willReturn($routingPatternGroup)
            ->shouldBeCalled();

        $this
            ->createAndPersistRoutingPatternGroupsRelPattern
            ->execute(
                $entity,
                $routingPatternGroup
            )
            ->shouldBeCalled();

        $this->execute($entity, $country);
    }


    function it_creates_routing_pattern_group_if_empty(
        RoutingPatternInterface $entity,
        BrandInterface $brand,
        CountryInterface $country,
        RoutingPatternGroupInterface $routingPatternGroup
    ) {
        $this->getterProphecy(
            $country,
            ['getZone' => new Zone('', '')]
        );

        $entity
            ->getBrand()
            ->willReturn($brand)
            ->shouldBeCalled();

        $brand
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $this
            ->routingPatternGroupRepository
            ->findByBrandIdAndName(1, '')
            ->willReturn(null)
            ->shouldBeCalled();

        $this->entityPersister->persistDto(
            Argument::type(RoutingPatternGroupDto::class),
            null,
            true
        )
        ->willReturn($routingPatternGroup);

        $this
            ->createAndPersistRoutingPatternGroupsRelPattern
            ->execute(
                $entity,
                $routingPatternGroup
            )
            ->shouldBeCalled();

        $this->execute($entity, $country);
    }
}
