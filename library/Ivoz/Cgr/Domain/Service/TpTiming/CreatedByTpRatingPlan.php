<?php

namespace Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanDto;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTiming;
use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingDto;
use Ivoz\Cgr\Domain\Service\TpRatingPlan\TpRatingPlanLifecycleEventHandlerInterface;
use Ivoz\Core\Application\Service\EntityTools;

class CreatedByTpRatingPlan implements TpRatingPlanLifecycleEventHandlerInterface
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

    public function execute(TpRatingPlanInterface $tpRatingPlan)
    {
        $timing = $tpRatingPlan->getTiming();

        // Always timings don't have timing entity related
        if ($tpRatingPlan->getTimingType() == TpRatingPlan::TIMING_TYPE_ALWAYS) {
            if ($timing) {
                // Delete custom timing if exists
                $this->entityTools->remove($tpRatingPlan->getTiming());
            }
        } else {
            // Update related timing or create a new one
            if (is_null($timing)) {
                $timingDto = new TpTimingDto();
            } else {
                $timingDto = $timing->toDto();
            }

            $timingTag = sprintf(
                "b%dtm%d",
                $tpRatingPlan->getRatingPlan()->getBrand()->getId(),
                $tpRatingPlan->getId()
            );

            // Update/Insert endpoint data
            $timingDto
                ->setTag($timingTag)
                ->setYears(TpTiming::TIMING_ANY)
                ->setMonths(TpTiming::TIMING_ANY)
                ->setMonthDays(TpTiming::TIMING_ANY)
                ->setWeekDays($tpRatingPlan->getWeekDays())
                ->setTime($tpRatingPlan->getTimeIn()->format("H:i:s"));

            $timing = $this->entityTools
                ->persistDto(
                    $timingDto,
                    $timing,
                    true
                );

            /** @var TpRatingPlanDto $tpRatingPlanDto */
            $tpRatingPlanDto = $this->entityTools->entityToDto($tpRatingPlan);
            $tpRatingPlanDto
                ->setTimingId($timing->getId())
                ->setTimingTag($timingTag);

            $this->entityTools->persistDto(
                $tpRatingPlanDto,
                $tpRatingPlan,
                true
            );
        }
    }
}
