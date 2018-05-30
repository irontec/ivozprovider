<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\CreateByOutgoingRoutingAndRoutingPattern;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByOutgoingRouting;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByOutgoingRoutingSpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CreateByOutgoingRoutingAndRoutingPattern
     */
    protected $lcrRuleFactory;

    public function let(
        EntityPersisterInterface $entityPersister,
        CreateByOutgoingRoutingAndRoutingPattern $lcrRuleFactory
    ) {
        $this->entityPersister = $entityPersister;
        $this->lcrRuleFactory = $lcrRuleFactory;

        $this->beConstructedWith($entityPersister, $lcrRuleFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByOutgoingRouting::class);
    }

    private function prepareBaseExample(
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $outgoingRouting
            ->getLcrRules()
            ->willReturn([]);

        $outgoingRouting
            ->getType()
            ->willReturn('fax');

        $outgoingRouting
            ->replaceLcrRules(
                Argument::type(ArrayCollection::class)
            )
            ->shouldBeCalled();
    }

    function it_removes_old_lcr_rules(
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->prepareBaseExample($outgoingRouting, $lcrRule);
        $outgoingRouting
            ->getLcrRules()
            ->willReturn([$lcrRule]);

        $this
            ->entityPersister
            ->remove($lcrRule)
            ->shouldBeCalled();

        $outgoingRouting
            ->removeLcrRule($lcrRule)
            ->shouldBeCalled();

        $this
            ->lcrRuleFactory
            ->execute($outgoingRouting, null)
            ->willReturn($lcrRule)
            ->shouldBeCalled();

        $this->execute($outgoingRouting);
    }

    function it_sets_new_rules(
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->prepareBaseExample($outgoingRouting, $lcrRule);

        $this
            ->lcrRuleFactory
            ->execute($outgoingRouting, null)
            ->willReturn($lcrRule)
            ->shouldBeCalled();

        $lcrRules = new ArrayCollection([$lcrRule->getWrappedObject()]);
        $outgoingRouting
            ->replaceLcrRules($lcrRules)
            ->shouldBeCalled();

        $this->execute($outgoingRouting);
    }

    function it_retrieves_routingPatternGroup_patterns_when_type_is_group(
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule,
        RoutingPatternGroupInterface $routingPatternGroup,
        RoutingPatternInterface $routingPattern
    ) {
        $this->prepareBaseExample($outgoingRouting, $lcrRule);

        $outgoingRouting
            ->getType()
            ->willReturn('group');

        $outgoingRouting
            ->getRoutingPatternGroup()
            ->willReturn($routingPatternGroup)
            ->shouldBeCalled();

        $routingPatternGroup
            ->getRoutingPatterns()
            ->willReturn([$routingPattern])
            ->shouldBeCalled();

        $this
            ->lcrRuleFactory
            ->execute($outgoingRouting, $routingPattern)
            ->willReturn($lcrRule)
            ->shouldBeCalled();

        $this->execute($outgoingRouting);
    }

    function it_retrieves_routingPattern_when_type_is_pattern(
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule,
        RoutingPatternInterface $routingPattern
    ) {
        $this->prepareBaseExample($outgoingRouting, $lcrRule);

        $outgoingRouting
            ->getType()
            ->willReturn('pattern');

        $outgoingRouting
            ->getRoutingPattern()
            ->willReturn($routingPattern);

        $this
            ->lcrRuleFactory
            ->execute($outgoingRouting, $routingPattern)
            ->willReturn($lcrRule)
            ->shouldBeCalled();

        $this->execute($outgoingRouting);
    }
}
