<?php

namespace Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;

interface TpRateLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(TpRateInterface $entity);
}