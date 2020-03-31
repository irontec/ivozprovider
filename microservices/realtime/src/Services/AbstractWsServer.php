<?php

namespace Services;

use Model\Subscriber;
use Swoole\Coroutine\Redis;
use Swoole\WebSocket\Server;
use Swoole\WebSocket\Frame;
use Swoole\Http\Request as HttpRequest;

abstract class AbstractWsServer
{
    const REDIS_KEYS_TTL = 60*60*3+30;

    /** @var Server */
    protected $server;

    /** @var RedisPool */
    protected $redisPool;

    /** @var Redis */
    protected $controlRedisClient;

    /** @var Redis */
    protected $controlRedisSubscriber;

    /** @var Subscriber[] */
    protected $subscribers = [];

    /**
     * WsServer constructor.
     * @param string $host
     * @param int $port
     * @param array $config
     */
    public function __construct(
        string $host,
        int $port,
        array $config
    ) {
        $this->server = new Server(
            $host,
            $port,
            SWOOLE_PROCESS,
            SWOOLE_SOCK_TCP | SWOOLE_SSL
        );

        // TODO extract read from yaml config file
        $baseConfig = [
            'ssl_cert_file' => '/etc/ssl/certs/ivozprovider-portals.pem',
            'ssl_key_file' => '/etc/ssl/private/ivozprovider-portals.key',
            'open_http_protocol' => false,
            'open_websocket_protocol' => true,
            'websocket_compression' => true,
        ];

        $this
            ->server
            ->set(
                $baseConfig + $config
            );
    }

    public function __destruct()
    {
        if ($this->redisPool) {
            $this
                ->redisPool
                ->close();
        }
    }

    public function start(
        array $sentinelsConf,
        int $redisPoolSize,
        int $redisDb
    ) {
        $this
            ->bindWorkerEvents(
                $sentinelsConf,
                $redisPoolSize,
                $redisDb
            );

        $this
            ->bindClientEvents();

        $this
            ->server
            ->start();
    }

    public function shutdown()
    {
        $this
            ->server
            ->shutdown();
    }

    protected function bindWorkerEvents(
        array $sentinelsConf,
        int $redisPoolSize,
        int $redisDb
    ) {
        $this
            ->server
            ->on(
                'workerStart',
                function () use ($sentinelsConf, $redisPoolSize, $redisDb) {
                    $this->onWorkerStart(
                        $sentinelsConf,
                        $redisPoolSize,
                        $redisDb
                    );
                }
            );

        $this
            ->server
            ->on(
                'workerStop',
                function () {
                    $this->onWorkerStop();
                }
            );

        $this
            ->server
            ->on(
                'workerError',
                function () {
                    $this->onWorkerError();
                }
            );
    }

    protected function bindClientEvents()
    {
        $this
            ->server
            ->on(
                'open',
                function (
                    Server $server,
                    HttpRequest $req
                ) {
                    $this->onOpen(
                        $server,
                        $req
                    );
                }
            );

        $this
            ->server
            ->on(
                'message',
                function (
                    Server $server,
                    Frame $frame
                ) {
                    $this->onMessage(
                        $server,
                        $frame
                    );
                }
            );

        $this
            ->server
            ->on(
                'close',
                function (
                    Server $server,
                    int $fd
                ) {
                    $this->onClose(
                        $server,
                        $fd
                    );
                }
            );
    }

    protected function onWorkerStop()
    {
        echo "worker stop shutdown\n";
        $this->shutdown();
    }

    protected function onWorkerError()
    {
        echo "worker error shutdown\n";
        $this->shutdown();
    }

    abstract protected function onWorkerStart(
        array $sentinelsConf,
        int $poolSize,
        int $db
    );

    abstract protected function onOpen(
        Server $server,
        HttpRequest $req
    );

    abstract protected function onMessage(
        Server $server,
        Frame $frame
    );

    abstract protected function onClose(
        Server $server,
        int $fd
    );
}
