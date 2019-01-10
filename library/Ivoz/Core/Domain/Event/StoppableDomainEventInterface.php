<?php

namespace Ivoz\Core\Domain\Event;

use Symfony\Component\EventDispatcher\Event;

interface StoppableDomainEventInterface extends DomainEventInterface
{
    /**
     * @see Event::isPropagationStopped
     */
    public function isPropagationStopped();

    /**
     * @see Event::stopPropagation
     */
    public function stopPropagation();
}
