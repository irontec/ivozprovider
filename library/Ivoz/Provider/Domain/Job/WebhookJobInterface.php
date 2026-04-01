<?php

namespace Ivoz\Provider\Domain\Job;

use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;

interface WebhookJobInterface
{
    public const CHANNEL = 'WebhookDispatch';

    public function setData(WebhookEventPayload $data): static;

    public function send(): void;
}
