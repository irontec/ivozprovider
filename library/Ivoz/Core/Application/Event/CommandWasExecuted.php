<?php

namespace Ivoz\Core\Application\Event;

use \Ramsey\Uuid\Uuid;

class CommandWasExecuted implements CommandEventInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $requestId;

    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $arguments;

    /**
     * @var \DateTime
     */
    protected $occurredOn;

    public function __construct(
        string $requestId,
        string $service,
        string $method,
        array $arguments
    ) {
        $this->requestId = $requestId;
        $this->service = $service;
        $this->method = $method;
        $this->arguments = $arguments;

        $this->id = Uuid::uuid4()->toString();
        $this->occurredOn = new \DateTime(
            'now',
            new \DateTimeZone('UTC')
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function getService()
    {
        return $this->service;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function getOccurredOn()
    {
        return $this->occurredOn;
    }
}