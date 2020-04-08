<?php

namespace Model;

class Message
{
    private $event;

    /** @var  mixed | null  */
    private $payload;

    public function __construct(
        string $event,
        $payload = null
    ) {
        $this->event = $event;
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @return mixed|null
     */
    public function getPayload()
    {
        return $this->payload;
    }
}
