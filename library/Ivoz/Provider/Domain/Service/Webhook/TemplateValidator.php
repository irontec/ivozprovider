<?php

namespace Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;
use Ivoz\Provider\Domain\Model\Webhook\WebhookInterface;

/**
 * @lifecycle pre_persist
 */
class TemplateValidator implements WebhookLifecycleEventHandlerInterface
{
    public function __construct(
        private WebhookTemplateRenderer $webhookTemplateRenderer,
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => 10
        ];
    }

    public function execute(WebhookInterface $webhook): void
    {
        $template = $webhook->getTemplate();

        $this->assertValidVariables($template);
        $this->assertValidJson($template);
    }

    private function assertValidVariables(string $template): void
    {
        preg_match_all('/\{\{(\w+)\}\}/', $template, $matches);

        $variables = $matches[1];
        $validKeys = WebhookEventPayload::VALID_KEYS;

        $invalidVariables = array_diff($variables, $validKeys);

        if (!empty($invalidVariables)) {
            throw new \DomainException(
                sprintf(
                    'Invalid template placeholders: %s. Valid placeholders are: %s',
                    implode(', ', $invalidVariables),
                    implode(', ', $validKeys)
                )
            );
        }
    }

    private function assertValidJson(string $template): void
    {
        $payload = new WebhookEventPayload(
            'event',
            1,
            1,
            1,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );

        $rendered = $this->webhookTemplateRenderer->execute(
            $template,
            $payload,
        );

        $result = json_decode($rendered, true);
        if (!is_null($result)) {
            return;
        }

        throw new \DomainException('Invalid json template');
    }
}
