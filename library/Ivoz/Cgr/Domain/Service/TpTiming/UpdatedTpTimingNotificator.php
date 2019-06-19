<?php

namespace Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;

class UpdatedTpTimingNotificator extends CgratesReloadNotificator implements TpTimingLifecycleEventHandlerInterface
{
    /**
     * Reload CGRates Configuration
     *
     * @param TpTimingInterface $tpTiming
     *
     * @return void
     */
    public function execute(TpTimingInterface $tpTiming)
    {
        // Skip reload on timing removal
        if ($tpTiming->getId()) {
            $this->reload($tpTiming->getTpid());
        }
    }
}
