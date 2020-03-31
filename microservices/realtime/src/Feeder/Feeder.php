<?php

namespace Feeder;

use Swoole\Coroutine;
use Swoole\Coroutine\Redis;

$loader = require __DIR__.'/../../vendor/autoload.php';

$helpers = new Class
{
    public function redisPush(Redis $redis, string $channel, array $payload = null)
    {
        $redis->publish(
            $channel,
            json_encode($payload)
        );

        if ($payload['Event'] === AbstractCall::CALL_SETUP) {
            echo $payload['Event'] . " " . $channel . "\n" . json_encode($payload);
        } else {
            echo $payload['Event'] . " " . $channel;
        }

        echo "\n";
    }

    public function progress(Redis $redis, TrunksCall $call)
    {
        $payload = $call->progress();
        $channel = key($payload);

        self::redisPush(
            $redis,
            $channel,
            $payload[$channel]
        );
    }
};

$trunksCalls = [];
$trunksCo = function () use ($trunksCalls, $helpers) {

    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);

    while (true) {
        if (!empty($trunksCalls)) {
            echo "Current call number: " . count($trunksCalls) . "\n\n";
        }
        Coroutine::sleep(5);

        if (empty($trunksCalls)) {
            $call = new TrunksCall();
            $helpers->progress($redis, $call);
            $trunksCalls[$call->getChannel()] = $call;
            continue;
        }

        $currentCallNum = count($trunksCalls);
        $increase = $currentCallNum < 5
            ? rand(1, 3) > 1
            : rand(1, 5) > 4;

        if ($increase) {
            $call = new TrunksCall();
            $helpers->progress($redis, $call);
            $trunksCalls[$call->getChannel()] = $call;
            continue;
        }

        $randomCallKey = array_rand($trunksCalls);
        $call = $trunksCalls[$randomCallKey];
        $helpers->progress($redis, $call);

        if ($call->isDone()) {
            unset($trunksCalls[$randomCallKey]);
        }
    }
};

Coroutine::create($trunksCo);
