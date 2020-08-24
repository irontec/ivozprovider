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

    /** @var RedisPool | null */
    protected $redisPool;

    /** @var Redis */
    protected $controlRedisClient;

    /** @var Redis */
    protected $controlRedisSubscriber;

    /** @var Subscriber[] */
    protected $subscribers = [];

    /** @var LoggerInterface */
    protected $logger;

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
            SWOOLE_SOCK_TCP
        );

        // TODO extract read from yaml config file
        $baseConfig = [
            'open_http_protocol' => false,
            'open_websocket_protocol' => true,
            'websocket_compression' => true,
            'daemonize' => false,
            'enable_static_handler' => false
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

        exit;
    }

    public function reload()
    {
        $this
            ->server
            ->reload();
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
                function (
                    Server $server,
                    int $worker_id,
                    int $worker_pid,
                    int $exit_code,
                    int $signal
                ) {
                    $this->onWorkerError(
                        $worker_id,
                        $worker_pid,
                        $exit_code,
                        $signal
                    );
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
    }

    protected function onWorkerError(
        int $workerId,
        int $workerPid,
        int $exitCode,
        int $signal
    ) {
        $details = [
            'workerId' => $workerId,
            'workerPid' => $workerPid,
            'exitCode' => $exitCode,
            'signal' => $signal
        ];

        $this->logger->error(
            'worker error shutdown '
            . json_encode($details)
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
