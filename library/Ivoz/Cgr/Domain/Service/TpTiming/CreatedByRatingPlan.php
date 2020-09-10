<?php

namespace Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTiming;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Service\RatingPlan\RatingPlanLifecycleEventHandlerInterface;

class CreatedByRatingPlan implements RatingPlanLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * CreatedByTpRatingPlan constructor.
     *
     * @param EntityTools $entityTools
     */
    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(RatingPlanInterface $ratingPlan)
    {
        // Always timings don't have timing entity related
        if ($ratingPlan->getTimingType() == RatingPlanInterface::TIMINGTYPE_ALWAYS) {
            return;
        }

        $tpTiming = $ratingPlan->getTpTiming();
        $brand = $ratingPlan->getRatingPlanGroup()->getBrand();

        // Update related timing or create a new one
        $tpTimingDto = is_null($tpTiming)
            ? TpTiming::createDto()
            : $this->entityTools->entityToDto($tpTiming);

        // Update/Insert timing data
        $tpTimingDto
            ->setRatingPlanId($ratingPlan->getId())
            ->setTpid($brand->getCgrTenant())
            ->setTag($ratingPlan->getCgrTimingTag())
            ->setYears(TpTiming::TIMING_ANY)
            ->setMonths(TpTiming::TIMING_ANY)
            ->setMonthDays(TpTiming::TIMING_ANY)
            ->setWeekDays($ratingPlan->getWeekDays())
            ->setTime($ratingPlan->getTimeIn()->format("H:i:s"));

        /** @var TpTimingInterface $tpTiming */
        $tpTiming = $this->entityTools
            ->persistDto(
                $tpTimingDto,
                $tpTiming
            );

        $ratingPlan->setTpTiming($tpTiming);
    }
}
