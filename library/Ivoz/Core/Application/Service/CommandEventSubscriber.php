<?php

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Application\Event\CommandEventInterface;
use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;

class CommandEventSubscriber implements DomainEventSubscriberInterface
{
    protected $events = [];

    /**
     * @param DomainEventInterface $domainEvent
     * @throws \Exception
     * @return void
     */
    public function handle(DomainEventInterface $domainEvent)
    {
        if (!($domainEvent instanceof CommandEventInterface)) {
            throw new \Exception('CommandEventInterface was expected');
        }

        $this->events[] = $domainEvent;
    }

    /**
     * @return CommandEventInterface[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @return CommandEventInterface
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
        if ($domainEvent instanceof CommandEventInterface) {

            return true;
        }

        return false;
    }
}