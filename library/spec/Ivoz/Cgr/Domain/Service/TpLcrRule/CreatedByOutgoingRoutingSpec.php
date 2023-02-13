<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpLcrRule;

use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleDto;
use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface;
use Ivoz\Cgr\Domain\Service\TpLcrRule\CreatedByOutgoingRouting;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CreatedByOutgoingRoutingSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $outgoingRouting;
    protected $brand;
    protected $tpLcrRule;
    protected $tpLcrRuleDto;

    public function let()
    {
        $this->entityTools = $this->getTestDouble(
            EntityTools::class,
            true
        );

        $this->beConstructedWith(
            $this->entityTools
        );
    }

    protected function prepareExecution()
    {
        $this->outgoingRouting = $this->getTestDouble(
            OutgoingRoutingInterface::class,
            true
        );

        $this->brand = $this->getTestDouble(
            BrandInterface::class,
            true
        );

        $this->tpLcrRule = $this->getTestDouble(
            TpLcrRuleInterface::class,
            true
        );

        $this->tpLcrRuleDto = $this->getTestDouble(
            TpLcrRuleDto::class,
            true
        );

        $this->getterProphecy(
            $this->outgoingRouting,
            [
                'getRoutingMode' => OutgoingRoutingInterface::ROUTINGMODE_LCR,
                'getBrand' => $this->brand,
                'getTpLcrRule' => $this->tpLcrRule,
                'getCgrCategory' => 'or1',
                'getCgrRpCategory' => 'lcr_profile1',
                'getId' => 1
            ],
            false
        );

        $this->getterProphecy(
            $this->brand,
            [
                'getCgrTenant' => 'b1'
            ],
            false
        );

        $this->fluentSetterProphecy(
            $this->tpLcrRuleDto,
            [
                'setTpid' => Argument::any(),
                'setTenant' => Argument::any(),
                'setCategory' => Argument::any(),
                'setRpCategory' => Argument::any(),
                'setOutgoingRoutingId' => Argument::any()
            ],
            false
        );

        $this
            ->entityTools
            ->entityToDto($this->tpLcrRule)
            ->willReturn($this->tpLcrRuleDto);

        $this
            ->entityTools
            ->persistDto(
                $this->tpLcrRuleDto,
                $this->tpLcrRule,
                true
            )
            ->willReturn(
                $this->tpLcrRule
            );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreatedByOutgoingRouting::class);
    }

    function it_updates_tpDestinationRate()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->persistDto(
                $this->tpLcrRuleDto,
                $this->tpLcrRule,
                true
            )
            ->shouldBeCalled();

        $this
            ->execute($this->outgoingRouting);
    }

    function it_updates_outgoingRouting()
    {
        $this->prepareExecution();

        $this
            ->outgoingRouting
            ->setTpLcrRule($this->tpLcrRule)
            ->willReturn($this->outgoingRouting)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persist($this->outgoingRouting)
            ->shouldBeCalled();

        $this
            ->execute($this->outgoingRouting);
    }
}
