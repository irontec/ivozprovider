<?php

namespace Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;

class WebhookTemplateRenderer
{
    public function execute(string $template, WebhookEventPayload $payload): string
    {
        $payloadData = [
            'event' => $payload->event,
            'brandId' => $payload->brandId,
            'companyId' => $payload->companyId,
            'ddiId' => $payload->ddiId,
            'ddiE164' => $payload->ddiE164,
            'callId' => $payload->callId,
            'uniqueId' => $payload->uniqueId,
            'caller' => $payload->caller,
            'callee' => $payload->callee,
            'dialStatus' => $payload->dialStatus,
            'timestamp' => $payload->timestamp,
        ];

        $replacements = [];
        foreach ($payloadData as $key => $value) {
            $value = is_string($value)
                ? sprintf("\"%s\"", $value)
                : $value;

            $replacements['{{' . $key . '}}'] = is_null($value)
                ? 'null'
                : $value;
        }

        return strtr($template, $replacements);
    }
}
