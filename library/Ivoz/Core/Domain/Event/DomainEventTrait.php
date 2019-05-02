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

    /**
     * @return void
     */
    protected function setEventTimestamp()
    {
        $this->occurredOn = new \DateTimeImmutable(
            'now',
            new \DateTimeZone('UTC')
        );

        $this->microtime = intval((microtime(true) - time()) * 10000);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOccurredOn()
    {
        return clone $this->occurredOn;
    }

    /**
     * @return int
     */
    public function getMicrotime()
    {
        return $this->microtime;
    }
}
