<?php

namespace Ivoz\Core\Domain\Event;

interface DomainEventInterface
{
    public function getOccurredOn();

    public function getMicrotime();
}
