<?php

namespace Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Service\RatingPlan\RatingPlanLifecycleEventHandlerInterface;

class DeletedByRatingPlan implements RatingPlanLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

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
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(RatingPlanInterface $ratingPlan)
    {
        $tpTiming = $ratingPlan->getTpTiming();

        $alwaysTimingType = ($ratingPlan->getTimingType() == RatingPlan::TIMING_TYPE_ALWAYS);

        // Always RatingPlans should not have TpTiming
        if ($tpTiming && $alwaysTimingType) {
            // Delete custom timing if exists
            $this->entityTools->remove($tpTiming);
        }
    }
}
