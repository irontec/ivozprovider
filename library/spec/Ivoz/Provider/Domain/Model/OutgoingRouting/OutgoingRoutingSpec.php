<?php

namespace spec\Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use PhpSpec\ObjectBehavior;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class OutgoingRoutingSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var OutgoingRoutingDto
     */
    protected $dto;

    /** @var DtoToEntityFakeTransformer */
    private $transformer;

    function let(
        BrandInterface $brand
    ) {
        $brandDto = new BrandDto();

        $this->dto = $dto = new OutgoingRoutingDto();
        $dto
            ->setPriority(1)
            ->setWeight(2)
            ->setBrand($brandDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$brandDto, $brand->getWrappedObject()]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(OutgoingRouting::class);
    }

    function it_resets_routing_pattern_when_type_is_group(
        RoutingPatternInterface $routingPattern,
        RoutingPatternGroupInterface $routingPatternGroup
    ) {
        $routingPatternDto = new RoutingPatternDto();
        $routingPatternGroupDto = new RoutingPatternGroupDto();

        $this
            ->dto
            ->setType('group')
            ->setRoutingPattern($routingPatternDto)
            ->setRoutingPatternGroup($routingPatternGroupDto);

        $this->transformer->appendFixedTransforms([
            [$routingPatternDto, $routingPattern->getWrappedObject()],
            [$routingPatternGroupDto, $routingPatternGroup->getWrappedObject()],
        ]);

        $this
            ->getRoutingPattern()
            ->shouldBe(null);
    }

    function it_resets_routing_pattern_when_type_is_pattern(
        RoutingPatternInterface $routingPattern,
        RoutingPatternGroupInterface $routingPatternGroup
    ) {
        $routingPatternDto = new RoutingPatternDto();
        $routingPatternGroupDto = new RoutingPatternGroupDto();

        $this
            ->dto
            ->setType('pattern')
            ->setRoutingPattern($routingPatternDto)
            ->setRoutingPatternGroup($routingPatternGroupDto);

        $this->transformer->appendFixedTransforms([
            [$routingPatternDto, $routingPattern->getWrappedObject()],
            [$routingPatternGroupDto, $routingPatternGroup->getWrappedObject()],
        ]);

        $this
            ->getRoutingPatternGroup()
            ->shouldBe(null);
    }

    function it_resets_values_when_type_is_fax(
        RoutingPatternInterface $routingPattern,
        RoutingPatternGroupInterface $routingPatternGroup
    ) {
        $routingPatternDto = new RoutingPatternDto();
        $routingPatternGroupDto = new RoutingPatternGroupDto();

        $this
            ->dto
            ->setType('fax')
            ->setRoutingPattern($routingPatternDto)
            ->setRoutingPatternGroup($routingPatternGroupDto);

        $this->transformer->appendFixedTransforms([
            [$routingPatternDto, $routingPattern->getWrappedObject()],
            [$routingPatternGroupDto, $routingPatternGroup->getWrappedObject()],
        ]);

        $this
            ->getRoutingPattern()
            ->shouldBe(null);

        $this
            ->getRoutingPatternGroup()
            ->shouldBe(null);
    }


    function it_throws_exception_on_unexpected_type()
    {

        $dto = clone $this->dto;
        $dto->setType('something');

        $exception = new \Exception('Incorrect Outgoing Routing Type');
        $this
            ->shouldThrow($exception)
            ->during('updateFromDto', [$dto, $this->transformer]);
    }
}
