<?php


namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Event\DomainEventInterface;

trait DomainEventSubscriberTrait
{
    protected $events = [];

    /**
     * @return DomainEventInterface[]
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
     * @return DomainEventInterface
     */
    public function shiftEvent()
    {
        return array_shift($this->events);
    }

    /**
     * @return DomainEventInterface
     */
    public function popEvent()
    {
        return array_pop($this->events);
    }
}
