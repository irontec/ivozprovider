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
        $company = $tpAccountAction->getCompany();

        if ($company && $company->hasChanged('maxDailyUsage')) {
            $this->reload(
                $tpAccountAction->getTpid(),
                $tpAccountAction->getAccount()
            );

            return;
        }

        $this->reload($tpAccountAction->getTpid());
    }
}
