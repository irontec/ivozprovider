<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Event\StoppableDomainEventInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Event;

class DomainEventPublisher
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var DomainEventSubscriberInterface[]
     */
    private $subscribers;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
        $this->subscribers = [];
    }

    public function subscribe(DomainEventSubscriberInterface $subscriber)
    {
        $objectId = spl_object_hash($subscriber);
        $this->subscribers[$objectId] = $subscriber;
    }

    /**
     * @param DomainEventInterface | StoppableDomainEventInterface $aDomainEvent
     * @throws \Exception
     */
    public function publish(DomainEventInterface $aDomainEvent)
    {
        $this->logger->debug(
            'A domain event was published: ' . get_class($aDomainEvent)
        );
        $isStoppable = ($aDomainEvent instanceof StoppableDomainEventInterface);

        foreach ($this->subscribers as $subscriber) {
            if ($subscriber->isSubscribedTo($aDomainEvent)) {
                $this->logger->debug(
                    'A domain event subscriber is about be executed: ' . get_class($subscriber)
                );
                $subscriber->handle($aDomainEvent);

                if ($isStoppable && $aDomainEvent->isPropagationStopped()) {
                    break;
                }
            }
        }
    }
}
