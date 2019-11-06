<?php

namespace Ivoz\Provider\Domain\Service\BillableCall;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallInterface;

interface BillableCallLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(BillableCallInterface $call);
}
