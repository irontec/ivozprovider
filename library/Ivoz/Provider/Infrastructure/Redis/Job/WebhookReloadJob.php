<?php

namespace Ivoz\Provider\Infrastructure\Redis\Job;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\WebhookReloadJobInterface;
use Psr\Log\LoggerInterface;

class WebhookReloadJob implements WebhookReloadJobInterface
{
    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private LoggerInterface $logger,
    ) {
    }

    public function send(int $webhookId): void
    {
        try {
            $redisClient = $this->redisMasterFactory->create(
                $this->redisDb
            );

            $redisClient->publish(
                self::CHANNEL,
                (string)$webhookId
            );

            $redisClient->close();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
