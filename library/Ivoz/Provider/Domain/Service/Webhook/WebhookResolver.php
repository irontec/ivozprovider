<?php

namespace Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Provider\Domain\Model\Webhook\WebhookInterface;
use Ivoz\Provider\Domain\Model\Webhook\WebhookRepository;

class WebhookResolver
{
    public function __construct(
        private WebhookRepository $webhookRepository,
    ) {
    }

    public function execute(int $brandId, ?int $companyId, ?int $ddiId, string $event): ?WebhookInterface
    {
        $webhooks = $this->webhookRepository->findMatchingWebhooks(
            $brandId,
            $companyId,
            $ddiId,
        );

        $eventWebhooks = array_filter(
            $webhooks,
            fn (WebhookInterface $wh) => $this->webhookMatchesEvent($wh, $event),
        );

        if (empty($eventWebhooks)) {
            return null;
        }

        $ddiWebhook = $this->getDdiWebhook(
            $eventWebhooks,
            $ddiId,
        );

        if ($ddiWebhook) {
            return $ddiWebhook;
        }

        $companyWebhook = $this->getCompanyWebhook(
            $eventWebhooks,
            $companyId,
        );

        if ($companyWebhook) {
            return $companyWebhook;
        }

        $brandWebhook = array_pop($eventWebhooks);

        return $brandWebhook;
    }

    /**
     * @param WebhookInterface[] $webhooks
     */
    private function getDdiWebhook(array $webhooks, ?int $ddiId): ?WebhookInterface
    {
        if (is_null($ddiId)) {
            return null;
        }

        $ddiWebhooks = array_filter(
            $webhooks,
            fn (WebhookInterface $wh) => $wh->getDdi()?->getId() === $ddiId,
        );

        return array_pop($ddiWebhooks);
    }

    /**
     * @param WebhookInterface[] $webhooks
     */
    private function getCompanyWebhook(array $webhooks, ?int $companyId): ?WebhookInterface
    {
        if (is_null($companyId)) {
            return null;
        }

        $companyWebhooks = array_filter(
            $webhooks,
            fn (WebhookInterface $wh) => $wh->getCompany()?->getId() === $companyId,
        );

        return array_pop($companyWebhooks);
    }
    private function webhookMatchesEvent(WebhookInterface $webhook, string $event): bool
    {
        return match ($event) {
            'start' => $webhook->getEventStart(),
            'ring' => $webhook->getEventRing(),
            'answer' => $webhook->getEventAnswer(),
            'end' => $webhook->getEventEnd(),
            default => false,
        };
    }
}
