<?php

namespace Ivoz\Provider\Domain\Job;

interface WebhookReloadJobInterface
{
    public const CHANNEL = 'WebhookReload';

    public function send(int $webhookId): void;
}
