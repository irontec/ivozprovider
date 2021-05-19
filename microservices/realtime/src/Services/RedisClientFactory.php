<?php

namespace Services;

use Swoole\Coroutine\Redis;

class RedisClientFactory
{
    public static function create(
        string $host = '127.0.0.1',
        int $port = 6379
    ) {
        $retries = 3;
        while ($retries--) {
            $redis = new Redis();
            $connection = $redis->connect(
                $host,
                $port
            );

            if ($connection != false) {
                return $redis;
            }

            // wait until retry
            sleep(10);
        }

        throw new \RuntimeException(
            'Failed to connect to redis server'
        );
    }
}
