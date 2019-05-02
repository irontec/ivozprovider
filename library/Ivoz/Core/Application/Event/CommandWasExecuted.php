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
     * @var array
     */
    protected $agent;

    /**
     * @var \DateTime
     */
    protected $occurredOn;

    /**
     * @var int
     */
    protected $microtime;

    public function __construct(
        string $requestId,
        string $service,
        string $method,
        array $arguments,
        array $agent
    ) {
        $this->requestId = $requestId;
        $this->service = $service;
        $this->method = $method;
        $this->arguments = $arguments;
        $this->agent = $agent;

        $this->id = Uuid::uuid4()->toString();
        $this->occurredOn = new \DateTime(
            'now',
            new \DateTimeZone('UTC')
        );

        $this->microtime = intval((microtime(true) - time()) * 10000);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @return array
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @return \DateTime
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
