<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Service\TpRatingPlan\UpdateByRatingPlan;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByRatingPlanSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $ratingPlan;
    protected $tpRatingPlanDto;
    protected $tpRatingPlan;
    protected $ratingPlanGroup;
    protected $brand;
    protected $destinationRateGroup;

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
        $this->ratingPlan = $this->getTestDouble(
            RatingPlanInterface::class,
            true
        );

        $this->tpRatingPlan = $this->getTestDouble(
            TpRatingPlanInterface::class,
            true
        );

        $this->tpRatingPlanDto = $this->getTestDouble(
            TpRatingPlanDto::class,
            true
        );

        $this->ratingPlanGroup = $this->getTestDouble(
            RatingPlanGroupInterface::class,
            true
        );

        $this->brand = $this->getTestDouble(
            BrandInterface::class,
            true
        );

        $this->destinationRateGroup = $this->getTestDouble(
            DestinationRateGroupInterface::class,
            true
        );

        $this->getterProphecy(
            $this->ratingPlan,
            [
                'getTpRatingPlan' => $this->tpRatingPlan,
                'getRatingPlanGroup' => $this->ratingPlanGroup,
                'getDestinationRateGroup' => $this->destinationRateGroup,
                'getCgrTag' => 'b1rp1',
                'getCgrTimingTag' => 'b1tm1',
                'getWeight' => 1,
                'getId' => 1
            ],
            false
        );

        $this->getterProphecy(
            $this->ratingPlanGroup,
            [
                'getBrand' => $this->brand
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
            $this->tpRatingPlanDto,
            [
                'setTpid' => Argument::any(),
                'setTag' => Argument::any(),
                'setDestratesTag' => Argument::any(),
                'setTimingTag' => Argument::any(),
                'setWeight' => Argument::any(),
                'setRatingPlanId' => Argument::any()
            ],
            false
        );

        $this->getterProphecy(
            $this->destinationRateGroup,
            [
                'getCgrTag' => ''
            ],
            false
        );

        $this
            ->entityTools
            ->entityToDto($this->tpRatingPlan)
            ->willReturn($this->tpRatingPlanDto);

        $this
            ->entityTools
            ->persistDto(
                $this->tpRatingPlanDto,
                $this->tpRatingPlan,
                false
            )
            ->willReturn($this->tpRatingPlan);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByRatingPlan::class);
    }

    function it_updates_tpRatingPlan()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->persistDto(
                $this->tpRatingPlanDto,
                $this->tpRatingPlan,
                false
            )
            ->willReturn($this->tpRatingPlan)
            ->shouldBeCalled();

        $this->execute(
            $this->ratingPlan
        );
    }

    function it_updates_ratingPlan()
    {
        $this
            ->prepareExecution();

        $this
            ->ratingPlan
            ->setTpRatingPlan($this->tpRatingPlan)
            ->willReturn($this->ratingPlan)
            ->shouldBecalled();

        $this->execute(
            $this->ratingPlan
        );
    }
}
