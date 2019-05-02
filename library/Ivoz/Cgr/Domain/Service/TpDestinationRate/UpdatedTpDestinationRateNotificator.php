<?php

namespace Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;

class UpdatedTpDestinationRateNotificator extends CgratesReloadNotificator implements TpDestinationRateLifecycleEventHandlerInterface
{
    /**
     * Reload CGRates Configuration
     *
     * @param TpDestinationRateInterface $tpDestinationRate
     *
     * @return void
     */
    public function execute(TpDestinationRateInterface $tpDestinationRate)
    {
        $this->reload($tpDestinationRate->getTpid());
    }
}
