<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Event\DomainEventInterface;

class DomainEventPublisher
{
    /**
     * @var DomainEventSubscriberInterface[]
     */
    private $subscribers;

    public function __construct()
    {
        $this->subscribers = [];
    }

    public function subscribe(DomainEventSubscriberInterface $subscriber)
    {
        $objectId = spl_object_hash($subscriber);
        $this->subscribers[$objectId] = $subscriber;
    }

    public function publish(DomainEventInterface $aDomainEvent)
    {
        foreach ($this->subscribers as $subscriber) {
            if ($subscriber->isSubscribedTo($aDomainEvent)) {
                $subscriber->handle($aDomainEvent);
            }
        }
    }
}
