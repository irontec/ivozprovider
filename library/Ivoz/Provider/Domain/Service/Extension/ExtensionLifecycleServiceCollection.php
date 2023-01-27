<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ExtensionLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\User\UpdateByExtension::class => 10,
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByExtension::class => 20,
            \Ivoz\Provider\Domain\Service\Contact\UpdateByExtension::class => 200,
        ],
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\Ivr\UpdateByExtension::class => 10,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, ExtensionLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
