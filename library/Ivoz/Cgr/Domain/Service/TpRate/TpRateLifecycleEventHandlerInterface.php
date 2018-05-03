<?php

namespace Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface;

interface TpRateLifecycleEventHandlerInterface
{
    public function execute(TpRateInterface $entity);
}