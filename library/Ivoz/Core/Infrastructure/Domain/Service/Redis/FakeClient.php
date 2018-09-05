<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Redis;

class FakeClient extends Client
{
    public function __construct(string $tcpConnectionStream, int $database)
    {
    }

    public function select(string $database)
    {
    }

    public function scheduleFullReload(int $timestamp = null)
    {
    }

    public function isFullReloadScheduled()
    {
    }

    public function exists(string $key)
    {
        return false;
    }

    public function set($key, $value)
    {
    }
}
