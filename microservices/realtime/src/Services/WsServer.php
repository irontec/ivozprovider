<?php

namespace Services;

use Model\Subscriber;
use Feeder\AbstractCall;
use Swoole\Coroutine;
use Swoole\Websocket\Frame as WsFrame;
use Swoole\Http\Server as HttpServer;
use Swoole\Http\Request as HttpRequest;

class WsServer extends AbstractWsServer
{
    protected function onWorkerStart(
        array $sentinelsConf,
        int $poolSize,
        int $db
    ) {
        echo "Init Redis Pool\n";
        $this->redisPool = new RedisPool(
            $poolSize,
            $db
        );

        echo "Resolving redis master\n";
        $sentinel = new Sentinel(
            $sentinelsConf
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
        HttpServer $server,
        HttpRequest $req
    ) {
        echo "Connection open: {$req->fd}\n";

        $server->push(
            $req->fd,
            'Challenge'
        );
    }

    protected function onMessage(
        HttpServer $server,
        WsFrame $frame
    ) {
    }

    protected function onClose(HttpServer $server, int $fd)
    {
        echo "connection close: #" . $fd ."\n";
        $subscriber = $this->subscribers[$fd] ?? null;
        if (!$subscriber) {
            echo "Unknown subscriber #" . $fd . "\n";
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
    /**
     * @param $sentinel
     */
    private function subscribeToSentinel(Sentinel $sentinel)
    {
        Coroutine::create(function () use ($sentinel) {

            $sentinel->subscribe();

            //We don't expect any message from sentinel unless redis master goes down
            $sentinel
                ->getChannel()
                ->pop();

            echo "Sentinel shutdown\n";
            $this->shutdown();
            Coroutine::sleep(1);

            exit;
        });
    }

    /**
     * @param $redisMaster
     */
    private function initRedisControlClients($redisMaster)
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
            echo "[DEL] " . $channel . "\n";
            $this
                ->controlRedisClient
                ->del(
                    $channel
                );

            return;
        }

        if ($event === AbstractCall::CALL_SETUP) {
            echo "[SETEX] " . $channel . "\n";
            $this
                ->controlRedisClient
                ->setEx(
                    $channel,
                    self::REDIS_KEYS_TTL,
                    json_encode($payload)
                );
            echo json_encode($payload) . "\n\n";

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
            echo "Skiping " . $channel . "\n\n";

            return;
        }

        $data['Event'] = $event;
        echo "[SETEX] " . $channel . "\n";
        $this
            ->controlRedisClient
            ->setEx(
                $channel,
                self::REDIS_KEYS_TTL,
                json_encode($data)
            );

        echo "Event: ". $event . "\n\n";
    }
}
