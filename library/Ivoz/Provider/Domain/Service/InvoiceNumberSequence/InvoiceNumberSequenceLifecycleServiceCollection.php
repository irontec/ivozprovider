<?php

namespace Ivoz\Provider\Domain\Service\InvoiceNumberSequence;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class InvoiceNumberSequenceLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\InvoiceNumberSequence\CheckValidity::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, InvoiceNumberSequenceLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
