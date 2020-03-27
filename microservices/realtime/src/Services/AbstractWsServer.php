<?php

namespace Services;

use Model\Subscriber;
use Psr\Log\LoggerInterface;
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

    /** @var LoggerInterface */
    protected $logger;

    /**
     * WsServer constructor.
     * @param string $host
     * @param int $port
     * @param array $config
     */
    public function __construct(
        string $host,
        int $port,
        array $config,
        LoggerInterface $logger
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

        $this->logger = $logger;
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
        Sentinel $sentinel,
        int $redisPoolSize,
        int $redisDb
    ) {
        $this
            ->bindWorkerEvents(
                $sentinel,
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
        Sentinel $sentinel,
        int $redisPoolSize,
        int $redisDb
    ) {
        $this
            ->server
            ->on(
                'workerStart',
                function () use ($sentinel, $redisPoolSize, $redisDb) {
                    $this->onWorkerStart(
                        $sentinel,
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
        $this->logger->error(
            'worker stop shutdown'
        );
        $this->shutdown();
    }

    protected function onWorkerError()
    {
        $this->logger->error(
            'worker error shutdown'
        );
        $this->shutdown();
    }

    abstract protected function onWorkerStart(
        Sentinel $sentinel,
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
