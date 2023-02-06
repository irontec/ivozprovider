<?php

namespace Ivoz\Cgr\Domain\Service\TpLcrRule;

use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface TpLcrRuleLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TpLcrRuleInterface $tpLcrRule);
}
