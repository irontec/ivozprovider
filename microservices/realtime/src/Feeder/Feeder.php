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

    public function progress(Redis $redis, AbstractCall $call)
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
$usersCalls = [];
$trunksCo = function () use ($trunksCalls, $usersCalls, $helpers) {

    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);

    $progessFn = function (&$calls, $newCallClass) use ($redis, $helpers) {

        if (empty($calls)) {

            /** @var AbstractCall $newCall */
            $newCall = new $newCallClass();
            $helpers->progress($redis, $newCall);
            $calls[$newCall->getChannel()] = $newCall;

            return;
        }

        $currentCallNum = count($calls);
        $increase = $currentCallNum < 5
            ? rand(1, 3) > 1
            : rand(1, 5) > 4;

        if ($increase) {
            /** @var AbstractCall $newCall */
            $newCall = new $newCallClass();
            $helpers->progress($redis, $newCall);
            $calls[$newCall->getChannel()] = $newCall;

            return;
        }

        $randomCallKey = array_rand($calls);

        /** @var AbstractCall $call */
        $call = $calls[$randomCallKey];
        $helpers->progress($redis, $call);

        if ($call->isDone()) {
            unset($calls[$randomCallKey]);
        }
    };

    while (true) {
        if (!empty($trunksCalls)) {
            echo
                "Current call number: "
                . (count($trunksCalls) + count($usersCalls))
                . "\n\n";
        }
        Coroutine::sleep(5);

        $progessFn(
            $trunksCalls,
            TrunksCall::class
        );

        echo "\n";

        $progessFn(
            $usersCalls,
            UsersCall::class
        );
    }
};

Coroutine::create($trunksCo);
