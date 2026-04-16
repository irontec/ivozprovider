<?php

namespace Ivoz\Provider\Infrastructure\Http\Webhook;

use GuzzleHttp\Client;
use Ivoz\Provider\Domain\Service\Webhook\WebhookSender;
use Psr\Log\LoggerInterface;

class GuzzleWebhookSender implements WebhookSender
{
    public function __construct(
        private Client $httpClient,
        private LoggerInterface $logger,
    ) {
    }

    public function send(string $uri, string $body): void
    {
        try {
            $this->httpClient->post($uri, [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => $body,
            ]);
        } catch (\Throwable $e) {
            $this->logger->error(sprintf(
                '[WEBHOOK] Failed to send to %s: %s',
                $uri,
                $e->getMessage(),
            ));
        }
    }
}
