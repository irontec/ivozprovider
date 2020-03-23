<?php

namespace Services;

use Swoole\Coroutine\Redis;
use Swoole\Coroutine\Channel;

class RedisPool
{
    /** @var Channel */
    private $pool;

    private $host;
    private $port;
    private $maxPoolSize;
    private $poolSize = 0;
    private $db;

    private $connected = false;

    public function __construct(
        int $poolSize = 5,
        int $db
    ) {
        $this->pool = new Channel(
            $poolSize
        );

        $this->maxPoolSize = $poolSize;
        $this->db = $db;
    }

    public function connect(
        string $host = '127.0.0.1',
        int $port = 6379
    ) {
        if ($this->isConnected()) {
            throw new \RuntimeException(
                'RedisPool is initialized already'
            );
        }

        $this->host = $host;
        $this->port = $port;

        while ($this->canIncreasePool()) {
            $this->appendClient();
        }

        $this->connected = true;
    }

    public function isConnected(): bool
    {
        return $this->connected;
    }

    public function get(): Redis
    {
        if (!$this->isConnected()) {
            throw new \RuntimeException(
                'RedisPool is closed'
            );
        }

        if (!$this->pool->length()) {
            echo "Waiting for available redis client\n";
        }

        return $this
            ->pool
            ->pop();
    }

    public function close()
    {
        $this
            ->pool
            ->close();

        echo "Redis pool closed\n";
        $this->connected = false;
    }

    public function push(Redis $redis)
    {
        $redis->close();
        unset($redis);
        $this->poolSize--;

        $this
            ->appendClient();
    }

    private function canIncreasePool()
    {
        return $this->maxPoolSize > $this->poolSize;
    }

    private function appendClient(): bool
    {
        if (!$this->canIncreasePool()) {
            echo "Current redis pool size has reached it's limit\n";
            return false;
        }

        $redisClient = RedisClientFactory::create(
            $this->host,
            $this->port
        );

        $redisClient->select($this->db);

        $this->poolSize++;

        echo "Current Redis pool size is " . $this->poolSize . "\n";

        $this
            ->pool
            ->push(
                $redisClient
            );

        return true;
    }
}
