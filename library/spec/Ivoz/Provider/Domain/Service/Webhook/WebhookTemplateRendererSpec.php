<?php

namespace spec\Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;
use Ivoz\Provider\Domain\Service\Webhook\WebhookTemplateRenderer;
use PhpSpec\ObjectBehavior;

class WebhookTemplateRendererSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(WebhookTemplateRenderer::class);
    }

    public function it_replaces_known_placeholders()
    {
        $payload = new WebhookEventPayload(
            event: 'start',
            brandId: 1,
            companyId: 10,
            ddiId: 100,
            ddiE164: '+34900100200',
            callId: 'call-123',
            uniqueId: 'unique-456',
            caller: '600600600',
            callee: '2001',
            dialStatus: null,
            timestamp: null,
        );

        $template = '{"event":{{event}},"brand":{{brandId}},"from":{{caller}},"to":{{callee}}}';

        $this
            ->execute($template, $payload)
            ->shouldReturn('{"event":"start","brand":1,"from":"600600600","to":"2001"}');
    }

    public function it_replaces_null_values_with_null()
    {
        $payload = new WebhookEventPayload(
            event: 'end',
            brandId: 1,
            companyId: null,
            ddiId: null,
            ddiE164: null,
            callId: null,
            uniqueId: null,
            caller: null,
            callee: null,
            dialStatus: null,
            timestamp: null,
        );

        $this
            ->execute('c={{companyId}};d={{ddiId}};dial={{dialStatus}}', $payload)
            ->shouldReturn('c=null;d=null;dial=null');
    }

    public function it_leaves_unknown_placeholders_untouched()
    {
        $payload = new WebhookEventPayload(
            event: 'start',
            brandId: 1,
            companyId: null,
            ddiId: null,
            ddiE164: null,
            callId: null,
            uniqueId: null,
            caller: null,
            callee: null,
            dialStatus: null,
            timestamp: null,
        );

        $this
            ->execute('{{event}}-{{unknown}}', $payload)
            ->shouldReturn('"start"-{{unknown}}');
    }
}
