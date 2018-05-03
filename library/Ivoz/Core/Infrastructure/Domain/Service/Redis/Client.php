<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Redis;

class Client
{
    const SAFETY_KEY = 'tp_changed_at';

    private $predis;

    /**
     * Client constructor.
     * @param string $tcpConnectionStream 'tcp://data.ivozprovider.local:6379' for example
     * @param mixed|null $database
     */
    public function __construct(string $tcpConnectionStream, int $database)
    {
        $this->predis = new \Predis\Client($tcpConnectionStream);
        $this->select($database);
    }

    /**
     * @param string $database
     */
    public function select(string $database)
    {
        $this->predis->select($database);
    }

    /**
     * @param int|null $timestamp
     */
    public function scheduleFullReload(int $timestamp = null)
    {
        $timestamp = $timestamp ?? time();
        $this->set(
            self::SAFETY_KEY,
            $timestamp
        );
    }

    /**
     * @return boolean
     */
    public function isFullReloadScheduled()
    {
        return $this->exists(self::SAFETY_KEY);
    }

    /**
     * @param string $key
     *
     * @return boolean
     */
    public function exists(string $key)
    {
        $response = $this->predis->exists(
            $key
        );

        return $response == 1;
    }

    /**
     * @param $key
     * @param string $value
     * @param null $expireResolution
     * @param null $expireTTL
     * @param null $flag
     */
    public function set($key, $value)
    {
        $this->predis->set(
            $key,
            $value
        );
    }
}