<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingRepository;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByRoutingPattern;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByOutgoingRouting;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByRoutingPatternSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var UpdateByOutgoingRouting
     */
    protected $updateByOutgoingRouting;

    /**
     * @var OutgoingRoutingRepository
     */
    protected $outgoingRoutingRepository;

    public function let(
        UpdateByOutgoingRouting $updateByOutgoingRouting,
        OutgoingRoutingRepository $outgoingRoutingRepository
    ) {
        $this->updateByOutgoingRouting = $updateByOutgoingRouting;
        $this->outgoingRoutingRepository = $outgoingRoutingRepository;

        $this->beConstructedWith($updateByOutgoingRouting, $outgoingRoutingRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByRoutingPattern::class);
    }

    function it_does_nothing_on_unchanged_prefix(
        RoutingPatternInterface $routingPattern,
        OutgoingRoutingInterface $outgoingRouting
    ) {
        $routingPattern
            ->hasChanged('prefix')
            ->willReturn(false);

        $this
            ->outgoingRoutingRepository
            ->findByRoutingPattern(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($routingPattern, false);
    }

    function it_calls_updateByOutgoingRouting_per_outgoingRouting(
        RoutingPatternInterface $routingPattern,
        OutgoingRoutingInterface $outgoingRouting
    ) {
        $routingPattern
            ->hasChanged('prefix')
            ->willReturn(true);

        $this
            ->outgoingRoutingRepository
            ->findByRoutingPattern($routingPattern)
            ->willReturn([$outgoingRouting]);

        $this
            ->updateByOutgoingRouting
            ->execute($outgoingRouting)
            ->shouldBeCalled($outgoingRouting);

        $this->execute($routingPattern, false);
    }
}

