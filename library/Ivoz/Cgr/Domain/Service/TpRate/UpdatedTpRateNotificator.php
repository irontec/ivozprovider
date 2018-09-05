<?php

namespace Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;

class UpdatedTpRateNotificator extends CgratesReloadNotificator implements TpRateLifecycleEventHandlerInterface
{
    /**
     * Reload CGRates Configuration
     *
     * @param TpRateInterface $tpRate
     */
    public function execute(TpRateInterface $tpRate)
    {
        $this->reload($tpRate->getTpid());
    }
}
