<?php

namespace Ivoz\Provider\Domain\Service\DdiProviderRegistration;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DdiProviderRegistrationLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksUacreg\CreatedByDdiProviderRegistration::class => 200,
        ],
        "error_handler" =>
        [
            \Ivoz\Provider\Domain\Service\DdiProviderRegistration\PersistErrorHandler::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, DdiProviderRegistrationLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
