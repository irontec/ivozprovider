<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class AdministratorLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Administrator\CheckUniqueness::class => 200,
        ],
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\AdministratorRelPublicEntity\CreateAcls::class => 200,
            \Ivoz\Provider\Domain\Service\AdministratorRelPublicEntity\UpdateAcls::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, AdministratorLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
