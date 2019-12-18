<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Event\EntityEventInterface;

class EntityEventSubscriber implements DomainEventSubscriberInterface
{
    use DomainEventCollectorTrait;

    /**
     * @param DomainEventInterface $domainEvent
     * @throws \Exception
     * @return void
     */
    public function handle(DomainEventInterface $domainEvent)
    {
        if (!($domainEvent instanceof EntityEventInterface)) {
            throw new \Exception('EntityEventInterface was expected');
        }

        $this->events[] = $domainEvent;
    }

    /**
     * @param DomainEventInterface $domainEvent
     * @return boolean
     */
    public function isSubscribedTo(DomainEventInterface $domainEvent)
    {
        return $domainEvent instanceof EntityEventInterface;
    }
}
