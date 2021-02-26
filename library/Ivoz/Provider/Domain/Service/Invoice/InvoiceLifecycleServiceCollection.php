<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class InvoiceLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Invoice\AutoRateCalls::class => 99,
            \Ivoz\Provider\Domain\Service\Invoice\CheckValidity::class => 100,
            \Ivoz\Provider\Domain\Service\Invoice\SetInvoiceNumber::class => 300,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\Invoice\SendGenerateOrder::class => 10,
            \Ivoz\Provider\Domain\Service\Invoice\EmailSender::class => 300,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, InvoiceLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
