<?php

namespace Model;

use Swoole\Coroutine\Redis;

class Subscriber
{
    const UNSUBSCRIBE_CHANNEL = 'unsubscribe';

    private $redisClient;
    private $chanel;
    private $coroutineId;

    public function __construct(
        Redis $redisClient,
        string $chanel,
        $coroutineId
    ) {
        $this->redisClient = $redisClient;
        $this->chanel = $chanel;
        $this->coroutineId = $coroutineId;

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

    public function getCoroutineId()
    {
        return $this->coroutineId;
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
