<?php

namespace spec\Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Provider\Domain\Model\Webhook\Payload\WebhookEventPayload;
use Ivoz\Provider\Domain\Model\Webhook\WebhookInterface;
use Ivoz\Provider\Domain\Service\Webhook\WebhookEventHandler;
use Ivoz\Provider\Domain\Service\Webhook\WebhookResolver;
use Ivoz\Provider\Domain\Service\Webhook\WebhookSender;
use Ivoz\Provider\Domain\Service\Webhook\WebhookTemplateRenderer;
use PhpSpec\ObjectBehavior;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class WebhookEventHandlerSpec extends ObjectBehavior
{
    use HelperTrait;

    /** @var WebhookResolver */
    protected $webhookResolver;

    /** @var WebhookTemplateRenderer */
    protected $templateRenderer;

    /** @var WebhookSender */
    protected $webhookSender;

    /** @var LoggerInterface */
    protected $logger;

    public function let(
        WebhookResolver $webhookResolver,
        WebhookTemplateRenderer $templateRenderer,
        WebhookSender $webhookSender,
        LoggerInterface $logger,
    ) {
        $this->webhookResolver = $webhookResolver;
        $this->templateRenderer = $templateRenderer;
        $this->webhookSender = $webhookSender;
        $this->logger = $logger;

        $this->beConstructedWith(
            $webhookResolver,
            $templateRenderer,
            $webhookSender,
            $logger,
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(WebhookEventHandler::class);
    }

    public function it_does_nothing_when_no_webhook_resolved()
    {
        $payload = new WebhookEventPayload(
            event: 'start',
            brandId: 1,
            companyId: 10,
            ddiId: null,
            ddiE164: null,
            callId: null,
            uniqueId: null,
            caller: null,
            callee: null,
            dialStatus: null,
            timestamp: null,
        );

        $this->webhookResolver
            ->execute(1, 10, null, 'start')
            ->willReturn(null);

        $this->templateRenderer
            ->execute(\Prophecy\Argument::cetera())
            ->shouldNotBeCalled();

        $this->webhookSender
            ->send(\Prophecy\Argument::cetera())
            ->shouldNotBeCalled();

        $this->execute($payload);
    }

    public function it_renders_template_and_dispatches_to_sender()
    {
        $webhook = $this->getTestDouble(WebhookInterface::class);
        $webhook->getTemplate()->willReturn('{"e":"{{event}}"}');
        $webhook->getUri()->willReturn('https://example.test/hook');

        $payload = new WebhookEventPayload(
            event: 'answer',
            brandId: 1,
            companyId: 10,
            ddiId: 100,
            ddiE164: '+34900100200',
            callId: 'call-123',
            uniqueId: 'unique-456',
            caller: '600600600',
            callee: '2001',
            dialStatus: 'ANSWER',
            timestamp: '2026-01-01T00:00:00+00:00',
        );

        $this->webhookResolver
            ->execute(1, 10, 100, 'answer')
            ->willReturn($webhook);

        $this->templateRenderer
            ->execute('{"e":"{{event}}"}', $payload)
            ->shouldBeCalled()
            ->willReturn('{"e":"answer"}');

        $this->webhookSender
            ->send('https://example.test/hook', '{"e":"answer"}')
            ->shouldBeCalled();

        $this->execute($payload);
    }
}
