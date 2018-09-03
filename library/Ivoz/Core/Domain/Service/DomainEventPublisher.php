<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Event\DomainEventInterface;

class DomainEventPublisher
{
    /**
     * @var DomainEventPublisher
     */
    private static $instance = null;

    /**
     * @var DomainEventSubscriberInterface[]
     */
    private $subscribers;

    private function __construct()
    {
        $this->subscribers = [];
    }

    public function subscribe(DomainEventSubscriberInterface $subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
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
