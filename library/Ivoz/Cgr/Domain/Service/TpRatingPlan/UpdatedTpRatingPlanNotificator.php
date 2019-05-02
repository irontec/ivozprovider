<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingPlan;

use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlanInterface;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;

class UpdatedTpRatingPlanNotificator extends CgratesReloadNotificator implements TpRatingPlanLifecycleEventHandlerInterface
{
    /**
     * Reload CGRates Configuration
     *
     * @param TpRatingPlanInterface $tpRatingPlan
     *
     * @return void
     */
    public function execute(TpRatingPlanInterface $tpRatingPlan)
    {
        $this->reload($tpRatingPlan->getTpid());
    }
}
