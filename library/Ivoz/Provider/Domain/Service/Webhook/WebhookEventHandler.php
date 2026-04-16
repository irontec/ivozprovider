<?php

namespace Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;
use Psr\Log\LoggerInterface;

class WebhookEventHandler
{
    public function __construct(
        private WebhookResolver $webhookResolver,
        private WebhookTemplateRenderer $templateRenderer,
        private WebhookSender $webhookSender,
        private LoggerInterface $logger,
    ) {
    }

    public function execute(WebhookEventPayload $payload): void
    {
        $this->logger->info('[WEBHOOK] Processing event: ' . $payload->event);

        $webhook = $this->webhookResolver->execute(
            $payload->brandId,
            $payload->companyId,
            $payload->ddiId,
            $payload->event,
        );

        if ($webhook === null) {
            return;
        }

        $body = $this->templateRenderer->execute(
            $webhook->getTemplate(),
            $payload,
        );

        $this->webhookSender->send(
            $webhook->getUri(),
            $body
        );

        $this->logger->info(sprintf(
            '[WEBHOOK] Sent to %s for event %s',
            $webhook->getUri(),
            $payload->event,
        ));
    }
}
