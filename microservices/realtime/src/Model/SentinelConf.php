<?php

namespace Model;

class SentinelConf
{
    /** @var array RedisConf[] */
    private $sentinels = [];

    public function __construct(
        array $sentinelConfig
    ) {
        if (empty($sentinelConfig)) {
            throw new \RuntimeException(
                'Empty sentinel config found'
            );
        }

        foreach ($sentinelConfig as $sentinel) {
            $this->sentinels[] = new RedisConf(
                $sentinel['host'],
                $sentinel['port']
            );
        }

        // Random priority
        shuffle($this->sentinels);
    }

    /**
     * @return RedisConf[]
     */
    public function get(): array
    {
        return $this->sentinels;
    }
}
