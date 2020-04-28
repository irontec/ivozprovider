<?php

namespace Services;

use Model\Message;
use Model\RedisConf;
use Model\SentinelConf;
use Psr\Log\LoggerInterface;
use Swoole\Coroutine\Channel;

class Sentinel
{
    const EVENT_SHUTDOWN = 'shutdown';

    /** @var  LoggerInterface */
    private $logger;

    /** @var RedisConf[]  */
    private $sentinels;

    /** @var Channel  */
    private $channel;

    /** @var RedisConf */
    private $master;

    /** @var  RedisConf */
    private $sentinel;

    /**
     * Sentinel constructor.
     * @param RedisConf[] $sentinelConfig
     */
    public function __construct(
        array $sentinelConfig,
        LoggerInterface $logger
    ) {
        if (empty($sentinelConfig)) {
            throw new \RuntimeException(
                'Empty sentinel config found'
            );
        }

        $this->logger = $logger;
        $this->sentinels = $sentinelConfig;
        $this->channel = new Channel(1);
    }

    public static function fromConfigArray(
        array $config,
        LoggerInterface $logger
    ) {
        $sentinelConfig = new SentinelConf($config);

        return new static(
            $sentinelConfig->get(),
            $logger
        );
    }

    public function resolveMaster(): RedisConf
    {
        for ($i = 0; $i < count($this->sentinels); $i++) {
            try {
                $config = $this->sentinels[$i];
                $this->master = $this->getRedisMasterOrThrowException(
                    $config
                );

                $this->sentinel = $config;

                break;
            } catch (\Exception $e) {
                $this->logger->error(
                    "ERROR: " . $e->getMessage()
                );
                continue;
            }
        }

        return $this->master;
    }

    public function getRedisMasterConfig(): RedisConf
    {
        return $this->master;
    }

    public function getChannel(): Channel
    {
        return $this->channel;
    }

    public function subscribe()
    {
        $sentinelCo = RedisClientFactory::create(
            $this->sentinel->getHost(),
            $this->sentinel->getPort()
        );

        $this->logger->info(
            "Sentinel pSubscribe *"
        );
        $sentinelCo->pSubscribe(['*']);

        while ($msg = $sentinelCo->recv()) {
            if (count($msg) < 4) {
                continue;
            }

            $significantEvents = [
                'down' => '+sdown',
                'switch' => '+switch-master',
            ];
            $event = $msg[2];

            if (!in_array($event, $significantEvents, true)) {
                continue;
            }

            $masterName = $this->master->getName();
            $masterIsDown = false !== strpos(
                $msg[3],
                'master ' . $masterName . ' '
            );
            $masterHasSwitched = $event === $significantEvents['switch'];

            if (!$masterIsDown && !$masterHasSwitched) {
                continue;
            }

            $logMsg = $masterIsDown
                ? "Redis master is down"
                : 'Redis master has changed';

            $this->logger->error(
                $logMsg
            );

            $this->channel->push(
                new Message(
                    self::EVENT_SHUTDOWN
                )
            );

            $sentinelCo->pUnSubscribe(['*']);
            $sentinelCo->close();
            break;
        }
    }

    private function getRedisMasterOrThrowException(RedisConf $config): RedisConf
    {
        // Swoole does not have sentinel support yet
        $sentinel = new \RedisSentinel(
            $config->getHost(),
            $config->getPort()
        );

        $masters = $sentinel->masters();

        if (empty($masters)) {
            throw new \RuntimeException(
                'No redis master found'
            );
        }

        $masterName = $masters[0]['name'] ?? '';
        if (!$masterName) {
            throw new \RuntimeException(
                'Unable to get redis master name'
            );
        }

        $master = $sentinel->getMasterAddrByName(
            $masterName
        );

        if (empty($masters)) {
            throw new \RuntimeException(
                'Unable to get redis master'
            );
        }
        unset($sentinel);

        return new RedisConf(
            $master[0],
            $master[1],
            $masterName
        );
    }
}
