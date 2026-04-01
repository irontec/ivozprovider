<?php

namespace Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\Webhook\WebhookInterface;

interface WebhookLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(WebhookInterface $webhook): void;
}
