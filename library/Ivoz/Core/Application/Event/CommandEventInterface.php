<?php

namespace Ivoz\Core\Application\Event;

use Ivoz\Core\Domain\Event\DomainEventInterface;

interface CommandEventInterface extends DomainEventInterface
{
    public function __construct(
        string $requestId,
        string $service,
        string $method,
        array $arguments,
        array $agent
    );

    public function getId();

    public function getRequestId();

    public function getService();

    public function getMethod();

    public function getArguments();

    public function getAgent();
}
