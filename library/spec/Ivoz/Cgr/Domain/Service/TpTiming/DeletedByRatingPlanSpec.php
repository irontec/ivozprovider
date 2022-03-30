<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface;
use Ivoz\Cgr\Domain\Service\TpTiming\DeletedByRatingPlan;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class DeletedByRatingPlanSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $ratingPlan;
    protected $tpTiming;
    protected $ratingPlanGroup;

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

        $this->tpTiming = $this->getTestDouble(
            TpTimingInterface::class,
            false
        );

        $this->getterProphecy(
            $this->ratingPlan,
            [
                'getTpTiming' => $this->tpTiming,
                'getTimingType' => RatingPlan::TIMINGTYPE_ALWAYS
            ]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DeletedByRatingPlan::class);
    }

    function it_removes_tp_timins_on_always_timings()
    {
        $this->prepareExecution();

        $this
            ->entityTools
            ->remove($this->tpTiming)
            ->shouldBeCalled();

        $this->execute($this->ratingPlan);
    }
}
