<?php

namespace Model;

use Swoole\Coroutine\Redis;

class Subscriber
{
    const UNSUBSCRIBE_CHANNEL = 'unsubscribe';

    private $redisClient;
    private $chanel;
    private $fd;

    public function __construct(
        Redis $redisClient,
        string $chanel,
        $fd
    ) {
        $this->redisClient = $redisClient;
        $this->chanel = $chanel;
        $this->fd = $fd;

        $this->subscribe();
    }

    public function __destruct()
    {
        $this->unSubscribe();
    }

    public function getRedisClient(): Redis
    {
        return $this->redisClient;
    }

    public function getFd()
    {
        return $this->fd;
    }

    private function subscribe()
    {
        $this
            ->redisClient
            ->pSubscribe([
                $this->chanel,
                self::UNSUBSCRIBE_CHANNEL
            ]);
    }

    private function unSubscribe()
    {
        $this
            ->redisClient
            ->pUnSubscribe([
                $this->chanel,
                self::UNSUBSCRIBE_CHANNEL
            ]);
    }
}
