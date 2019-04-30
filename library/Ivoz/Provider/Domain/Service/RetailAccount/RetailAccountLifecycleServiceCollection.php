<?php

namespace Ivoz\Provider\Domain\Service\RetailAccount;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RetailAccountLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\RetailAccount\CheckUniqueness::class => 200,
        ],
        "post_persist" =>
        [
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByRetailAccount::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, RetailAccountLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
