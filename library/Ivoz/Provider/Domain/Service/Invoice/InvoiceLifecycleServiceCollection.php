<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class InvoiceLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(InvoiceLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}