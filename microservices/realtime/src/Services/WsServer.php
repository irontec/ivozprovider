<?php

namespace Services;

use Model\Subscriber;
use Feeder\AbstractCall;
use Swoole\Coroutine;
use Swoole\Coroutine\Redis;
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
    }

    protected function onOpen(
        HttpServer $server,
        HttpRequest $req
    ) {
    }

    protected function onMessage(
        HttpServer $server,
        WsFrame $frame
    ) {
    }

    protected function onClose(HttpServer $server, int $fd)
    {
    }
}
