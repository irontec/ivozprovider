<?php

namespace Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Service\TpRatingPlan\TpRatingPlanLifecycleEventHandlerInterface;
use Ivoz\Core\Application\Service\EntityTools;

class DeletedByTpRatingPlan implements TpRatingPlanLifecycleEventHandlerInterface
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

    public function execute(TpRatingPlanInterface $tpRatingPlan)
    {
        $timing = $tpRatingPlan->getTiming();

        if ($timing) {
            // Delete custom timing if exists
            $this->entityTools->remove($tpRatingPlan->getTiming());
        }
    }
}
