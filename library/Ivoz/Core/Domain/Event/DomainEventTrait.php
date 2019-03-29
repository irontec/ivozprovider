<?php

namespace Ivoz\Core\Domain\Event;

trait DomainEventTrait
{
    /**
     * @var \DateTimeImmutable
     */
    protected $occurredOn;

    /**
     * @var int
     */
    protected $microtime;

    protected function setEventTimestamp()
    {
        $this->occurredOn = new \DateTimeImmutable(
            'now',
            new \DateTimeZone('UTC')
        );

        $this->microtime = intval((microtime(true) - time()) * 10000);
    }

    public function getOccurredOn()
    {
        return clone $this->occurredOn;
    }

    public function getMicrotime()
    {
        return $this->microtime;
    }
}
