<?php

namespace spec\Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class OutgoingRoutingSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    function let()
    {
        $this->dto = $dto = new OutgoingRoutingDto();

        $dto->setPriority(1);
        $dto->setWeight(2);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
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
        $this->hydrate(
            $this->dto,
            [
                'type' => 'group',
                'routingPattern' => $routingPattern->getWrappedObject(),
                'routingPatternGroup' => $routingPatternGroup->getWrappedObject()
            ]
        );

        $this
            ->getRoutingPattern()
            ->shouldBe(null);
    }

    function it_resets_routing_pattern_when_type_is_pattern(
        RoutingPatternInterface $routingPattern,
        RoutingPatternGroupInterface $routingPatternGroup
    ) {
            $this->hydrate(
                $this->dto,
                [
                    'type' => 'pattern',
                    'routingPattern' => $routingPattern->getWrappedObject(),
                    'routingPatternGroup' => $routingPatternGroup->getWrappedObject()
                ]
            );

            $this
                ->getRoutingPatternGroup()
                ->shouldBe(null);
    }

    function it_resets_values_when_type_is_fax(
        RoutingPatternInterface $routingPattern,
        RoutingPatternGroupInterface $routingPatternGroup
    ) {
        $this->hydrate(
            $this->dto,
            [
                'type' => 'fax',
                'routingPattern' => $routingPattern->getWrappedObject(),
                'routingPatternGroup' => $routingPatternGroup->getWrappedObject()
            ]
        );

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
            ->during('updateFromDto', [$dto, new \spec\DtoToEntityFakeTransformer()]);
    }
}
