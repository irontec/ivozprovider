<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\CreateByOutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\TrunksLcrRuleFactory;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByOutgoingRouting;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByOutgoingRoutingSpec extends ObjectBehavior
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var TrunksLcrRuleFactory
     */
    protected $lcrRuleFactory;

    /**
     *  @var TrunksLcrRuleInterface
     */
    protected $lcrRule;

    /**
     * @var CreateByOutgoingRouting
     */
    protected $lcrRuleTargetFactory;

    public function let(
        EntityTools $entityTools,
        TrunksLcrRuleFactory $lcrRuleFactory,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->entityTools = $entityTools;
        $this->lcrRuleFactory = $lcrRuleFactory;
        $this->lcrRule = $lcrRule;

        $this->beConstructedWith($entityTools, $lcrRuleFactory);
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
            ->willReturn(OutgoingRouting::TYPE_FAX);

        $lcrRule
            ->hasChanged('id')
            ->willReturn(false);

            $this->lcrRuleFactory
                ->execute($outgoingRouting)
                ->willReturn($this->lcrRule);
    }

    function it_does_nothing_on_not_new_fax_type_rule(
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule,
        RoutingPatternInterface $routingPattern
    ) {
        $this->prepareBaseExample($outgoingRouting, $lcrRule);
        $lcrRuleObject = $lcrRule->getWrappedObject();
        $initialRuleCollection = [
            $lcrRuleObject
        ];
        $outgoingRouting
            ->getLcrRules()
            ->willReturn($initialRuleCollection)
            ->shouldBeCalled();

        $lcrRule
            ->hasChanged('id')
            ->willReturn(false);

        $this
            ->lcrRuleFactory
            ->execute($outgoingRouting, null)
            ->willReturn($lcrRuleObject)
            ->shouldBeCalled();

        $outgoingRouting
            ->replaceLcrRules(Argument::type(ArrayCollection::class))
            ->shouldNotBeCalled();

        $this->entityTools
            ->removeFromArray(Argument::any())
            ->shouldNotBeCalled();

        $this->execute(
            $outgoingRouting->getWrappedObject()
        );
    }

    function it_replaces_lcr_rules(
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule,
        TrunksLcrRuleInterface $lcrRule2,
        RoutingPatternInterface $routingPattern
    ) {
        $this->prepareRuleReplacementScenario($outgoingRouting, $lcrRule, $lcrRule2);

        $this->execute(
            $outgoingRouting->getWrappedObject()
        );
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     * @param TrunksLcrRuleInterface $lcrRule
     * @param TrunksLcrRuleInterface $lcrRule2
     */
    private function prepareRuleReplacementScenario(OutgoingRoutingInterface $outgoingRouting, TrunksLcrRuleInterface $lcrRule, TrunksLcrRuleInterface $lcrRule2)
    {
        $this->prepareBaseExample($outgoingRouting, $lcrRule);
        $lcrRuleObject = $lcrRule->getWrappedObject();
        $lcrRule2Object = $lcrRule2->getWrappedObject();
        $initialRuleCollection = [
            $lcrRuleObject
        ];
        $updatedRuleCollection = [
            $lcrRule2Object
        ];
        $outgoingRouting
            ->getLcrRules()
            ->willReturn($initialRuleCollection, $updatedRuleCollection)
            ->shouldBeCalled();

        $outgoingRouting
            ->replaceLcrRules(Argument::type(ArrayCollection::class))
            ->shouldBeCalled();

        $lcrRule
            ->hasChanged('id')
            ->willReturn(true);

        $this
            ->lcrRuleFactory
            ->execute($outgoingRouting, null)
            ->willReturn($lcrRuleObject)
            ->shouldBeCalled();
    }

    function it_removes_old_lcr_rules(
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule,
        TrunksLcrRuleInterface $lcrRule2,
        RoutingPatternInterface $routingPattern
    ) {
        $this->prepareRuleReplacementScenario($outgoingRouting, $lcrRule, $lcrRule2);

        $this->entityTools
            ->removeFromArray(Argument::type('array'))
            ->shouldBeCalled();

        $this->execute(
            $outgoingRouting->getWrappedObject()
        );
    }


}
