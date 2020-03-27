<?php

namespace Services;

use Model\RedisConf;
use Model\Subscriber;
use Feeder\AbstractCall;
use Swoole\Coroutine;
use Swoole\Coroutine\Redis;
use Swoole\WebSocket\Server;
use Swoole\WebSocket\Frame;
use Swoole\Http\Request as HttpRequest;

class WsServer extends AbstractWsServer
{
    protected function onWorkerStart(
        Sentinel $sentinel,
        int $poolSize,
        int $db
    ) {
        $this->logger->info(
            'Init Redis Pool'
        );
        $this->redisPool = new RedisPool(
            $poolSize,
            $db,
            $this->logger
        );

        $this->logger->info(
            'Resolving redis master'
        );

        $redisMaster = $sentinel
            ->resolveMaster();

        $this
            ->subscribeToSentinel(
                $sentinel
            );

        $this->initRedisControlClients(
            $redisMaster
        );
    }

    protected function onOpen(
        Server $server,
        HttpRequest $req
    ) {
        $this->logger->debug(
            "Connection open: {$req->fd}"
        );

        $server->push(
            $req->fd,
            'Challenge'
        );
    }

    protected function onMessage(
        Server $server,
        Frame $frame
    ) {
        $fd = $frame->fd;
        $this->logger->debug(
            "<< Received message: {$frame->data}"
        );

        $data = json_decode(
            $frame->data,
            true
        );

        $isAuthValid =
            $data
            && isset($data['auth']);

        $isRegisterValid =
            $data
            && isset($data['register']);

        if ($isAuthValid && $isRegisterValid) {
            $this->sendCurrentStateAndUpdates(
                $server,
                $fd
            );
        } else {
            $server->push(
                $frame->fd,
                'Challenge'
            );
        }
    }

    protected function onClose(Server $server, int $fd)
    {
        $this->logger->debug(
            'Connection closed: #' . $fd
        );

        $subscriber = $this->subscribers[$fd] ?? null;
        if (!$subscriber) {
            $this->logger->debug(
                'Unknown subscriber #' . $fd
            );

            return;
        }

        $this
            ->controlRedisClient
            ->publish(
                Subscriber::UNSUBSCRIBE_CHANNEL,
                $subscriber->getCoroutineId()
            );
    }

    ///////////////////////////////////////////
    /// Worker
    ///////////////////////////////////////////
    private function subscribeToSentinel(Sentinel $sentinel)
    {
        Coroutine::create(function () use ($sentinel) {

            $sentinel->subscribe();

            //We don't expect any message from sentinel unless redis master goes down
            $sentinel
                ->getChannel()
                ->pop();

            $this->logger->error(
                "Sentinel shutdown"
            );
            $this->shutdown();
            Coroutine::sleep(1);

            exit;
        });
    }

    private function initRedisControlClients(RedisConf $redisMaster)
    {
        Coroutine::create(function () use ($redisMaster) {

            $this
                ->redisPool
                ->connect(
                    $redisMaster->getHost(),
                    $redisMaster->getPort()
                );

            $this->controlRedisClient = $this
                ->redisPool
                ->get();

            $this->controlRedisSubscriber = $this
                ->redisPool
                ->get();

            $controlRedisSubscriber = $this->controlRedisSubscriber;

            $controlRedisSubscriber
                ->pSubscribe([
                    'trunks:*',
                    'users:*',
                ]);

            while ($msg = $controlRedisSubscriber->recv()) {
                $this->updateCurrentCallsStatus(
                    $msg
                );
            }
        });
    }

    private function updateCurrentCallsStatus(array $msg)
    {
        list($type, $mask, $channel) = $msg;
        if ($type !== 'pmessage') {
            return;
        }

        $payload = json_decode($msg[3], true);
        $event = $payload['Event'];

        if ($event === AbstractCall::HANG_UP) {
            $this->logger->debug(
                "[DEL] " . $channel
            );
            $this
                ->controlRedisClient
                ->del(
                    $channel
                );

            return;
        }

        if ($event === AbstractCall::CALL_SETUP) {
            $this->logger->debug(
                "[SETEX] " . $channel . "\n" . json_encode($payload)
            );
            $this
                ->controlRedisClient
                ->setEx(
                    $channel,
                    self::REDIS_KEYS_TTL,
                    json_encode($payload)
                );

            return;
        }

        $dataStr = $this
            ->controlRedisClient
            ->get(
                $channel
            );

        $data = json_decode(
            $dataStr,
            true
        );

        if (!$data) {
            return;
        }

        $data['Event'] = $event;
        $this->logger->debug(
            "[SETEX] " . $channel . "\n" . $event
        );
        $this
            ->controlRedisClient
            ->setEx(
                $channel,
                self::REDIS_KEYS_TTL,
                json_encode($data)
            );
    }

    ///////////////////////////////////////////
    /// Client
    ///////////////////////////////////////////
    private function sendCurrentStateAndUpdates(Server $server, $fd)
    {
        Coroutine::create(function () use ($server, $fd) {

            $redisClient = $this
                ->redisPool
                ->get();

            $mask = 'trunks:*';

            $this->sendCurrentState(
                $redisClient,
                $mask,
                $server,
                $fd
            );

            $subscriber = new Subscriber(
                $redisClient,
                $mask,
                Coroutine::getuid()
            );

            $this->logger->debug(
                "Register subscriber #" . $fd
            );
            $this->subscribers[$fd] = $subscriber;

            $this->forwardStateUpdates(
                $subscriber,
                $server,
                $fd
            );
        });
    }

    private function sendCurrentState(
        Redis $redisClient,
        string $mask,
        Server $server,
        $fd
    ) {
        $keys = $redisClient->keys($mask);
        $currentState = $redisClient->mGet($keys);

        $this->logger->debug(
            "Sending current state (". $mask .") to #" . $fd
        );

        foreach ($currentState as $payload) {
            $server->push(
                $fd,
                $payload
            );
        }
    }

    private function forwardStateUpdates(
        Subscriber $subscriber,
        Server $server,
        $fd
    ) {
        $redisClient = $subscriber->getRedisClient();

        while ($msg = $redisClient->recv()) {
            list(, , $command) = $msg;
            $argument = $msg [3] ?? null;

            $unsubscribe =
                $command == Subscriber::UNSUBSCRIBE_CHANNEL
                && $argument === ((string)Coroutine::getuid());

            if ($unsubscribe) {
                $this->logger->debug(
                    "Unsubscribe #" . $fd
                );

                unset($this->subscribers[$fd]);
                unset($subscriber);
                $this->redisPool->push(
                    $redisClient
                );
                break;
            }

            if (!$argument) {
                continue;
            }

            if (!isset($server->connections[$fd])) {
                $this->logger->debug(
                    "Connection not found for #" . $fd
                );
                break;
            }

            $payload = json_decode($argument, true);

            $forward =
                $payload
                && in_array(
                    $payload['Event'] ?? null,
                    AbstractCall::SIGNIFICANT_CALL_EVENTS,
                    true
                );

            if (!$forward) {
                continue;
            }

            $server->push(
                $fd,
                $argument
            );
        }
    }
}
