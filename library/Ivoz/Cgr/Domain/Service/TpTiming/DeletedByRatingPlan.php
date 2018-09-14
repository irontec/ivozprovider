<?php

namespace Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Service\RatingPlan\RatingPlanLifecycleEventHandlerInterface;

class DeletedByRatingPlan implements RatingPlanLifecycleEventHandlerInterface
{
    const POST_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * DeletedByTpRatingPlan constructor.
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
            self::EVENT_POST_REMOVE => self::POST_REMOVE_PRIORITY
        ];
    }

    public function execute(RatingPlanInterface $ratingPlan)
    {
        $tpTiming = $ratingPlan->getTpTiming();

        // Always RatingPlans should not have TpTiming
        if ($tpTiming && $ratingPlan->getTimingType() == RatingPlan::TIMING_TYPE_ALWAYS) {
            // Delete custom timing if exists
            $this->entityTools->remove($tpTiming);
        }
    }
}
