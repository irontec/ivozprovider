<?php

namespace Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Provider\Domain\Job\WebhookReloadJobInterface;
use Ivoz\Provider\Domain\Model\Webhook\WebhookInterface;

class SendWebhookReload implements WebhookLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private WebhookReloadJobInterface $webhookReloadJob
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY,
        ];
    }

    public function execute(WebhookInterface $webhook): void
    {
        $webhookId = $webhook->getId() ?? $webhook->getInitialValue('id');
        ;

        if (!$webhookId) {
            return;
        }

        $this->webhookReloadJob->send((int)$webhookId);
    }
}
