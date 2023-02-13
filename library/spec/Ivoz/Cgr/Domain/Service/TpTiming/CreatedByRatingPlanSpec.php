<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTiming;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingDto;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface;
use Ivoz\Cgr\Domain\Service\TpTiming\CreatedByRatingPlan;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CreatedByRatingPlanSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $ratingPlan;
    protected $tpTiming;
    protected $ratingPlanGroup;
    protected $brand;

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
            false
        );

        $this->tpTiming =  $this->getTestDouble(
            TpTimingInterface::class,
            false
        );

        $this->ratingPlanGroup = $this->getTestDouble(
            RatingPlanGroupInterface::class,
            false
        );

        $this->brand = $this->getTestDouble(
            BrandInterface::class,
            false
        );

        $this->getterProphecy(
            $this->ratingPlan,
            [
                'getTimingType' => RatingPlanInterface::TIMINGTYPE_CUSTOM,
                'getTpTiming' => $this->tpTiming,
                'getRatingPlanGroup' => $this->ratingPlanGroup,
                'getId' => 1,
                'getCgrTimingTag' => 'b1tm1',
                'getWeekDays' => '1;2',
                'getTimeIn' => new \DateTime('01:00:00')

            ],
            false
        );

        $this
            ->ratingPlan
            ->setTpTiming(
                Argument::type(TpTimingInterface::class)
            )
            ->willReturn($this->ratingPlan);

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
                'getCgrTenant' => ''
            ],
            false
        );

        $this
            ->entityTools
            ->entityToDto($this->tpTiming)
            ->willReturn(
                TpTiming::createDto()
            );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreatedByRatingPlan::class);
    }

    function it_does_nothing_on_always_timing_type()
    {
        $this->prepareExecution();

        $this->getterProphecy(
            $this->ratingPlan,
            [
                'getTimingType' => RatingPlanInterface::TIMINGTYPE_ALWAYS
            ],
            true
        );

        $this
            ->ratingPlan
            ->getTpTiming()
            ->shouldNotBeCalled();

        $this->execute($this->ratingPlan);
    }

    function it_updates_tpTiming()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(TpTimingDto::class),
                $this->tpTiming
            )
            ->willReturn($this->tpTiming)
            ->shouldBeCalled();

        $this->execute($this->ratingPlan);
    }
}
