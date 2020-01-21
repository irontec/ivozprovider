<?php

namespace Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;

class UpdatedTpDestinationNotificator extends CgratesReloadNotificator implements TpDestinationLifecycleEventHandlerInterface
{
    /**
     * Reload CGRates Configuration
     *
     * @param TpDestinationInterface $tpDestination
     *
     * @return void
     */
    public function execute(TpDestinationInterface $tpDestination)
    {
        $isNotNew = !$tpDestination->isNew();

        $this->reload(
            $tpDestination->getTpid(),
            $isNotNew
        );
    }
}
