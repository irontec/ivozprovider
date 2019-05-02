<?php

namespace Ivoz\Cgr\Domain\Service\TpLcrRule;

use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;

class UpdatedTpLcrRuleNotificator extends CgratesReloadNotificator implements TpLcrRuleLifecycleEventHandlerInterface
{
    /**
     * Reload CGRates Configuration
     *
     * @param TpLcrRuleInterface $tpLcrRule
     *
     * @return void
     */
    public function execute(TpLcrRuleInterface $tpLcrRule)
    {
        $this->reload($tpLcrRule->getTpid());
    }
}
