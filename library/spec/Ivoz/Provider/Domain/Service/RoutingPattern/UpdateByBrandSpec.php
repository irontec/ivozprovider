<?php

namespace spec\Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Core\Application\Service\EntityTools;
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
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var CountryRepository
     */
    protected $countryRepository;

    /**
     * @var UpdateByRoutingPattern
     */
    protected $routingPatternGroupByRoutingPatternAndCountry;

    public function let(
        EntityTools $entityTools,
        CountryRepository $countryRepository,
        UpdateByRoutingPatternAndCountry $routingPatternGroupByRoutingPatternAndCountry
    ) {
        $this->entityTools = $entityTools;
        $this->countryRepository = $countryRepository;
        $this->routingPatternGroupByRoutingPatternAndCountry = $routingPatternGroupByRoutingPatternAndCountry;

        $this->beConstructedWith(
            $entityTools,
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
        $entity
            ->isNew()
            ->willReturn(false);

        $this
            ->countryRepository
            ->findAll()
            ->shouldNotBeCalled();

        $this->execute($entity);
    }


    function it_creates_routing_patterns_by_country(
        BrandInterface $entity,
        CountryInterface $country,
        RoutingPattern $routingPattern
    ) {
        $entity
            ->isNew()
            ->willReturn(true);

        $entity
            ->getId()
            ->willReturn(1);

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
            ->entityTools
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

        $this->execute($entity);
    }
}
