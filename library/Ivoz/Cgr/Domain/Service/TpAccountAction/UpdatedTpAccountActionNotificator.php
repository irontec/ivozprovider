<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;

class UpdatedTpAccountActionNotificator extends CgratesReloadNotificator implements TpAccountActionLifecycleEventHandlerInterface
{
    /**
     * Reload CGRates Configuration
     *
     * @param TpAccountActionInterface $tpAccountAction
     *
     * @return void
     */
    public function execute(TpAccountActionInterface $tpAccountAction)
    {
        $this->reload($tpAccountAction->getTpid());
    }
}
