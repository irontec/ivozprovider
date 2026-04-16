<?php

namespace Worker;

use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\WebhookJobInterface;
use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;
use Ivoz\Provider\Domain\Service\Webhook\WebhookEventHandler;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class Webhooks
{
    public function __construct(
        private RedisMasterFactory $redisMasterFactory,
        private WebhookEventHandler $webhookEventHandler,
        private int $redisDb,
        private int $redisTimeout,
        private LoggerInterface $logger
    ) {
        ini_set('default_socket_timeout', (string) $redisTimeout);
    }

    public function dispatch(): Response
    {
        $this->webhookEventHandler->execute(
            $this->getPayload(),
        );

        return new Response('');
    }

    private function getPayload(): WebhookEventPayload
    {
        $redisMaster = $this->redisMasterFactory->create($this->redisDb);

        try {
            /** @var string[]|false $response */
            $response = $redisMaster->blPop(
                [WebhookJobInterface::CHANNEL],
                $this->redisTimeout
            );
        } catch (\Exception $e) {
            $this->logger->error('[WEBHOOK] Redis error: ' . $e->getMessage());
            exit(1);
        }

        if (!$response) {
            $this->logger->error(
                '[WEBHOOK] redis blPop error on channel ' .
                WebhookJobInterface::CHANNEL
            );
            exit(1);
        }

        try {
            $payload = WebhookEventPayload::fromJson(
                end($response)
            );
        } catch (\Exception $e) {
            $this->logger->error(
                '[WEBHOOK] redis blPop error on channel ' .
                WebhookJobInterface::CHANNEL
            );
            exit(1);
        }

        return $payload;
    }
}
