<?php

namespace Ivoz\Provider\Domain\Service\InvoiceScheduler;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

interface InvoiceSchedulerLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(InvoiceSchedulerInterface $entity);
}
