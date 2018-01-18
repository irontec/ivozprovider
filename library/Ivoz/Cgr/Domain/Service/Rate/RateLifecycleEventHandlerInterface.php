<?php

namespace Ivoz\Cgr\Domain\Service\Rate;

use Ivoz\Cgr\Domain\Model\Rate\RateInterface;

interface RateLifecycleEventHandlerInterface
{
    public function execute(RateInterface $entity);
}