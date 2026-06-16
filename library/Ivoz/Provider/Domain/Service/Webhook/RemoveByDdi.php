<?php

namespace Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Webhook\WebhookRepository;
use Ivoz\Provider\Domain\Service\Ddi\DdiLifecycleEventHandlerInterface;

class RemoveByDdi implements DdiLifecycleEventHandlerInterface
{
    public const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private WebhookRepository $webhookRepository,
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY,
        ];
    }

    public function execute(DdiInterface $ddi): void
    {
        $webhooks = $ddi->getWebhooks();

        foreach ($webhooks as $webhook) {
            $this->webhookRepository->remove($webhook);
        }
    }
}
