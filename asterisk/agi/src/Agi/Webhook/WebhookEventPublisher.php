<?php

namespace Agi\Webhook;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Job\WebhookJobInterface;
use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;
use Psr\Log\LoggerInterface;

class WebhookEventPublisher
{
    public function __construct(
        private Wrapper $agi,
        private WebhookJobInterface $webhookJob,
        private LoggerInterface $logger,
    ) {
    }

    public function publish(string $event): void
    {
        try {
            $brandId = (int) $this->agi->getVariable('BRANDID');
            if ($brandId === 0) {
                return;
            }

            $payload = new WebhookEventPayload(
                event: $event,
                brandId: $brandId,
                companyId: ((int) $this->agi->getVariable('COMPANYID')) ?: null,
                ddiId: ((int) $this->agi->getVariable('DDIID')) ?: null,
                ddiE164: $this->agi->getVariable('DDIE164') ?: null,
                callId: $this->agi->getVariable('CALL_ID') ?: null,
                uniqueId: $this->agi->getUniqueId() ?: null,
                caller: $this->agi->getCallerIdNum() ?: null,
                callee: $this->agi->getExtension() ?: null,
                dialStatus: $this->agi->getVariable('DIALSTATUS') ?: null,
                timestamp: date('Y-m-d\TH:i:s.v\Z'),
            );

            $this->webhookJob
                ->setData($payload)
                ->send();
        } catch (\Throwable $e) {
            $this->logger->error(
                '[WEBHOOK-PUBLISHER] Failed to publish event ' . $event . ': ' . $e->getMessage()
            );
        }
    }
}
