<?php

namespace Services;

use Swoole\Coroutine\Redis;

class RedisClientFactory
{
    public static function create(
        string $host = '127.0.0.1',
        int $port = 6379
    ) {
        $redis = new Redis();
        $connection = $redis->connect(
            $host,
            $port
        );

        if ($connection == false) {
            throw new \RuntimeException("failed to connect redis server.");
        }

        return $redis;
    }
}
