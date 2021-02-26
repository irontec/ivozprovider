<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Domain\Assert\Assertion;
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
        ],
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\Ivr\UpdateByExtension::class => 10,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, ExtensionLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
