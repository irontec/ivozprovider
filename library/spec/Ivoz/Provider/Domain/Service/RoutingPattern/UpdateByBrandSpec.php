<?php

namespace spec\Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto;
use Ivoz\Provider\Domain\Service\RoutingPattern\UpdateByBrand;
use Ivoz\Provider\Domain\Service\RoutingPatternGroup\UpdateByRoutingPatternAndCountry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Provider\Domain\Model\Country\Name;
use spec\HelperTrait;

class UpdateByBrandSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CountryRepository
     */
    protected $countryRepository;

    /**
     * @var UpdateByRoutingPattern
     */
    protected $routingPatternGroupByRoutingPatternAndCountry;

    public function let(
        EntityPersisterInterface $entityPersister,
        CountryRepository $countryRepository,
        UpdateByRoutingPatternAndCountry $routingPatternGroupByRoutingPatternAndCountry
    ) {
        $this->entityPersister = $entityPersister;
        $this->countryRepository = $countryRepository;
        $this->routingPatternGroupByRoutingPatternAndCountry = $routingPatternGroupByRoutingPatternAndCountry;

        $this->beConstructedWith(
            $entityPersister,
            $countryRepository,
            $routingPatternGroupByRoutingPatternAndCountry
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByBrand::class);
    }

    function it_does_nothing_if_not_new(
        BrandInterface $entity
    ) {

        $this
            ->countryRepository
            ->findAll()
            ->shouldNotBeCalled();

        $this->execute($entity, false);
    }


    function it_creates_routing_patterns_by_country(
        BrandInterface $entity,
        CountryInterface $country,
        RoutingPattern $routingPattern
    ) {

        $this
            ->countryRepository
            ->findAll()
            ->willReturn([$country])
            ->shouldBeCalled();

        $this->getterProphecy(
            $country,
            [
                'getName' => new Name('', ''),
                'getCountryCode' => 'SomeCode'
            ]
        );

        $this
            ->entityPersister
            ->persistDto(
                Argument::type(RoutingPatternDto::class),
                null,
                true
            )->willReturn($routingPattern);

        $this
            ->routingPatternGroupByRoutingPatternAndCountry
            ->execute(
                $routingPattern,
                $country
            )->shouldBeCalled();

        $this->execute($entity, true);
    }
}
