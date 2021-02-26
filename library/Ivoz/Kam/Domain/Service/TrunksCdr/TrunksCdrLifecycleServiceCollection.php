<?php

namespace Ivoz\Kam\Domain\Service\TrunksCdr;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;
use Ivoz\Kam\Domain\Model\TrunksCdr\Event\TrunksCdrWasMigratedSubscriberInterface;

/**
 * @codeCoverageIgnore
 */
class TrunksCdrLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_domain_event" =>
        [
            0 => \Ivoz\Provider\Domain\Service\BillableCall\UpdateByTpCdr::class,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, TrunksCdrWasMigratedSubscriberInterface::class);
        $this->services[$event][] = $service;
    }
}
