<?php

namespace Ivoz\Provider\Domain\Service\Webhook;

interface WebhookSender
{
    public function send(string $uri, string $body): void;
}
