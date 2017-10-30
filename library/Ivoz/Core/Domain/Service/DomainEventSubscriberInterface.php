<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Event\DomainEventInterface;

interface DomainEventSubscriberInterface
{
    /**
     * @param DomainEventInterface $domainEvent
     * @throws \Exception
     * @return void
     */
    public function handle(DomainEventInterface $domainEvent);

    /**
     * @return DomainEventInterface[]
     */
    public function getEvents();

    /**
     * @return DomainEventInterface
     */
    public function shiftEvent();

    /**
     * @return CommandEventInterface
     */
    public function popEvent();

    /**
     * @param DomainEventInterface $domainEvent
     * @return boolean
     */
    public function isSubscribedTo(DomainEventInterface $domainEvent);
}
