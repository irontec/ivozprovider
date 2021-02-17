<?php

namespace Services;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisConf;
use Model\Message;
use Psr\Log\LoggerInterface;
use Swoole\Coroutine\Channel;
use Ivoz\Core\Infrastructure\Persistence\Redis\Sentinel as SentinelBase;

class Sentinel extends SentinelBase
{
    const EVENT_SHUTDOWN = 'shutdown';

    /** @var Channel  */
    private $channel;

    /**
     * Sentinel constructor.
     * @param RedisConf[] $sentinelConfig
     */
    public function __construct(
        array $sentinelConfig,
        LoggerInterface $logger
    ) {
        parent::__construct(
            $sentinelConfig,
            $logger
        );

        $this->channel = new Channel(1);
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
}
