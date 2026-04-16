<?php

namespace Ivoz\Provider\Infrastructure\Redis\Job;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\WebhookJobInterface;
use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;
use Psr\Log\LoggerInterface;

class Webhook implements WebhookJobInterface
{
    private ?WebhookEventPayload $data = null;

    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private LoggerInterface $logger
    ) {
    }

    public function setData(WebhookEventPayload $data): static
    {
        $this->data = $data;
        return $this;
    }

    public function send(): void
    {
        try {
            $redisClient = $this->redisMasterFactory->create(
                $this->redisDb
            );

            $redisClient->rPush(
                self::CHANNEL,
                json_encode($this->data, JSON_THROW_ON_ERROR)
            );

            $redisClient->close();
        } catch (\Exception $e) {
            $this
                ->logger
                ->error(
                    $e->getMessage()
                );
        }
    }
}
