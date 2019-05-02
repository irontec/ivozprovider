<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;

class UpdatedTpRatingProfileNotificator extends CgratesReloadNotificator implements TpRatingProfileLifecycleEventHandlerInterface
{
    /**
     * Reload CGRates Configuration
     *
     * @param TpRatingProfileInterface $tpRatingProfile
     *
     * @return void
     */
    public function execute(TpRatingProfileInterface $tpRatingProfile)
    {
        $this->reload($tpRatingProfile->getTpid());
    }
}
