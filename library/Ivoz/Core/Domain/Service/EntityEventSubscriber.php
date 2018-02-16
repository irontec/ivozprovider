<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Event\EntityEventInterface;

class EntityEventSubscriber implements DomainEventSubscriberInterface
{
    protected $events = [];

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
     * @return EntityEventInterface[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @return void
     */
    public function clearEvents()
    {
        $this->events = [];
    }

    /**
     * @return EntityEventInterface
     */
    public function shiftEvent()
    {
        return array_shift($this->events);
    }

    /**
     * @return CommandEventInterface
     */
    public function popEvent()
    {
        return array_pop($this->events);
    }

    /**
     * @param DomainEventInterface $domainEvent
     * @return boolean
     */
    public function isSubscribedTo(DomainEventInterface $domainEvent)
    {
        if ($domainEvent instanceof EntityEventInterface) {

            return true;
        }

        return false;
    }
}