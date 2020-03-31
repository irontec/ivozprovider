<?php

namespace Model;

class RedisConf
{
    private $host;
    private $port;
    private $name;

    public function __construct(
        string $host,
        int $port,
        string $name = null
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->name = $name;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
    }
}
