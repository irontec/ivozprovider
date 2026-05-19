<?php

namespace Ivoz\Provider\Infrastructure\Redis\Job;

use Ivoz\Provider\Domain\Job\WebhookReloadJobInterface;

class FakeWebhookReloadJob implements WebhookReloadJobInterface
{
    public function send(int $webhookId): void
    {
    }
}
