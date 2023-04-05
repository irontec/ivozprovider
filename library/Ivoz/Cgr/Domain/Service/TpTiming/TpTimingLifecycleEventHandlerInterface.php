<?php

namespace Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Cgr\Domain\Model\TpTiming\TpTimingInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface TpTimingLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TpTimingInterface $tpTiming);
}
