<?php

namespace Controller;

use Ivoz\Core\Application\Event\CommandWasExecuted;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;

trait RegisterCommandTrait
{
    /** @var DomainEventPublisher */
    protected $eventPublisher;
    /** @var RequestId */
    protected $requestId;

    private function registerCommand(string $method): void
    {
        $event = new CommandWasExecuted(
            $this->requestId->toString(),
            'Balances',
            $method,
            [],
            []
        );

        $this
            ->eventPublisher
            ->publish($event);
    }
}
