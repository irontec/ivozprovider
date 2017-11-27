<?php

namespace Ivoz\Provider\Domain\Service\InvoiceTemplate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class InvoiceTemplateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(InvoiceTemplateLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}